<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyStructure;
use Illuminate\Http\Request;

class CompanyStructureController extends Controller
{
    public function structureTypes(Request $request){
        $data = $request->all();
        $data['items'] = CompanyStructure::query()
            ->where('status','!=',2)
            ->orderBy('id','desc')
            ->paginate(50);
        return view('admin.company_structure.structure_types',$data);
    }

    function typeDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $type = CompanyStructure::where("id", "=", $id)
                ->first();
            if (!$type){
                return $this->resp(0,'not found',['structure_type'=>null],401);
            }
            return $this->resp(1,'Company structure type details found',['structure_type'=>$type],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addType(Request $request){
        $data = $request->all();
        $request->validate([
            'structure_type' => 'required',
        ]);
        $id = $data['id'] ?? null;
        $type = new CompanyStructure();
        if ($id != null){
            $type = CompanyStructure::query()->where('id','=',$id)->first();
            if (!$type){
                return redirect(route('company-structure-type'))->with('error',  "Company structure type not exist")->withInput();
            }
        }
        $type->fill($data)->save();
        if ($id != null){
            return redirect(route('company-structure-type'))->with('success',"Company structure type updated successfully!");
        }
        return redirect(route('company-structure-type'))->with('success',"Company structure type added successfully!");
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
            $type = CompanyStructure::query()
                ->where("id", "=", $id)
                ->where('status','!=','2')
                ->first();
            if (!$type) {
                return redirect(route('company-structure-type'))->with("error", "Company structure type not found");
            }
            $type->status = $status;
            if ($type->save()) {
                if ($status == 0){
                    return redirect(route('company-structure-type'))->with("success", "Company structure type is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('company-structure-type'))->with("success", "Company structure type is activated successfully.");
                }
                return redirect(route('company-structure-type'))->with("success", "Company structure type is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('company-structure-type'))->with("error", $exception->getMessage());
        }
    }
}
