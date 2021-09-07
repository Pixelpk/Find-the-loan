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
                        <input type="hidden" name="id" id="update_partner_id">
                        <div class="form-group">
                            <label for="" class="control-label mb-10">Name:</label>
                            <input type="text" required id="partner_name" name="name" class="form-control">
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
@endif
