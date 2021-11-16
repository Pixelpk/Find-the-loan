<?php

namespace App\Http\Livewire\Loan;

use App\Models\CompanyStructure;
use App\Models\LoanCompanyDetail;
use App\Models\LoanDocument;
use App\Models\LoanPersonShareHolder;
use App\Models\LoanStatement;
use App\Models\Sector;
use App\Models\ShareHolderDetail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Monarobase\CountryList\CountryListFacade;
class CompanyShareHolder extends Component
{
    public $share_holder_company_name;
    public $share_holder_company_year;
    public $share_holder_company_years;
    public $share_holder_company_month;
    public $share_holder_company_months;
    public $share_holder_percentage_shareholder;
    public $share_holder_number_of_share_holder;
    public $share_holder_company_structure_type_id;
    public $share_holder_sector_id;
    public $share_holder_number_of_employees;
    public $share_holder_revenue;
    public $share_holder_website;
    public $share_holder_photo;
    public $share_errorArray = [];
    public $share_holder_statement;
    public $share_holder_latest_year;
    public $share_holder_year_before;
    public $share_holder_listed_company_check;
    public $listed_company_check = 0;
    public $share_holder_profitable_latest_year;
    public $share_holder_profitable_before_year;
    public $share_holder_current_year;
    public $share_holder_subsidiary;
    public $share_holder_country;
    public $apply_loan;
    public $get_share_holder_type = [];
    public $checkShareHolder;
    public $chklsit=[];
    public $subtab;
    public $shareholderCompany;
    public $company_structure_types = [];
    public $sectors = [];
    public $main_type;
    public $images;
    public $company_year;

    public function mount()
    {
        $this->company_structure_types = CompanyStructure::where('status', 1)->get();

        $this->sectors = Sector::where('status', 1)->get();

        $this->countries = CountryListFacade::getList('en');
        $this->main_type = $this->apply_loan->main_type;

        $this->loan_type_id  = $this->apply_loan->loan_type_id ;

        $this->get_share_holder_type = ShareHolderDetail::where('apply_loan_id', $this->apply_loan->id)->get();
    }
    public function render()
    {
        return view('livewire.loan.company-share-holder');
    }

    public function getShareholderTypeId($id)
    {
        // $this->dispatchBrowserEvent('name-updated', ['newName' => 'All shareholder will be deleted if you update']);
        if($this->checkShareHolder[$id]){
            $LPSH=LoanPersonShareHolder::where('share_holder_detail_id', $id)->Where('apply_loan_id', $this->apply_loan->id)->first();
            if($LPSH){
                if($LPSH && Storage::exists($LPSH->nric_front)) {
                    Storage::delete($LPSH->nric_front);
                }
                if($LPSH && Storage::exists($LPSH->nric_back)) {
                    Storage::delete($LPSH->nric_back);
                }
                if($LPSH && Storage::exists($LPSH->nao_latest)) {
                    Storage::delete($LPSH->nao_latest);
                }
                if($LPSH && Storage::exists($LPSH->nao_older)) {
                    Storage::delete($LPSH->nao_older);
                }
                if($LPSH && Storage::exists($LPSH->passport)) {
                    Storage::delete($LPSH->passport);
                }
                $LPSH->delete();
            }
        }
        if(!$this->checkShareHolder[$id]){
            $LD = LoanDocument::where('share_holder', $id)->where('apply_loan_id', $this->apply_loan->id)->first();
            $LS = LoanStatement::where('share_holder', $id)->where('apply_loan_id', $this->apply_loan->id)->get();
            if($LS->count() > 0){
                foreach($LS as $LSDetail){
                    if(Storage::exists($LSDetail->statement)) {
                        Storage::delete($LSDetail->statement);
                    }
                }
                LoanStatement::where('share_holder', $id)->where('apply_loan_id', $this->apply_loan->id)->delete();
            }
            if($LD){
                if(Storage::exists($LD->statement)) {
                    Storage::delete($LD->statement);
                }
                if(Storage::exists($LD->latest_year)) {
                    Storage::delete($LD->latest_year);
                }
                if(Storage::exists($LD->year_before)) {
                    Storage::delete($LD->year_before);
                }
                if(Storage::exists($LD->current_year)) {
                    Storage::delete($LD->current_year);
                }
              
                $LD->delete();
            }
        }
        if($this->checkShareHolder[$id]){
            $shareholder = ShareHolderDetail::where('id', $id)->first();
            $shareholder->share_holder_type = 2;
            $shareholder->update();
        }else{
            $shareholder = ShareHolderDetail::where('id', $id)->first();
            $shareholder->share_holder_type = 1;
            $shareholder->update();
        }
        $this->get_share_holder_type = ShareHolderDetail::where('apply_loan_id', $this->apply_loan->id)->get();
        // dd($this->chklsit);
       
        // if($this->checkShareHolder[$id] == 1){

            if(sizeof($this->get_share_holder_type) > 0){
               
                foreach($this->get_share_holder_type as $key => $item){
                   
                    // if($id != $item->id){
                        // dd($key);
                        $this->chklsit[$item->id] = false;
                    // }
                }
                // dd($this->chklsit);
            }
           
            // dd($this->chklsit);
            
            
        // }
        
        // dd($this->checkShareHolder);
        // dd($id);
    }


