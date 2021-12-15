<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PartnerMail;
use App\Models\CompanyStructure;
use App\Models\FinancePartner;
use App\Models\FinancePartnerMeta;
use App\Models\LoanType;
use App\Models\MainType;
use App\Models\PartnerMetaRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\returnSelf;

class FinancePartnerController extends Controller
{
    public function financePartners(Request $request){
        $data = $request->all();
        $data['items'] = FinancePartner::query()
            ->orderBy('id','desc')
            ->where('parent_id','=',0)
            ->where('status','!=',2)
            ->paginate(50);
        $data['structures'] = CompanyStructure::where('status','=','1')
            ->get();
        $data['business_main_types'] = MainType::with('subTypes')->where('profile_id',1)->get();
        $data['consumer_main_types'] = MainType::with('subTypes')->where('profile_id',2)->get();
        // $data['loan_types'] = LoanType::where('status','=',1)->get();
        // return $data['loan_main_types'];
        return view('admin.finance_partners.partners',$data);
    }

    public function partnerMeta(Request $request){
        $data = $request->all();
        $partner_id = Session::get('partner_id');

        $data['partners_meta'] = FinancePartnerMeta::where('partner_id','=',$partner_id)
            ->pluck('value', 'key_name');
            // return $data;
        return view('admin.finance_partners.partner_meta',$data);
    }

    public function updatePartnerMeta(Request $request){
        $data = $request->all();
        $partner_id = Session::get('partner_id');

        $data['partner_meta'] = FinancePartnerMeta::where('partner_id','=',$partner_id)
            ->pluck('value', 'key_name');
            // return $data;
        return view('admin.finance_partners.update_partner_meta',$data);
    }

    // public function enquiryColor(Request $request){
    //     $data = $request->all();
    //     $user = $request->user();
    //     $partner_id = Session::get('partner_id');

    //     $data['enquiry_data'] = FinancePartnerMeta::where('partner_id','=',$partner_id)
    //         ->pluck('value', 'key_name');
    //     return view('admin.finance_partners.edit_enquiry_color',$data);
    // }

    function submitPartnerMetaRequest(Request $request){
        $data = $request->except('_token');

        // return $data;
        $user = $request->user();
        $partner_id = Session::get('partner_id');
        $meta = new PartnerMetaRequest();
        $meta->user_id = $user->id;
        $meta->partner_id = $partner_id;
        $meta->requested_data = $data;

        $meta->status = 1; //1=means request is forward to super admin of plateform. 0=means request is forward to bank admin(request by any finance partner user)
        
        $message = "Request is forward to super admin to update your details";

        //if logged user is not bank admin then send request to bankadmin for approval
        if($user->parent_id != 0){
            $meta->status = 0;
            $message = "Request is forward to bank admin.";
        }
        $meta->save();
        return redirect(route('partner-meta'))->with('success',$message);

    }

    //listing at super admin side
    function partnerMetaRequests(Request $request){
        $query = PartnerMetaRequest::query();
        if(Auth::guard('partners')->check()){
            $query->where('status',0)
            ->get();
        }else{
            $query->where('status',1)
            ->get();
        }
        
        $data['meta_requests'] = $query->get();
        
        // return $data;
        return view('admin.finance_partners.partner_meta_requests',$data);
    }


