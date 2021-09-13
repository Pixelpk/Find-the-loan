@if(Route::currentRouteName() == 'faq')
    <div class="modal fade bs-example-modal-center" id="FaqModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                            <textarea required id="faq_answer" name="answer" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="faq_modal_btn" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endif

@if(Route::currentRouteName() == 'finance-partners')
    <div class="modal fade bs-example-modal-center" id="FinancePartnerModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                            <input type="password" required id="partner_password" name="password" minlength="6" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Partner image:</label>
                            <br>
                            <label class="label" data-toggle="tooltip" title="Select partner image">
                                <img id="partner_image" class="rounded avatar"
                                     src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                     style="width: 120px;height: auto;cursor: pointer;">
                                <input type="file" required onchange="showImage(this)" class="sr-only img-crop" input-id="1" id="partner-image-file" name="image"
                                       value="" accept="image/*">
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="partner_modal_btn" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-example-modal-center" id="EditFinancePartnerModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="partner_modal_heading">Edit Finance partner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="partner-form" method="post" action="{{ route('update-partner') }}" enctype="multipart/form-data">
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
                            <label for="" class="control-label mb-10">Partner image:</label>
                            <br>
                            <label class="label" data-toggle="tooltip" title="Select partner image">
                                <img id="edit_partner_image" class="rounded avatar"
                                     src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                     style="width: 120px;height: auto;cursor: pointer;">
                                <input type="file" onchange="showImage(this)" class="sr-only img-crop" input-id="1" id="partner-image-file" name="image"
                                       value="" accept="image/*">
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="partner_modal_btn" class="btn btn-primary">Update</button>
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
    <div class="modal fade bs-example-modal-center" id="BlogModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                            <textarea name="description" class="form-control ckeditor" id="blog_description" required ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Blog image:</label>
                            <br>
                            <label class="label" data-toggle="tooltip" title="Select blog image">
                                <img id="faq_image" class="rounded avatar"
                                     src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                     style="width: 120px;height: auto;cursor: pointer;">
                                <input type="file" id="faq-image-file" required onchange="showImage(this)" class="sr-only img-crop" name="image"
                                       value="" accept="image/*">
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="blog_modal_btn" class="btn btn-primary">Add</button>
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
    <div class="modal fade bs-example-modal-center" id="TestimonialModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="testimonial_modal_heading">Add Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="testimonial-form" method="post" action="{{ route('add-testimonial') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="update_testimonial_id">
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Review By:</label>
                            <input type="text" required id="review_by" name="review_by" class="form-control">
                        </div>
                        <div class="form-group">
                            <h5>Review</h5>
                            <textarea name="review" class="form-control ckeditor" id="review" required ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Reviewer Image image:</label>
                            <br>
                            <label class="label" data-toggle="tooltip" title="Select blog image">
                                <img id="reviewer_image" class="rounded avatar"
                                     src="{{ asset('assets/images/no_image.png') }}" alt="avatar"
                                     style="width: 120px;height: auto;cursor: pointer;">
                                <input type="file" id="reviewer-image-file" onchange="showImage(this)" class="sr-only img-crop" name="image"
                                       value="" accept="image/*">
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="testimonial_modal_btn" class="btn btn-primary">Add</button>
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
    <div class="modal fade bs-example-modal-center" id="LoanTypeModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="loan_type_modal_heading">Add Loan Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loan-type-form" method="post" action="{{ route('add-loan-type') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="update_loan_type_id">
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Select Main type</label>
                            <select class="form-control" name="main_type" id="loan_main_type">
                                @php
                                    $main_types = loanMainTypes();
                                @endphp
                                @for($i=1;$i<count($main_types);$i++)
                                    <option value="{{$i}}">{{ getLoanMainType($i) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Type name:</label>
                            <input type="text" required id="loan_type_name" name="type_name" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="loan_type_modal_btn" class="btn btn-primary">Add</button>
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
    <div class="modal fade bs-example-modal-center" id="LoanSubTypeModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="loan_subtype_modal_heading">Add Loan sub Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loan-subtype-form" method="post" action="{{ route('add-loan-subtype') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="update_loan_subtype_id">
                        <input type="hidden" name="parent_id" value="{{$id}}">
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Type name:</label>
                            <input type="text" required id="loan_subtype_name" name="type_name" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="loan_subtype_modal_btn" class="btn btn-primary">Add</button>
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
    <div class="modal fade bs-example-modal-center" id="LoanReasonModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="loan_reason_modal_heading">Add Loan reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loan-reason-form" method="post" action="{{ route('add-loan-reason') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="update_loan_reason_id">
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Reason</label>
                            <input type="text" required id="loan_reason" name="reason" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="loan_reason_modal_btn" class="btn btn-primary">Add</button>
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
    <div class="modal fade bs-example-modal-center" id="CompanyStructureModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="company_structure_modal_heading">Add company structure type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="company-structure-form" method="post" action="{{ route('add-company-structure') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="update_company_structure_id">
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Type name</label>
                            <input type="text" required id="structure_type" name="structure_type" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="company_structure_modal_btn" class="btn btn-primary">Add</button>
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
    <div class="modal fade bs-example-modal-center" id="SectorModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="sector_modal_btn" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endif