    public function get_company_listed($id)
    {
        if($this->share_holder_listed_company_check[$id]){
            $this->chklsit[$id] = true;
        }else{
            $this->chklsit[$id] = false;
        }
        // dd($this->chklsit[$id]);
    }


    public function share_holder_document_store($id)
    {
       
        // foreach($this->get_share_holder_type as $item){
            // if($item['share_holder_type'] == 1){
                // dd($id);
                 $getsholder = ShareHolderDetail::where('id', $id)->first();
                //  dd( $getsholder);
                if($getsholder->share_holder_type == 1){
               
                    $this->validate([
                        "nric_front.$id" => isset($this->passport[$getsholder->id])  ? '' : 'image|required',
                        "nric_back.$id" => isset($this->passport[$getsholder->id])  ? '' : 'image|required',
                        "passport.$id" => isset($this->nric_front[$getsholder->id]) && isset($this->nric_back[$id]) ? '' : 'image|required',
                        "not_proof.$id" => isset($this->nao_latest[$getsholder->id]) && isset($this->nao_older[$id]) ? '' : 'required',
                        "nao_latest.$id" => isset($this->not_proof[$getsholder->id])  ? '' : 'image|required',
                        "nao_older.$id" => isset($this->not_proof[$getsholder->id])  ? '' : 'image|required',
                    ]);
                    // dd($this->passport[$getsholder->id]);
                    $LPSH = LoanPersonShareHolder::where('share_holder_detail_id',$getsholder->id)->where('apply_loan_id', $this->apply_loan->id)->first();
                    if($LPSH){
                        if($LPSH && Storage::exists($LPSH->nric_front)) {
                            Storage::delete($LPSH->nric_front);
                        }
                        if($LPSH && Storage::exists($LPSH->nric_back)) {
                            Storage::delete($LPSH->nric_back);
                        }
                        if($LPSH && Storage::exists($LPSH->nao_latest)) {
                            Storage::delete($LPSH->nao_latest);
                        }
                        if($LPSH && Storage::exists($LPSH->nao_older)) {
                            Storage::delete($LPSH->nao_older);
                        }
                        if($LPSH && Storage::exists($LPSH->passport)) {
                            Storage::delete($LPSH->passport);
                        }
                       
                        if($LPSH){
                            $LPSH->delete();
                        }
                    }
                    LoanPersonShareHolder::forceCreate([
                        'apply_loan_id' => $this->apply_loan->id,
                        'share_holder_detail_id' => $getsholder->id,
                        "nric_front" => isset($this->nric_front[$getsholder->id]) ?  $this->nric_front[$getsholder->id]->store('documents') : '',
                        "nric_back" => isset($this->nric_back[$getsholder->id]) ?  $this->nric_back[$getsholder->id]->store('documents') : '',
                        "passport" => isset($this->passport[$getsholder->id]) ?  $this->passport[$getsholder->id]->store('documents') : '',
                        "nao_latest" => isset($this->nao_latest[$getsholder->id]) ?  $this->nao_latest[$getsholder->id]->store('documents') : '',
                        "nao_older" => isset($this->nao_older[$getsholder->id]) ?  $this->nao_older[$getsholder->id]->store('documents') : '',
                        "not_proof" => isset($this->not_proof[$getsholder->id]) ?  $this->not_proof[$getsholder->id] : '',
                    ]);
                    $this->gernal['change_color'] = 'success';
                    $this->emit('alert', ['type' => 'success', 'message' => 'Shareholder person data saved.']);
                    $this->lenderflag = true;
                }
                if($getsholder->share_holder_type == 2)
                {
                    if(isset($this->share_holder_listed_company_check[$id]) && $this->share_holder_listed_company_check[$id]){
                        $this->validate([
                            "share_holder_company_name.$getsholder->id" => 'required',
                            "share_holder_country.$getsholder->id" => 'required',
                            "share_holder_subsidiary.$getsholder->id" => 'required|mimes:jpg,jpeg,png,pdf',
                           
                        ]);
                        $LCD = LoanCompanyDetail::where('share_holder',$getsholder->id)->where('apply_loan_id', $this->apply_loan->id)->first();
                        if($LCD){
                            $LCD->delete();
                        }
                        $LD = LoanDocument::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', $getsholder->id)->first();
                        if($LD && Storage::exists($LD->statement)) {
                            Storage::delete($LD->statement);
                        }
                        if($LD && Storage::exists($LD->latest_year)) {
                            Storage::delete($LD->latest_year);
                        }
                        if($LD && Storage::exists($LD->year_before)) {
                            Storage::delete($LD->year_before);
                        }
                        if($LD && Storage::exists($LD->current_year)) {
                            Storage::delete($LD->current_year);
                        }
                        if($LD){
                            $LD->delete();
                        }
                        $LS = LoanStatement::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', $getsholder->id)->get();
                        if($LS->count() > 0){
                            foreach($LS as $item){
                                if($item && Storage::exists($item->statement)) {
                                    Storage::delete($LD->statement);
                                }
                            }
                            LoanStatement::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', $getsholder->id)->delete();
                        }
                      
                        LoanCompanyDetail::forceCreate([
                            "apply_loan_id" => $this->apply_loan->id,
                            "share_holder" => $getsholder->id,
                            "company_name" => $this->share_holder_company_name[$getsholder->id],
                            "country" => $this->share_holder_country[$getsholder->id],
                            "subsidiary" => $this->share_holder_subsidiary[$getsholder->id]->store('documents'),
                        ]);
                        $this->emit('alert', ['type' => 'success', 'message' => 'Shareholder company data saved.']);
                        $this->lenderflag = true;
                        // $this->subtab = '2';
                        return;
                       
                    }
                    
                    // dd('asd');
                    $this->validate([
                        "share_holder_company_name.$getsholder->id" => 'required',
                        "share_holder_company_year.$getsholder->id" => 'required',
                        "share_holder_company_month.$getsholder->id" => 'required',
                        "share_holder_number_of_share_holder.$getsholder->id" => 'required',
                        "share_holder_sector_id.$getsholder->id" => 'required',
                        "share_holder_revenue.$getsholder->id" => 'required',
                        "share_holder_percentage_shareholder.$getsholder->id" => 'required',
                        "share_holder_company_structure_type_id.$getsholder->id" => 'required',
                        "share_holder_number_of_employees.$getsholder->id" => 'required',
                        "share_holder_website.$getsholder->id" => 'nullable',
                    ]);
                    if($this->share_holder_company_year[$getsholder->id] && $this->share_holder_company_month[$getsholder->id]){
                        $company_start_date = $this->share_holder_company_year[$getsholder->id].'/'.$this->share_holder_company_month[$getsholder->id];
                    }else{
                        $then_ts = strtotime($this->share_holder_company_years[$getsholder->id]."-01-01");
                        $then_year = date('Y', $then_ts);
                        $diff = date('Y') - $then_year;
                        if(strtotime('+' . $diff . ' years', $then_ts) > time()) $diff--;
                        $company_start_date = $diff.'/'.$this->share_holder_company_months[$getsholder->id];
                       
                    }
                    $LCD = LoanCompanyDetail::where('share_holder',$getsholder->id)->where('apply_loan_id', $this->apply_loan->id)->first();
                    if($LCD){
                        $LCD->delete();
                    }
                    LoanCompanyDetail::forceCreate([
                        "apply_loan_id" => $this->apply_loan->id,
                        "share_holder" => $getsholder->id,
                        "listed_company_check" => $this->listed_company_check,
                        // "company_start_date" =>  $this->share_holder_company_year[$getsholder->id].'/'.$this->share_holder_company_month[$getsholder->id],
                        "company_start_date" =>  $company_start_date,
                        "revenue" => $this->share_holder_revenue[$getsholder->id],
                        "number_of_share_holder" => $this->share_holder_number_of_share_holder[$getsholder->id],
                        "sector_id" => $this->share_holder_sector_id[$getsholder->id],
                        "percentage_shareholder" => $this->share_holder_percentage_shareholder[$getsholder->id],
                        "company_structure_type_id" => $this->share_holder_company_structure_type_id[$getsholder->id],
                        "number_of_employees" => $this->share_holder_number_of_employees[$getsholder->id],
                        "company_name" => $this->share_holder_company_name[$getsholder->id],
                        "website" => isset($this->share_holder_website[$getsholder->id]) ? $this->share_holder_website[$getsholder->id] : '',
                    ]);
                    $this->emit('alert', ['type' => 'success', 'message' => 'Shareholder company data saved.']);
                    $this->lenderflag = true;
                    $this->subtab = '2';
                }
                $this->lenderflag = true;
                $this->shareholderCompany = true;
    }

