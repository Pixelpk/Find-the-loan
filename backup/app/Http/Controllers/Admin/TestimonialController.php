<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function testimonials(Request $request){
        $data = $request->all();
        $data['items'] = Testimonial::query()
            ->orderBy('id','desc')
            ->where('status','!=',2)
            ->paginate(50);
        return view('admin.testimonials.testimonials',$data);
    }

    function testimonialDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $testimonial = Testimonial::where("id", "=", $id)
                ->first();
            if (!$testimonial){
                return $this->resp(0,'not found',['testimonial'=>null],401);
            }
            return $this->resp(1,'testimonial details found',['testimonial'=>$testimonial],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addTestimonial(Request $request){
        $data = $request->all();
//        dd($data);
        $id = $data['id'] ?? null;
        $request->validate([
            'review' => 'required',
        ]);


        $data['description'] = $data['description'] ?? null;
        $data['review_by'] = $data['review_by'] ?? null;
        $testimonial = new Testimonial();
        if ($id != null){
            $testimonial = Testimonial::query()->where('id','=',$id)->first();
            if (!$testimonial){
                return redirect(route('testimonials'))->with('error',  "Testimonial does not exist")->withInput();
            }
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'testimonial' . date("Ymd-his") . '.' . $file->getClientOriginalExtension();
            $destinationPath = "uploads/testimonialImages/" . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath) && $data['image']) {
                if (file_exists($destinationPath)) {
                    $data['reviewer_image'] = $filename;
                } else {
                    return redirect(route('testimonials'))->with('error',"Oops. Something went wrong with image");
                }
            }
        }

        $testimonial->fill($data)->save();
        if ($id != null){
            return redirect(route('testimonials'))->with('success',"Testimonial updated successfully!");
        }
        return redirect(route('testimonials'))->with('success',"Testimonial added successfully!");
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
            $testimonial = Testimonial::query()
                ->where("id", "=", $id)
                ->where('status','!=','2')
                ->first();
            if (!$testimonial) {
                return redirect(route('testimonials'))->with("error", "Blog not found");
            }
            $testimonial->status = $status;
            if ($testimonial->save()) {
                if ($status == 0){
                    return redirect(route('testimonials'))->with("success", "Testimonial is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('testimonials'))->with("success", "Testimonial is activated successfully.");
                }
                return redirect(route('testimonials'))->with("success", "Testimonial is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('testimonials'))->with("error", $exception->getMessage());
        }
    }
}
