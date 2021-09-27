<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function sectors(Request $request){
        $data = $request->all();
        $data['items'] = Sector::query()
            ->where('status','!=',2)
            ->orderBy('id','desc')
            ->paginate(50);
        return view('admin.sectors.sectors',$data);
    }

    function sectorDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $sector = Sector::where("id", "=", $id)
                ->first();
            if (!$sector){
                return $this->resp(0,'sector not found',['sector'=>null],401);
            }
            return $this->resp(1,'sector details found',['sector'=>$sector],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addSector(Request $request){
        $data = $request->all();
        $request->validate([
            'name' => 'required',
        ]);
        $id = $data['id'] ?? null;
        $sector = new Sector();
        if ($id != null){
            $sector = Sector::query()->where('id','=',$id)->first();
            if (!$sector){
                return redirect(route('sectors'))->with('error',  "Sector type not exist")->withInput();
            }
        }
        $sector->fill($data)->save();
        if ($id != null){
            return redirect(route('sectors'))->with('success',"Sector updated successfully!");
        }
        return redirect(route('sectors'))->with('success',"Sector added successfully!");
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
            $type = Sector::query()
                ->where("id", "=", $id)
                ->where('status','!=','2')
                ->first();
            if (!$type) {
                return redirect(route('sectors'))->with("error", "Sector not found");
            }
            $type->status = $status;
            if ($type->save()) {
                if ($status == 0){
                    return redirect(route('sectors'))->with("success", "Sector is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('sectors'))->with("success", "Sector is activated successfully.");
                }
                return redirect(route('sectors'))->with("success", "Sector is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('sectors'))->with("error", $exception->getMessage());
        }
    }
}
