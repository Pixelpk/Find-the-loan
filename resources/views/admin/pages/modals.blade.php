@if(Route::currentRouteName() == 'faq')
<div class="modal fade bs-example-modal-center" id="FaqModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="faq_modal_heading">Add faq</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="faq-form" method="post" action="{{ route('add-faq') }}">
                    @csrf
                    <input type="hidden" name="id" id="update_faq_id">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Question:</label>
                        <textarea required id="faq_question" name="question" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Answer:</label>
                        <textarea required id="faq_answer" name="answer" class="form-control ckeditor"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="faq_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade bs-example-modal-center" id="sortFaqModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="faq_modal_heading">Sort Faq</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height:350px;overflow:auto">
                <ul id="sortable">
                    @foreach($items as $key => $item)
                    <li class='ui-state-default' id='{{$item->id}}' sort_id[]='{{$key}}'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>{{ $item->question }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" id="submitFaqSort" class="btn btn-primary btn-round" style="float: right;margin-top: 5px;">Sort</a>
            </div>
        </div>
    </div>
</div>

@endif

@if(Route::currentRouteName() == 'finance-partners')
<div class="modal fade bs-example-modal-center" id="FinancePartnerModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="partner_modal_heading">Add Finance partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="partner-form" method="post" action="{{ route('add-partner') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Name:</label>
                        <input type="text" required id="partner_name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Email:</label>
                        <input type="email" required id="partner_email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Phone:</label>
                        <input type="text" required id="partner_phone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Password:</label>
                        <input type="password" required id="partner_password" name="password" minlength="6"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Min quantum:</label>
                        <input type="number" required id="min_quantum" name="min_quantum" min="0"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Max quantum:</label>
                        <input type="number" required id="max_quantum" name="max_quantum" min="0"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Type:</label>
                        <select required class="form-control" name="type" id="partner_type">
                            <option value="1">Bank</option>
                            <option value="2">Excluded moneylender</option>
                            {{-- <option value="3">Fintech</option> --}}
                            <option value="3">Moneylender</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Company structure:</label>
                        <select required class="form-control" name="company_structure_id" id="partner_company_structure">
                            @foreach($structures as $structure)
                            <option value="{{$structure->id}}">{{ $structure->structure_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Loan type:</label>
                        <select required style="width: 100%;" multiple class="form-control select2" name="loan_type_id[]" id="partner_loan_type">
                            @foreach($loan_types as $type)
                                <option value="{{$type->id}}">{{ $type->sub_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10 select2">Type of properties:</label>
                        <select multiple style="width: 100%;" class="form-control select2" name="property_types[]" id="property_types">
                                <option value="1">Commercial Vehicle – Cars, lorries, trucks etc</option>
                                <option value="2">Industry Vehicle – Cranes, forklift, Tractors etc</option>
                                <option value="3">Other Commercial & Industrial Equipment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10 select2">Type of equipments:</label>
                        <select multiple style="width: 100%;" class="form-control select2" name="equipment_types[]" id="equipment_types">
                            <option value="1">Office Equipment</option>
                            <option value="2">Other Commercial & Industrial Equipment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Length of incorporation</label>
                        <input required type="number" min="0" class="form-control" name="length_of_incorporation" id="length_of_incorporation">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">% of local shareholding required</label>
                        <input required type="number" min="0" class="form-control" name="local_shareholding" id="local_shareholding">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Subsidiaries</label>
                        <input required type="number" min="0" class="form-control" name="subsidiaries" id="subsidiaries">
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="cbs_member" id="cbs_member">
                        <label class="custom-control-label" for="cbs_member">CBS member</label>
                    </div>

                    <div class="form-group">
                        <label class="control-label mb-10">Terms & Conditions</label>
                        <textarea name="terms_condition" class="form-control ckeditor" id="partner_terms_condition"
                                  required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label mb-10">Partner image:</label>
                        <br>
                        <label class="label" data-toggle="tooltip" title="Select partner image">
                            <img id="partner_image" class="rounded avatar"
                                src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                style="width: 120px;height: auto;cursor: pointer;">
                            <input type="file" required onchange="showImage(this)" class="sr-only img-crop" input-id="1"
                                id="partner-image-file" name="image" value="" accept="image/*">
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="partner_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade bs-example-modal-center" id="EditFinancePartnerModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="partner_modal_heading">Edit Finance partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="partner-form" method="post" action="{{ route('update-partner') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update_partner_id">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Name:</label>
                        <input type="text" required id="edit_partner_name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Phone:</label>
                        <input type="text" required id="edit_partner_phone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Password:</label>
                        <input type="password" id="edit_partner_password" name="password" minlength="6"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Min quantum:</label>
                        <input type="number" required id="edit_min_quantum" name="min_quantum" min="0"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Max quantum:</label>
                        <input type="number" required id="edit_max_quantum" name="max_quantum" min="0"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Type:</label>
                        <select required class="form-control" name="type" id="edit_partner_type">
                            <option value="1">Bank</option>
                            <option value="2">Excluded moneylender</option>
                            {{-- <option value="3">Fintech</option> --}}
                            <option value="3">Moneylender</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Company structure:</label>
                        <select class="form-control" name="company_structure_id" id="edit_partner_company_structure">
                            @foreach($structures as $structure)
                                <option value="{{$structure->id}}">{{ $structure->structure_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Loan type:</label>
                        <select multiple style="width: 100%;" class="form-control select2" name="loan_type_id[]" id="edit_partner_loan_type">
                            @foreach($loan_types as $type)
                                <option value="{{$type->id}}">{{ $type->sub_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Type of properties:</label>
                        <select required style="width: 100%;" multiple class="form-control mb-10 select2" name="property_types[]" id="edit_property_types">
                                <option value="1">Commercial Vehicle – Cars, lorries, trucks etc</option>
                                <option value="2">Industry Vehicle – Cranes, forklift, Tractors etc</option>
                                <option value="3">Other Commercial & Industrial Equipment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10 ">Type of equipments:</label>
                        <select required style="width: 100%;" multiple class="form-control select2" name="equipment_types[]" id="edit_equipment_types">
                            <option value="1">Office Equipment</option>
                            <option value="2">Other Commercial & Industrial Equipment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Length of incorporation</label>
                        <input type="number" min="0" class="form-control" name="length_of_incorporation" id="edit_length_of_incorporation">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">% of local shareholding required</label>
                        <input type="number" min="0" class="form-control" name="local_shareholding" id="edit_local_shareholding">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Subsidiaries</label>
                        <input type="number" min="0" class="form-control" name="subsidiaries" id="edit_subsidiaries">
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10">Terms & Conditions</label>
                        <textarea name="terms_condition" class="form-control ckeditor" id="edit_partner_terms_condition"
                                  required></textarea>
                    </div>
                   <div class="custom-control custom-switch">
                       <input type="checkbox" class="custom-control-input" name="cbs_member" id="edit_cbs_member">
                       <label class="custom-control-label" for="edit_cbs_member">CBS member</label>
                   </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Partner image:</label>
                        <br>
                        <label class="label" data-toggle="tooltip" title="Select partner image">
                            <img id="edit_partner_image" class="rounded avatar"
                                src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                style="width: 120px;height: auto;cursor: pointer;">
                            <input type="file" onchange="showImage(this)" class="sr-only img-crop" input-id="1"
                                id="partner-image-file" name="image" value="" accept="image/*">
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="partner_modal_btn" class="btn admin-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
@if(Route::currentRouteName() == 'blogs')
<div class="modal fade bs-example-modal-center" id="BlogModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="blog_modal_heading">Add Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="blog-form" method="post" action="{{ route('add-blog') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update_blog_id">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Title:</label>
                        <input type="text" required id="blog_title" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10">Blog description</label>
                        <textarea name="description" class="form-control ckeditor" id="blog_description"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Blog image:</label>
                        <br>
                        <label class="label" data-toggle="tooltip" title="Select blog image">
                            <img id="blog_image" class="rounded avatar" src="{{ asset('assets/images/no_image.png') }}"
                                alt="avatar" style="width: 120px;height: auto;cursor: pointer;">
                            <input type="file" id="blog-image-file" required onchange="showImage(this)"
                                class="sr-only img-crop" name="image" value="" accept="image/*">
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="blog_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif

@if(Route::currentRouteName() == 'testimonials')
<div class="modal fade bs-example-modal-center" id="TestimonialModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="testimonial_modal_heading">Add Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="testimonial-form" method="post" action="{{ route('add-testimonial') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update_testimonial_id">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Review By:</label>
                        <input type="text" required id="review_by" name="review_by" class="form-control">
                    </div>
                    <div class="form-group">
                        <h5>Review</h5>
                        <textarea name="review" class="form-control ckeditor" id="review" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Reviewer Image image:</label>
                        <br>
                        <label class="label" data-toggle="tooltip" title="Select blog image">
                            <img id="reviewer_image" class="rounded avatar"
                                src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                style="width: 120px;height: auto;cursor: pointer;">
                            <input type="file" id="reviewer-image-file" onchange="showImage(this)"
                                class="sr-only img-crop" name="image" value="" accept="image/*">
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="testimonial_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
@if(Route::currentRouteName() == 'loan-types')
<div class="modal fade bs-example-modal-center" id="LoanTypeModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="loan_type_modal_heading">Add Loan Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loan-type-form" method="post" action="{{ route('add-loan-type') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update_loan_type_id">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Select Profile</label>
                        <select onchange="getLoanMainType()" class="form-control" name="profile" id="profile">
                            <option value="" hidden>Select</option>
                            @php
                            $main_types = loanProfile();
                            @endphp
                            @for($i=1;$i<count($main_types);$i++) <option value="{{$i}}">{{ getProfile($i) }}
                                </option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Select Main Type</label>
                        <select class="form-control" name="main_type_id" id="main_type">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label mb-10">Select Sub Type</label>
                        <input type="text" required id="sub_type" name="sub_type" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="loan_type_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
@if(Route::currentRouteName() == 'loan-subtypes')
<div class="modal fade bs-example-modal-center" id="LoanSubTypeModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="loan_subtype_modal_heading">Add Loan sub Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loan-subtype-form" method="post" action="{{ route('add-loan-subtype') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update_loan_subtype_id">
                    <input type="hidden" name="parent_id" value="{{$id}}">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Type name:</label>
                        <input type="text" required id="loan_subtype_name" name="type_name" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="loan_subtype_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
@if(Route::currentRouteName() == 'loan-reasons')
<div class="modal fade bs-example-modal-center" id="LoanReasonModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="loan_reason_modal_heading">Add Loan reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loan-reason-form" method="post" action="{{ route('add-loan-reason') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update_loan_reason_id">
                    <div class="form-group" id="reason_profile">
                        <label for="" class="control-label mb-10">Select Profile</label>
                        <select  required class="form-control" name="profile" id="loan_profile">
                            <option value="">Select</option>
                            @php
                            $main_types = loanProfile();
                            @endphp
                            @for($i=1;$i<count($main_types);$i++)
                                <option value="{{$i}}">{{ getProfile($i) }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group" id="loanType" style="display: none">
                        <label for="" class="control-label mb-10">Type Name</label>
                        <select  class="form-control" name="loan_type_id" id="loan_main_type">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Reason</label>
                        <input type="text" required id="loan_reason" name="reason" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="loan_reason_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
@if(Route::currentRouteName() == 'company-structure-type')
<div class="modal fade bs-example-modal-center" id="CompanyStructureModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="company_structure_modal_heading">Add company structure type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="company-structure-form" method="post" action="{{ route('add-company-structure') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update_company_structure_id">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Type name</label>
                        <input type="text" required id="structure_type" name="structure_type" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="company_structure_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
@if(Route::currentRouteName() == 'sectors')
<div class="modal fade bs-example-modal-center" id="SectorModal" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="sector_modal_heading">Add sector</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sector-form" method="post" action="{{ route('add-sector') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update_sector_id">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Name</label>
                        <input type="text" required id="sector_name" name="name" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="sector_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
@if(Route::currentRouteName() == 'partner-users')

<div class="modal fade bs-example-modal-center" id="PartnerUserModel" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="partner_user_modal_heading">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="partner-user-form" method="post" action="{{ route('add-partner-user') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Designation:</label>
                        <input type="text" required id="partner_user_designation" name="designation" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Name:</label>
                        <input type="text" required id="partner_user_name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Email:</label>
                        <input type="email" required id="partner_user_email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Phone:</label>
                        <input type="text" required id="partner_user_phone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Password:</label>
                        <input type="password" required id="partner_user_password" name="password" minlength="6"
                               class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="partner_user_modal_btn" class="btn admin-btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade bs-example-modal-center" id="EditPartnerUserModel" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="partner_user_modal_heading">Edit user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="partner-user-form" method="post" action="{{ route('update-partner-user') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="" id="edit_partner_user_id" name="id">
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Designation:</label>
                        <input type="text" required id="edit_partner_user_designation" name="designation" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Name:</label>
                        <input type="text" required id="edit_partner_user_name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Email:</label>
                        <input type="email" disabled required id="edit_partner_user_email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Phone:</label>
                        <input type="text" required id="edit_partner_user_phone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-10">Password:</label>
                        <input type="password" id="edit_partner_user_password" name="password" minlength="6"
                               class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endif
@if(Route::currentRouteName() == 'loan-applications')
    <div class="modal fade bs-example-modal-center" id="AssignApplicationsUser" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="loan_type_modal_heading">Assign selected enquires to user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <span style="color: red;display: none" id="assign_error">Please select any enquiry first</span>
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Select User</label>
                            <select class="form-control" name="user_id" id="assign_user_id">
                                @foreach($all_users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                            <button type="button" id="bulk_assign" class="btn admin-btn">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endif

@if(Route::currentRouteName() == 'loan-application-summary')
<div class="modal fade bs-example-modal-center" id="RejectReasonModel" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="loan_type_modal_heading">Select reject reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('reject-application') }}">
                        @csrf
                        <input type="hidden" name="apply_loan_id" id="reject_loan_id">
                    {{--<span style="color: red;display: none" id="assign_error">Please select any application first</span>--}}
                        <div class="form-group">
                            <label for="shown_to_customer">Shown to customer</label>
                            <select class="form-control" name="customer_reject_reason_id" id="shown_to_customer">
                                @foreach($customer_reject_reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="internal">Internal</label>
                            <select class="form-control" name="internal_reject_reason_id" id="internal">
                                @foreach($internal_reject_reasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="internal">Please eleborate</label>
                            <input class="form-control" name="other_reasons" required disabled  id="reject_other_reasons" value="">
                                
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn admin-c-btn" data-dismiss="modal">Close</button>
                            <button type="submit" id="" class="btn admin-btn">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @isset($application)
    @if (!$application->application_more_doc->isEmpty())
    <div class="modal fade bs-example-modal-center" id="ViewMoreDocDetails" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="faq_modal_heading">Requested more doc</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height:350px;overflow:auto">
                @foreach ($application->application_more_doc as $item)
                <div class="row">
                    @foreach ($item->more_doc_msg_desc as $item2)
                    <div class="col-md-3">
                        <h6>If any:</h6>
                        <span>{{ getYesNo($item2->if_any) }}</span>
                    </div>
                    <div class="col-md-3">
                        <h6>From:</h6>
                        <span>{{ $item2->from }}</span>
                    </div>
                    <div class="col-md-3">
                        <h6>To:</h6>
                        <span>{{ $item2->to }}</span>
                    </div>
                    <div class="col-md-3">
                        <h6>Within days:</h6>
                        <span>{{ $item2->within_days }}</span>
                    </div>
                    <div class="col-md-3">
                        <h6>Past Months:</h6>
                        <span>{{ $item2->past_months }}</span>
                    </div>
                    <div class="col-md-3">
                        <h6>Valid for:</h6>
                        <span>{{ $item2->valid_for }}</span>
                    </div>
                    <div class="col-md-3">
                        <h6>Document:</h6>
                        <span>{{ $item2->quote_additional_doc->info }}</span>
                    </div>
                    <div class="col-md-3">
                        <h6>Document of:</h6>
                        <span>{{ getDocumentOf($item2->document_of) }}</span>
                    </div>
                    <div class="col-md-3">
                        <h6>Reasons:</h6>
                        <span>
                            @foreach ($item2->more_doc_reasons as $reason)
                            {{ getMoreDocReason($reason) }},
                            @endforeach
                        </span>
                    </div>
                    @endforeach
                </div>
                <hr>
                @endforeach

            </div>
            <div class="modal-footer">
                {{-- <a href="javascript:void(0)" id="" class="btn btn-primary btn-round" style="float: right;margin-top: 5px;">Sort</a> --}}
            </div>
        </div>
    </div
    @endif
    @endisset


    @endif
