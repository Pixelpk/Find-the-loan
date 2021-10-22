<?php

namespace App\Http\Livewire\Widget;

use App\Models\Attachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class AttachmentComponent extends Component
{
    public $label;
    public $apply_loan;
    public $main_type;
    public $loan_type_id;
    public $file;
    public $attachable_id;
    public $attachable_type;

    use WithFileUploads;
    public function render()
    {
        return view('livewire.widget.attachment-component');
    }
    public function updatedFile()
    {
        // dd($this->file);
        $this->validate([
            'file' => 'required',
            'attachable_id' => 'required|integer',
            'attachable_type' => 'required',
        ]);
      
        // save the file
        if ( $fileUid = $this->file->store(date('Y').'/'.date('m').'/'.date('d')) ) {
            return Attachment::create([
                'filename' => $this->file->getClientOriginalName(),
                'uid' => $fileUid,
                'size' => $this->file->getSize(),
                'mime' => $this->file->getMimeType(),
                'attachable_id' => $this->attachable_id,
                'attachable_type' => $this->attachable_type,
            ]);
        }

        // return response(['msg' => 'Unable to upload your file.'], 400);
    }

    /**
     * Remove . prefix so laravel validator can use allowed files
     * 
     * @return string
     */
    private function getAllowedFileTypes()
    {
        return str_replace('.', '', config('attachment.allowed', ''));
    }
}
