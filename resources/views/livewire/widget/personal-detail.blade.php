<section>
    <div class="row">

        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'NRIC Front'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'\App\Models\PersonalDetail'"
                :keyvalue="'personal_document_nric_front'" />
        </div>
        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'NRIC Back'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'\App\Models\PersonalDetail'" :keyvalue="'personal_document_nric_back'" />
        </div>
        <div class="col-md-1">
            <br>
            <br>
            <b>OR</b>
        </div>
        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'Passport/Indentity Card (Foreigner only)'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'\App\Models\PersonalDetail'" :keyvalue="'personal_document_passport_or_identity_card'" />
        </div>
        <div class="col-md-12">
            <hr>
            
            <b>For self employed or full commission earner
            </b>
        </div>
        <div class="col-md-6 text-left">
            <br>
            <label for="">Personal NOA (Notice of Assessment) (2 Years)</label>
            <br>
            <br>
            <livewire:widget.upload-component :label="'Latest'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'\App\Models\PersonalDetail'" :keyvalue="'personal_document_personal_noa_latest'" />
        </div>
        <div class="col-md-3 ">
           
            <br>
            <br>
            <br>
            <livewire:widget.upload-component :label="'Older'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'\App\Models\PersonalDetail'" :keyvalue="'personal_document_personal_noa_older'" />
        </div>
        <div class="col-md-12">
            <hr>
            <b>For Employed
            </b>
            <p>
                <ul>
                    <li>3 months pay slip OR 12 months CPF Contribution History</li>
                    <li>Attach employement letter if is it less than 3 months</li>
                    <li>Latest notice of assessment</li>
                </ul>
            </p>
        </div>
        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'CPF Contribution History'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'\App\Models\PersonalDetail'"
                :keyvalue="'personal_document_cpf_contribution_history'" />
        </div>
        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'Notice Of Assessment'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'\App\Models\PersonalDetail'" :keyvalue="'personal_document_notice_assessment'" />
        </div>
       
        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'Payslip'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'\App\Models\PersonalDetail'" :keyvalue="'personal_document_pay_slip'" />
        </div>
        <div class="col-md-12 text-left">
            <livewire:widget.upload-component :label="'Or Birth Certificate'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'\App\Models\PersonalDetail'" :keyvalue="'personal_document_birth_certificate'" />
        </div>
        <div class="col-md-12">
            He/she does not have any income proof as he/she is a
            <br>
            <br>

        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Student" wire:model="income_proof" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Student
                </label>
              </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Homemaker" wire:model="income_proof" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Homemaker
                </label>
              </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Retired" wire:model="income_proof" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                <label class="form-check-label" for="flexRadioDefault3">
                    Retired
                </label>
              </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Unemployed" wire:model="income_proof" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                <label class="form-check-label" for="flexRadioDefault4">
                    Unemployed
                </label>
              </div>
        </div>
        <div class="col-md-12">
            <br>
            <br>
            Relationship with Main Applicant

            <br>
            <br>

        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Spouse" wire:model="relation" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11">
                <label class="form-check-label" for="flexRadioDefault11">
                    Spouse
                </label>
              </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Parent" wire:model="relation" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault22">
                <label class="form-check-label" for="flexRadioDefault22">
                    Parent    
                </label>
              </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Sibling" wire:model="relation" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault33">
                <label class="form-check-label" for="flexRadioDefault33">
                    Sibling    
                </label>
              </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Child" wire:model="relation" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault355">
                <label class="form-check-label" for="flexRadioDefault355">
                    Child    
                </label>
              </div>
        </div>
        <div class="col-12">
            <br>
            <button class="btn" type="button" wire:target="store" wire:click.prevent="store">
                <span wire:loading="" wire:target="store" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                Add Detail
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type</th>
                      
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personalDetail as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->type }}</td>
                       
                      
                        <td><button wire:click="deleteRecord({{ $item->id }})" style="background: red;"
                                class="btn">Delete</button></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>

