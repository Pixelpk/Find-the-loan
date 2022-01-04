<section>
    <div class="row mt-3">

        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'NRIC Front'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\PersonalDetail'"
                :keyvalue="'personal_document_nric_front'" />
            @if(isset($customValidation['personal_document_nric_front']))
            <div style="color:red;">
                {{ $customValidation['personal_document_nric_front'] }}
            </div>
            @endif

        </div>
        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'NRIC Back'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\PersonalDetail'"
                :keyvalue="'personal_document_nric_back'" />
            @if(isset($customValidation['personal_document_nric_back']))
            <div style="color:red;">
                {{ $customValidation['personal_document_nric_back'] }}
            </div>
            @endif
        </div>

        @if(sizeof($personalDetail) > 0)

        <!-- <div class="col-md-1">
            <br>
            <br>
            <b>OR</b>
        </div> -->

        <div class="col-md-3 text-left d-flex align-middle">

            <div class="w-15" style="padding-top: 35px;"><b>OR</b></div>
            <div class="w-85" style="margin-left:10px;"><livewire:widget.upload-component :label="'Or Birth Certificate'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\PersonalDetail'" :keyvalue="'personal_document_birth_certificate'" />

                 @if(isset($customValidation['personal_document_birth_certificate']))
                <div style="color:red;">
                    {{ $customValidation['personal_document_birth_certificate'] }}
                </div>
                @endif

            </div>
        </div>

        @endif

        <div class="col-md-3 text-left  d-flex align-middle">
                <div class="w-10" style="padding-top: 35px;"><b>OR</b></div>
            <div class="w-90" style="margin-left:5px;">
                <livewire:widget.upload-component :label="'Passport/Indentity Card (Foreigner only)'"
                    :apply_loan="$apply_loan" :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                    :modell="'App\Models\PersonalDetail'" :keyvalue="'personal_document_passport_or_identity_card'" />
                @if(isset($customValidation['personal_document_passport_or_identity_card']))
                <div style="color:red;">
                    {{ $customValidation['personal_document_passport_or_identity_card'] }}
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <br>
            <p>Proof of address <br>(Required if you uploaded the Passport)</p>
            {{-- <br> --}}
        </div>
        <div class="col-md-6 text-left">
            <br>
            <br>
            Employment pass of at least 6 months validity
        </div>
        <div class="col-md-4 text-left">

            <livewire:widget.upload-component :label="'Phone/Electrical/Water Bill'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\PersonalDetail'" :keyvalue="'personal_document_proof_of_address'" />
            @if(isset($customValidation['personal_document_proof_of_address']))
            <div style="color:red;">
                {{ $customValidation['personal_document_proof_of_address'] }}
            </div>
            @endif
        </div>

        <div class="col-md-4 text-left">

            <livewire:widget.upload-component :label="'Front'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\PersonalDetail'"
                :keyvalue="'personal_document_employement_pass_front'" />
        </div>
        <div class="col-md-4">


            <livewire:widget.upload-component :label="'Back'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\PersonalDetail'"
                :keyvalue="'personal_document_employement_pass_back'" />

        </div>
        <div class="col-md-12">
            <br>
            <br>
            @if(isset($customValidation['bill']))
            <div style="color:red;">
                {{ $customValidation['bill'] }}
            </div>
            @endif
        </div>
        <div class="col-md-12">
            <br>
            <hr>
            <br>
        </div>
        <div class="col-md-6">

            <div class="form-check">
                <input value="self_employee" wire:model="employee_type" class="form-check-input" type="radio"
                    id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    For self employed or full commission earner
                </label>
            </div>
            <br>
        </div>
        <div class="col-md-6">


            <b>
            </b>
            <div class="form-check">
                <input wire:model="employee_type" value="for_employee" class="form-check-input" type="radio"
                    id="flexRadioDefault4">
                <label class="form-check-label" for="flexRadioDefault4">
                    For Employed
                </label>
            </div>
            <br>
        </div>
        @if($employee_type == 'self_employee')
        <div class="col-md-6 text-left">

            <label for="">Personal NOA (Notice of Assessment) (2 Years)</label>

            <br>
            <br>
            <livewire:widget.upload-component :label="'Latest'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\PersonalDetail'"
                :keyvalue="'personal_document_personal_noa_latest'" />
            @if(isset($customValidation['personal_document_personal_noa_latest']))
            <div style="color:red;">
                {{ $customValidation['personal_document_personal_noa_latest'] }}
            </div>
            @endif
        </div>
        <div class="col-md-6">

            <br>
            <br>
            <livewire:widget.upload-component :label="'Older'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\PersonalDetail'"
                :keyvalue="'personal_document_personal_noa_older'" />
            @if(isset($customValidation['personal_document_personal_noa_older']))
            <div style="color:red;">
                {{ $customValidation['personal_document_personal_noa_older'] }}
            </div>
            @endif
        </div>
        @endif

        @if($employee_type == 'for_employee')
        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'CPF Contribution History'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\PersonalDetail'" :keyvalue="'personal_document_cpf_contribution_history'" />
            @if(isset($customValidation['personal_document_cpf_contribution_history']))
            <div style="color:red;">
                {{ $customValidation['personal_document_cpf_contribution_history'] }}
            </div>
            @endif
        </div>
        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'Notice Of Assessment'" :apply_loan="$apply_loan"
                :main_type="$main_type" :loan_type_id="$loan_type_id" :share_holder="0"
                :modell="'App\Models\PersonalDetail'" :keyvalue="'personal_document_notice_assessment'" />
            @if(isset($customValidation['personal_document_notice_assessment']))
            <div style="color:red;">
                {{ $customValidation['personal_document_notice_assessment'] }}
            </div>
            @endif
        </div>

        <div class="col-md-3 text-left">
            <livewire:widget.upload-component :label="'Payslip'" :apply_loan="$apply_loan" :main_type="$main_type"
                :loan_type_id="$loan_type_id" :share_holder="0" :modell="'App\Models\PersonalDetail'"
                :keyvalue="'personal_document_pay_slip'" />
            @if(isset($customValidation['personal_document_pay_slip']))
            <div style="color:red;">
                {{ $customValidation['personal_document_pay_slip'] }}
            </div>
            @endif
        </div>
        @endif
        @if(sizeof($personalDetail) > 0)
        <div class="col-md-12">
            <br>
            <hr>
        </div>

        <div class="col-md-12">
            <br>
            He/she does not have any income proof as he/she is a
            <br>
            <br>

        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Student" wire:model="income_proof" class="form-check-input" type="radio"
                    id="flexRadioDefault100">
                <label class="form-check-label" for="flexRadioDefault100">
                    Student
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Homemaker" wire:model="income_proof" class="form-check-input" type="radio"
                    id="flexRadioDefault201">
                <label class="form-check-label" for="flexRadioDefault201">
                    Homemaker
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Retired" wire:model="income_proof" class="form-check-input" type="radio"
                    id="flexRadioDefault3201">
                <label class="form-check-label" for="flexRadioDefault3201">
                    Retired
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input value="Unemployed" wire:model="income_proof" class="form-check-input" type="radio"
                    id="flexRadioDefault4041">
                <label class="form-check-label" for="flexRadioDefault4041">
                    Unemployed
                </label>
            </div>
        </div>
        <div class="col-md-12">
            @error("income_proof")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-12">
            <br>
            <br>
            Relationship with Main Applicant

            <br>
            <br>

        </div>
        <div class="col-md-2">
            <div class="form-check">
                <input value="Spouse" wire:model="relation" class="form-check-input" type="radio"
                    id="flexRadioDefault11">
                <label class="form-check-label" for="flexRadioDefault11">
                    Spouse
                </label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check">
                <input value="Parent" wire:model="relation" class="form-check-input" type="radio"
                    id="flexRadioDefault22">
                <label class="form-check-label" for="flexRadioDefault22">
                    Parent
                </label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check">
                <input value="Sibling" wire:model="relation" class="form-check-input" type="radio"
                    id="flexRadioDefault33">
                <label class="form-check-label" for="flexRadioDefault33">
                    Sibling
                </label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check">
                <input value="Child" wire:model="relation" class="form-check-input" type="radio"
                    id="flexRadioDefault355">
                <label class="form-check-label" for="flexRadioDefault355">
                    Child
                </label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-check">
                <input value="other" wire:model="relation" class="form-check-input" type="radio"
                    id="flexRadioDefault356">
                <label class="form-check-label" for="flexRadioDefault356">
                    Other
                </label>
            </div>
        </div>
        @error("relation")
        <div style="color: red;">
            {{ $message }}
        </div>
        @enderror
        @endif
    </div>

    <div class="row mt-3 text-end">
        @if($relation == 'other')
        <div class="col-md 8">

        </div>
        <div class="col-md-4">
           <div class="mb-3 text-start">
            <label for="other_relation" class="form-label">
                Other Relation
            </label>
            <div class="input-form mb-3">
                <input wire:model="other_relation" type="text" class="form-control" aria-label="other_relation"
                    aria-describedby="basic-addon2">

            </div>
            @error("other_relation")
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
           </div>
        </div>
        @endif
    </div>

    <div class="row mt-3 text-start">
        <div class="col-md-12">
            <div class="text-left">
                <button  wire:loading.attr='disabled' class="btn"
                type="button" wire:target='goTolender' wire:click.prevent='goTolender'>
                    <div wire:loading wire:target="goTolender">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </div>
                    Save & Add joint applicant
                </button>
            </div>
        </div>
    </div>
    <div class="row mt-3 text-end">
        <div class="col-md-12">
            <button class="btn custom-info-btn" type="button" style="color: #6c6868 !important;">
                Why these documents ?
            </button>
           
            <button  wire:loading.attr='disabled' class="btn"
                type="button" wire:target='goToNextTab' wire:click.prevent='goToNextTab'>
                <div wire:loading wire:target="goToNextTab">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
                Save & Continue
            </button>
        </div>
    </div>
    <div class="row mt-3">
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
