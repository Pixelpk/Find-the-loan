<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faq(Request $request){
        $data = $request->all();
        $data['items'] = Faq::query()
            ->orderBy('id','desc')
            ->where('status','!=',2)
            ->paginate(50);
        return view('admin.faq.faq',$data);
    }

    function faqDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $faq = Faq::where("id", "=", $id)
                ->first();
            if (!$faq){
                return $this->resp(0,'not found',['faq'=>null],401);
            }
            return $this->resp(1,'faq details found',['faq'=>$faq],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addFaq(Request $request){
        $data = $request->all();
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $id = $data['id'] ?? null;
        $faq = new Faq();
        if ($id != null){
            $faq = Faq::query()->where('id','=',$id)->first();
            if (!$faq){
                return redirect(route('faq'))->with('error',  "Faq does not exist")->withInput();
            }
        }
        $faq->fill($data)->save();
        if ($id != null){
            return redirect(route('faq'))->with('success',"Faq updated successfully!");
        }
        return redirect(route('faq'))->with('success',"Faq added successfully!");
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
            $faq = Faq::query()
                ->where("id", "=", $id)
                ->where('status','!=','2')
                ->first();
            if (!$faq) {
                return redirect(route('faq'))->with("error", "Faq not found");
            }
            $faq->status = $status;
            if ($faq->save()) {
                if ($status == 0){
                    return redirect(route('faq'))->with("success", "Faq is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('faq'))->with("success", "Faq is activated successfully.");
                }
                return redirect(route('faq'))->with("success", "Faq is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('faq'))->with("error", $exception->getMessage());
        }
    }
}
