<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancePartner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FinancePartnerController extends Controller
{
    public function financePartners(Request $request){
        $data = $request->all();
        $data['items'] = FinancePartner::query()
            ->orderBy('id','desc')
            ->where('status','!=',2)
            ->paginate(50);
        return view('admin.finance_partners.partners',$data);
    }

    function partnerDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $partner = FinancePartner::where("id", "=", $id)
                ->first();
            if (!$partner){
                return $this->resp(0,'not found',['partner'=>null],401);
            }
            return $this->resp(1,'partner details found',['partner'=>$partner],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addPartner(Request $request){
        $data = $request->all();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'required|min:6',
            'image' => 'required|image',
        ]);

        $if_partner = FinancePartner::where('email','=',$data['email'])->where('status','!=','2')->first();
        if ($if_partner){
            return redirect(route('finance-partners'))->with('error',  "Finance partner already exists!")->withInput();
        }
        $partner = new FinancePartner();
        $partner->parent_id = 0;
        $partner->name = $data['name'];
        $partner->email = $data['email'];
        $partner->phone = $data['phone'];
        $partner->password = Hash::make($data['password']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'partner' . date("Ymd-his") . '.' . $file->getClientOriginalExtension();
            $destinationPath = "uploads/financePartnerImages/" . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath) && $data['image']) {
                if (file_exists($destinationPath)) {
                    $partner->image = $filename;
                } else {
                    return redirect(route('finance-partners'))->with('error',"Oops. Something went wrong with image");
                }
            }
        }

        $partner->save();
        return redirect(route('finance-partners'))->with('success',"Finance partner added successfully!");
    }

    public function updatePartner(Request $request){
        $data = $request->all();
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        $partner = FinancePartner::where('id','=',$data['id'])->where('status','!=','2')->first();
        if (!$partner){
            return redirect(route('finance-partners'))->with('error',  "Finance partner not exists!")->withInput();
        }
        $partner->name = $data['name'];
        $partner->phone = $data['phone'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'partner' . date("Ymd-his") . '.' . $file->getClientOriginalExtension();
            $destinationPath = "uploads/financePartnerImages/" . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath) && $data['image']) {
                if (file_exists($destinationPath)) {
                    $partner->image = $filename;
                } else {
                    return redirect(route('finance-partners'))->with('error',"Oops. Something went wrong with image");
                }
            }
        }
        $partner->save();
        return redirect(route('finance-partners'))->with('success',"Finance partner updated successfully!");
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
