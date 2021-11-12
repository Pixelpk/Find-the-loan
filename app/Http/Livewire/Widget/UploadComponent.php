<?php

namespace App\Http\Livewire\Widget;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadComponent extends Component
{
    use WithFileUploads;
    public $main_type;
    public $loan_type_id;
    public $images;
    public $getImages = [];
    public $apply_loan;
    public $label;
    public $keyvalue;
    public $share_holder;
    public $modell;
    
    protected $listeners = [
        'getImage'
    ];
    
    public function render()
    {
        $this->getImage();
        return view('livewire.widget.upload-component');
    }
    public function updatedImages()
    {
        $this->validate([
            "images.*" =>'required|mimes:jpg,jpeg,png,pdf',
        ]);
        
        foreach ($this->images as $image) {
            $media = new Media();
            $media->model = $this->modell;
            $media->key = $this->keyvalue;
            $media->share_holder = $this->share_holder;
            $media->image =  $image->store(date('Y').'/'.date('m').'/'.date('d'));
            $media->orignal_name =  $image->getClientOriginalName();
            if($this->apply_loan){
                $media->apply_loan_id  = $this->apply_loan->id;
            }
            $media->save();
            $this->getImage();
            $this->emit('documentReq', 'pass');
        }
        
    }
    public function getImage()
    {   
        $this->getImages = Media::where('apply_loan_id', $this->apply_loan->id)
        ->where('model', $this->modell)
        ->where('key', $this->keyvalue)
        ->where('share_holder', $this->share_holder)
        ->where('model_id', 0)
        ->get();
        if(sizeof($this->getImages) > 0){
            $this->emit('documentReq', 'pass');
        }
       
    }
    public function removePhoto(Media $media)
    {
      
        if(Storage::exists($media->image)) {
            Storage::delete($media->image);
        }
        Media::find($media->id)->delete();
        $this->getImage();
        if(sizeof($this->getImages) == 0){
            $this->emit('documentReq', '');
        }
    }
}