    public function  shareHolderResetComapny($shreholder)
    {
        $this->share_holder_company_years[$shreholder] = '';
        $this->share_holder_company_months[$shreholder] = '';
    }

    public function company_share_holder_documents_store($id)
    {
        $getsholder = ShareHolderDetail::where('id', $id)->first();
        if($getsholder->share_holder_type == 2){
            $this->share_errorArray = [];
            if(!isset($this->share_holder_statement[$getsholder->id])){
                for ($x = 2; $x <= 7; $x++){
                    $montn = date("M", strtotime( date( 'Y-m-01' )." -$x months"));
                    if(isset($this->share_holder_photo[$getsholder->id][$montn])){
                        if($montn == $this->share_holder_photo[$getsholder->id][$montn]){
                        }
                    }
                    else{
                        array_push($this->share_errorArray, $montn);
                    }
                }
            }
            if(sizeof($this->share_errorArray) > 0){
                return;
            }
            $this->validate([
                "share_holder_statement.$getsholder->id" => isset($this->share_holder_photo[$getsholder->id])  > 0 ? '' : 'image|required',
                // "share_holder_statement.$getsholder->id" => 'image|required',
                "share_holder_latest_year.$getsholder->id" => 'image|required',
                "share_holder_year_before.$getsholder->id" => $this->share_holder_company_year[$getsholder->id] >= 3 ?  'image|required' : '',
                "share_holder_profitable_latest_year.$getsholder->id" => 'required',
                "share_holder_profitable_before_year.$getsholder->id" => 'required',
                // 'current_year' => 'image',
            ]);
            $loanComanyDetaol = LoanCompanyDetail::where('apply_loan_id', $this->apply_loan->id)
            ->where('share_holder',$getsholder->id)
            ->first();
            // dd($this->share_holder_profitable_latest_year[$getsholder->id]);
            $loanComanyDetaol->profitable_latest_year  = $this->share_holder_profitable_latest_year[$getsholder->id];
            $loanComanyDetaol->profitable_before_year  = $this->share_holder_profitable_before_year[$getsholder->id];
            $loanComanyDetaol->optional_revenuee  = isset($this->share_holder_optional_revenuee[$getsholder->id]) ?  $this->share_holder_optional_revenuee[$getsholder->id] : '';
            $loanComanyDetaol->update();
            $LD = LoanDocument::where('apply_loan_id', $this->apply_loan->id)->where('share_holder', $getsholder->id)->first();
            if($LD && Storage::exists($LD->statement)) {
                Storage::delete($LD->statement);
            }
            if($LD && Storage::exists($LD->latest_year)) {
                Storage::delete($LD->latest_year);
            }
            if($LD && Storage::exists($LD->year_before)) {
                Storage::delete($LD->year_before);
            }
            if($LD && Storage::exists($LD->current_year)) {
                Storage::delete($LD->current_year);
            }
            if($LD){
                $LD->delete();
            }
            LoanDocument::forceCreate([
                'apply_loan_id' => $this->apply_loan->id,
                'share_holder' => $getsholder->id,
                'statement' => isset($this->share_holder_statement[$getsholder->id]) ?  $this->share_holder_statement[$getsholder->id]->store('documents') : '',
                'latest_year' => $this->share_holder_latest_year[$getsholder->id]->store('documents'),
                'year_before' => $this->share_holder_company_year[$getsholder->id] >= 3 ? $this->share_holder_year_before[$getsholder->id]->store('documents') : '',
                'current_year' => isset($this->share_holder_current_year[$getsholder->id]) ? $this->share_holder_current_year[$getsholder->id]->store('documents') : '',

            ]);
            if(isset($this->share_holder_statement[$getsholder->id])){
                $LSI = LoanStatement::where('apply_loan_id', $this->apply_loan->id)->get();
                if($LSI->count() > 0){
                    foreach($LSI as $item){
                        if($item && Storage::exists($item->statement)) {
                            Storage::delete($item->statement);
                        }
                    }
                    LoanStatement::where('apply_loan_id', $this->apply_loan->id)->delete();
                }
            }
            if(sizeof($this->share_errorArray) == 0 && !isset($this->share_holder_statement[$getsholder->id])){
                foreach($this->share_holder_photo[$getsholder->id] as $key =>  $item){
                    $LSI = LoanStatement::where('apply_loan_id', $this->apply_loan->id)->where('month', $key)->where('share_holder',  $getsholder->id)->first();
                    if($LSI && Storage::exists($LSI->statement)) {
                        Storage::delete($LSI->statement);
                    }
                    if($LSI){
                        $LSI->delete();
                    }
                    LoanStatement::forceCreate([
                        'apply_loan_id' => $this->apply_loan->id,
                        'month' => $key,
                        'share_holder' => $id,
                        'statement' => $item->store('documents'),
                    ]);
                }
            }
            $this->emit('alert', ['type' => 'success', 'message' => 'Shareholder Company documents added successfully.']);

           
            
        }
    }
}