    //accept, reject partner update details request by super admin and bank admin
    //if status of request is 0(requested by partner user) then bank admin wil accept/reject
    //if status of request is 1(requested by partner admin) then bank admin wil accept/reject
    public function acceptMetaRequest(Request $request){
        try {
            $data = $request->all();
            $partner_id = Session::get('partner_id');
            if (!isset($data['status']) || !isset($data['id'])){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }

            $status = (int)$data['status'];
            $id = (int)$data['id'];
            if ($status != 0 && $status != 1){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }

            $query = PartnerMetaRequest::query()->where('id',$id);
            if(Auth::guard('partners')->check()){
                $query->where('partner_id',$partner_id)->where('status',0);
            }else{
                $query->where('status',1);
            }
            $meta_request = $query->first();
            if (!$meta_request) {
                return redirect(route('partner-meta-requests'))->with("error", "Oops. something went wrong.");
            }

            if ($status == 0){
                $meta_request->delete();
                $message ="Request is rejected successfully.";
            }elseif($status == 1 && $meta_request->status == 0){
                $meta_request->status = 1;
                $meta_request->save();
                $message = "Request is forward to super admin for approval.";
            }elseif($status == 1 && $meta_request->status == 1){
                $message = "Requested details are updated successfully.";
                //here update details of finance partner

                foreach($meta_request->requested_data as $key=>$item){
                    if($item != null){
                        $update_details =  FinancePartnerMeta::where('partner_id',$meta_request->partner_id)
                        ->where('key_name',$key)->first();
                        if(!$update_details){
                            $update_details = new FinancePartnerMeta();
                            $update_details->key_name = $key;
                            $update_details->partner_id = $meta_request->partner_id;
                        }
                        $update_details->value = $item;
                        $update_details->save();
                    }

                }
                $meta_request->delete();
                 
            }
            return redirect(route('partner-meta-requests'))->with("success", $message);

        } catch (\Exception $exception){
            return redirect(route('partner-meta-requests'))->with("error", $exception->getMessage());
        }
    }

    // function submitPartnerMeta(Request $request){
    //     $data = $request->all();
    //     $user = $request->user();
    //     $partner_id = Session::get('partner_id');
    // //    dd($request->all());
    //     foreach ($data as $key=>$value){
    //         if (($key != '_token') && ($value != null)){
    //             $web_data = FinancePartnerMeta::where('key_name','=',$key)
    //                 ->where('partner_id','=',$partner_id)
    //                 ->first();
    //             if (!$web_data){
    //                 $web_data = new FinancePartnerMeta();
    //             }
    //             $web_data->partner_id = $partner_id;
    //             $web_data->key_name = $key;
    //             $web_data->value = ($key == 'board_rate') ? json_encode($value) : $value;
    //             $web_data->save();
    //         }
    //     }
    //     return redirect(route('partner-meta'))->with('success','Data is updated successfully.');

    // }

    function partnerDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $partner = FinancePartner::with('partner_terms_condition')->where("id", "=", $id)
                ->first();
            if (!$partner){
                return $this->resp(0,'not found',['partner'=>null],401);
            }
            $partner->company_structure_id = explode(',',$partner->company_structure_id);
            $partner->loan_type_id = explode(',',$partner->loan_type_id);
            $partner->property_types = explode(',',$partner->property_types);
            $partner->equipment_types = explode(',',$partner->equipment_types);
            return $this->resp(1,'partner details found',['partner'=>$partner],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addPartner(Request $request){
        $data = $request->all();
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'required|min:6',
            'min_quantum' => 'required|min:0',
            'max_quantum' => 'required|min:0',
            'company_structure_id' => 'required',
            'loan_type_id' => 'required',
            'property_types' => 'required',
            'equipment_types' => 'required',
            'length_of_incorporation' => 'required|min:0',
            'local_shareholding' => 'required|min:0',
            // 'subsidiaries' => 'required|min:0',
            // 'cbs_member' => 'required',
            'terms_condition' => 'required',
            'image' => 'required|image',
        ]);

