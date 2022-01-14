<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Glossary;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GlossaryController extends Controller
{
    public function glossary(Request $request){
        $data = $request->all();
        $data['items'] = Glossary::query()
            ->where('status','!=',2)
            ->paginate(50);
        return view('admin.glossary.glossary',$data);
    }

    public function sortSubmit(Request$request)
    {
        $faqs = $request->pass_array;
        // print_r($categories);exit();
        foreach ($faqs as $key => $id) {
            Faq::query()->where('id','=',$id)->update(['sequence_id' => $key]);
        }
        Session::flash('success',__("Faq order is updated."));
        return response()->json([
            'message'   =>  'success',
            'status'  => '1',
        ]);

    }

    function glossaryDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $glossary = Glossary::where("id", "=", $id)
                ->first();
            if (!$glossary){
                return $this->resp(0,'not found',['glossary'=>null],401);
            }
            return $this->resp(1,'glossary details found',['glossary'=>$glossary],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addGlossary(Request $request){
        $data = $request->all();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $id = $data['id'] ?? null;
        $glossary = new Glossary();
        if ($id != null){
            $glossary = Glossary::query()->where('id','=',$id)->first();
            if (!$glossary){
                return redirect(route('view-glossary'))->with('error',  "Glossary does not exist")->withInput();
            }
        }
        $glossary->fill($data)->save();
        if ($id != null){
            return redirect(route('view-glossary'))->with('success',"Glossary updated successfully!");
        }
        return redirect(route('view-glossary'))->with('success',"Glossary added successfully!");
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
            $glossary = Glossary::query()
                ->where("id", "=", $id)
                ->where('status','!=','2')
                ->first();
            if (!$glossary) {
                return redirect(route('view-glossary'))->with("error", "Glossary not found");
            }
            $glossary->status = $status;
            if ($glossary->save()) {
                if ($status == 0){
                    return redirect(route('view-glossary'))->with("success", "Glossary is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('view-glossary'))->with("success", "Glossary is activated successfully.");
                }
                return redirect(route('view-glossary'))->with("success", "Glossary is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('view-glossary'))->with("error", $exception->getMessage());
        }
    }
}
