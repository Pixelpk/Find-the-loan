<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function blogs(Request $request){
        $data = $request->all();
        $data['items'] = Blog::query()
            ->orderBy('id','desc')
            ->where('status','!=',2)
            ->paginate(50);
        return view('admin.blogs.blogs',$data);
    }

    function blogDetail(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? '';
            $blog = Blog::where("id", "=", $id)
                ->first();
            if (!$blog){
                return $this->resp(0,'not found',['blog'=>null],401);
            }
            return $this->resp(1,'Blog details found',['blog'=>$blog],200);
        } catch (\Exception $exception) {
            return $this->resp(0,'error',['error'=>$exception->getMessage()],401);
        }
    }

    public function addBlog(Request $request){
        $data = $request->all();
//        dd($data);
        $id = $data['id'] ?? null;
        if ($id == null){
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|image',
            ]);
        }else{
            $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
        }

        $data['description'] = $data['description'] ?? null;
        $blog = new Blog();
        if ($id != null){
            $blog = Blog::query()->where('id','=',$id)->first();
            if (!$blog){
                return redirect(route('blogs'))->with('error',  "Blog does not exist")->withInput();
            }
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'blog' . date("Ymd-his") . '.' . $file->getClientOriginalExtension();
            $destinationPath = "uploads/blogImages/" . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath) && $data['image']) {
                if (file_exists($destinationPath)) {
                    $data['image'] = $filename;
                } else {
                    return redirect(route('blogs'))->with('error',"Oops. Something went wrong with image");
                }
            }
        }
        $data['slug'] = Str::of($data['title'])->slug('-');

        $blog->fill($data)->save();
        if ($id != null){
            return redirect(route('blogs'))->with('success',"Blog updated successfully!");
        }
        return redirect(route('blogs'))->with('success',"Blog added successfully!");
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
            $blog = Blog::query()
                ->where("id", "=", $id)
                ->where('status','!=','2')
                ->first();
            if (!$blog) {
                return redirect(route('blogs'))->with("error", "Blog not found");
            }
            $blog->status = $status;
            if ($blog->save()) {
                if ($status == 0){
                    return redirect(route('blogs'))->with("success", "Blog is deactivated successfully.");
                }elseif ($status == 1){
                    return redirect(route('blogs'))->with("success", "Blog is activated successfully.");
                }
                return redirect(route('blogs'))->with("success", "Blog is deleted successfully.");
            }
        } catch (\Exception $exception){
            return redirect(route('blogs'))->with("error", $exception->getMessage());
        }
    }
}