        $if_partner = FinancePartner::where('email','=',$data['email'])->where('status','!=','2')->first();
        if ($if_partner){
            return redirect(route('finance-partners'))->with('error',  "Finance partner already exists!")->withInput();
        }
        $partner = new FinancePartner();
        $data['parent_id'] = 0;
        $data['role_id'] = 1;
        $data['loan_type_id'] = implode(',',$data['loan_type_id']);
        $data['subsidiaries'] = isset($data['subsidiaries']) ? 1 : 0;
        $data['cbs_member'] = isset($data['cbs_member']) ? 1 : 0;
        $data['password'] = Hash::make($data['password']);
        $data['company_structure_id'] = implode(',',$data['company_structure_id']);
        $data['property_types'] = implode(',',$data['property_types']);
        $data['equipment_types'] = implode(',',$data['equipment_types']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'partner' . date("Ymd-his") . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path("uploads/financePartnerImages/" . $filename);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath) && $data['image']) {
                if (file_exists($destinationPath)) {
                    $data['image'] = $filename;
                } else {
                    return redirect(route('finance-partners'))->with('error',"Oops. Something went wrong with image");
                }
            }
        }
        $partner->fill($data)->save();

        //update meta details of finance partner
        $update_details =  FinancePartnerMeta::where('partner_id',$partner->id)
        ->where('key_name','terms_condition')->first();
        if(!$update_details){
            $update_details = new FinancePartnerMeta();
            $update_details->key_name = "terms_condition";
            $update_details->partner_id = $partner->id;
        }
        $update_details->value = $data['terms_condition'];
        $update_details->save();

        $info = array(
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => $request->password,
            'created_or_updated' => '1' //account created
        );
        try {
            Mail::to($data['email'])->send(new PartnerMail($info));
        }catch (\Exception $exception){
        }
        return redirect(route('finance-partners'))->with('success',"Finance partner added successfully!");
    }

    public function updatePartner(Request $request){
        $data = $request->all();
        $request->validate([
            'id' => 'required',
            'type' => 'required',
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'min_quantum' => 'required|min:0',
            'max_quantum' => 'required|min:0',
            'company_structure_id' => 'required',
            'loan_type_id' => 'required',
            'property_types' => 'required',
            'equipment_types' => 'required',
            'length_of_incorporation' => 'required|min:0',
            'local_shareholding' => 'required|min:0',
            // 'subsidiaries' => 'required|min:0',
            'terms_condition' => 'required'
        ]);

        $partner = FinancePartner::where('id','=',$data['id'])->where('status','!=','2')->first();
        if (!$partner){
            return redirect(route('finance-partners'))->with('error',  "Finance partner not exists!")->withInput();
        }
        if (isset($data['password'])){
            $request->validate([
                'password' => 'min:6',
            ]);
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $partner->password;
        }
        $data['loan_type_id'] = implode(',',$data['loan_type_id']);
        $data['property_types'] = implode(',',$data['property_types']);
        $data['company_structure_id'] = implode(',',$data['company_structure_id']);
        $data['equipment_types'] = implode(',',$data['equipment_types']);
        $data['cbs_member'] = isset($data['cbs_member']) ? 1 : 0;
        $data['subsidiaries'] = isset($data['subsidiaries']) ? 1 : 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'partner' . date("Ymd-his") . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path("uploads/financePartnerImages/" . $filename);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath) && $data['image']) {
                if (file_exists($destinationPath)) {
//                    $partner->image = $filename;
                    $data['image'] = $filename;
                } else {
                    return redirect(route('finance-partners'))->with('error',"Oops. Something went wrong with image");
                }
            }
        }
        $partner->fill($data)->save();

        //update meta details of finance partner
        $update_details =  FinancePartnerMeta::where('partner_id',$data['id'])
        ->where('key_name','terms_condition')->first();
        if(!$update_details){
            $update_details = new FinancePartnerMeta();
            $update_details->key_name = "terms_condition";
            $update_details->partner_id = $data['id'];
        }
        $update_details->value = $data['terms_condition'];
        $update_details->save();
        
        if (isset($request->password)){
            $info = array(
                'name' => $partner->name,
                'phone' => $partner->phone,
                'email' => $partner->email,
                'password' => $request->password,
                'created_or_updated' => '0' //account details updated
            );
            try {
                Mail::to($partner->email)->send(new PartnerMail($info));
            }catch (\Exception $exception){
            }
        }

        return redirect(route('finance-partners'))->with('success',"Finance partner updated successfully!");
    }

    public function conditionsApprovalRequests(Request $request){
        $data['items'] = FinancePartner::select('id','name','requested_terms_condition')
            ->where('terms_request_status','=',1)
            ->whereNotNull('requested_terms_condition')->paginate(10);
        return view('admin.finance_partners.term_conditions_requests',$data);
    }

    //approving terms & conditions request by super admin
    public function approveTermsConditions(Request $request){
        {
            try {
                $data = $request->all();
                if (!isset($data['id']) || ! isset($data['status'])){
                    return redirect()->back()->with('error',"Oops. something went wrong");
                }
                $id = $data['id'];
                $status = (int)$data['status'];
                if ($status != 0 && $status != 1){
                    return redirect()->back()->with('error',"Oops. something went wrong");
                }
                $partner = FinancePartner::query()
                    ->where("id", "=", $id)
                    ->where('terms_request_status','=',1)
                    ->where('status','!=','2')
                    ->first();
                if (!$partner) {
                    return redirect(route('conditions-approval-requests'))->with("error", "Oops. something went wrong.");
                }
                if ($status == 0){
                    $partner->requested_terms_condition = null;
                    $partner->save();
                    return redirect(route('conditions-approval-requests'))->with("success", "Request is rejected successfully.");
                }
                $partner->terms_condition = $partner->requested_terms_condition;
                $partner->requested_terms_condition = null;
                $partner->terms_request_status = null;
                $partner->save();
                return redirect(route('conditions-approval-requests'))->with("success", "Request is accepted successfully.");

            } catch (\Exception $exception){
                return redirect(route('conditions-approval-requests'))->with("error", $exception->getMessage());
            }
        }
    }

    //approving terms and conditions request by bank admin
    public function approveTermsConditionsByBank(Request $request){
        try {
            $data = $request->all();
            $user = $request->user();
            if (!isset($data['status'])){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $status = (int)$data['status'];
            if ($status != 0 && $status != 1){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $partner = FinancePartner::query()
                ->where("id", "=", $user->id)
                ->where("parent_id", "=", 0)
                ->where('status','!=','2')
                ->first();
            if (!$partner) {
                return redirect(route('partner-terms-conditions'))->with("error", "Oops. something went wrong.");
            }
            if ($status == 0){
                $partner->terms_request_status = null;
                $partner->requested_terms_condition = null;
                $partner->save();
                return redirect(route('partner-terms-conditions'))->with("success", "Request is rejected successfully.");
            }
            $partner->terms_request_user_id = $partner->id;
            $partner->terms_condition = $partner->requested_terms_condition;
            $partner->terms_request_status = 1;
            $partner->save();
            return redirect(route('partner-terms-conditions'))->with("success", "Request is forward to super admin for approval. ");

        } catch (\Exception $exception){
            return redirect(route('partner-terms-conditions'))->with("error", $exception->getMessage());
        }
    }


    public function changeStatus(Request $request)
    {
        try {
            $data = $request->all();
            if (!isset($data['id']) || ! isset($data['status'])){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $id = $data['id'];
            $status = (int)$data['status'];
            if ($status != 2 && $status != 0 && $status != 1){
                return redirect()->back()->with('error',"Oops. something went wrong");
            }
            $partner = FinancePartner::query()
                ->where("id", "=", $id)
                ->where('parent_id','=',0)
                ->where('status','!=','2')
                ->first();
            if (!$partner) {
                return redirect(route('finance-partners'))->with("error", "Finance partner not found");
            }
            $partner->status = $status;
            if ($partner->save()) {
                if ($status == 0){
                    return redirect(route('finance-partners'))->with("success", "Finance partner is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('finance-partners'))->with("success", "Finance partner is activated successfully.");
                }
                return redirect(route('finance-partners'))->with("success", "Finance partner is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('finance-partners'))->with("error", $exception->getMessage());
        }
    }
}
