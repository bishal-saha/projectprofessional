
    <div class="card">
        <div class="card-body text-center avatar-wrapper">
            <div class="spinner">
                <div class="spinner-dot"></div>
                <div class="spinner-dot"></div>
                <div class="spinner-dot"></div>
            </div>
            <div id="avatar"></div>
            <!-- display image -->
            <div class="card-img-actions mb-3 avatar-preview">
                <img class="img-fluid rounded-circle" src="{{ $edit ? $user->present()->avatar : url('public/images/profile.png') }}" alt="" width="150">
                <!-- display name -->
                <h6 class="font-weight-semibold mb-0">{{ $user->present()->nameOrEmail }}</h6>
            </div>

            <!-- display button to change photo -->
            <button  id="change-picture" type="button" class="btn bg-teal-400 btn-block mb-2 legitRipple mt-3" data-toggle="modal" data-target="#choose-modal">
                <i class="fa fa-camera mr-2"></i> Change Photo
            </button>
            <!-- display button to save photo or cancel -->
            <div class="row avatar-controls d-none">
                <div class="col-md-6">
                    <button id="cancel-upload" type="button" class="btn bg-pink-400 btn-block mb-2 legitRipple mt-3" data-toggle="modal" data-target="#choose-modal">
                        CANCEL
                        <i class="icon-user-cancel ml-2"></i>
                    </button>
                </div>
                <div class="col-md-6">
                    <button id="save-photo" type="submit" class="btn bg-teal-400 btn-block mb-2 legitRipple mt-3" data-toggle="modal" data-target="#choose-modal">
                        SAVE
                        <i class="icon-paperplane ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="choose-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Photo</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 avatar-source text-center" id="no-photo" data-url="{{ $updateUrl }}">
                            <img src="{{ url('images/profile.png') }}" class="rounded-circle img-thumbnail img-responsive">
                            <h6 class="mt-3">No Photo</h6>
                        </div>
                        <div class="col-md-4 avatar-source">
                            <input type="file" name="avatar" id="avatar-upload" class="form-control-uniform-custom" style="margin-top: 25%" accept=".jpg,.jpeg,.gif,.png">
                        </div>
                        @if ($edit)
                            <div class="col-md-4 avatar-source source-external text-center" data-url="{{ $updateUrl }}">
                                <img src="{{ $user->gravatar() }}" class="rounded-circle img-thumbnail img-responsive" alt="">
                                <h6 class="mt-3">Gravatar</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-none">
        <input type="hidden" name="points[x1]" id="points_x1">
        <input type="hidden" name="points[y1]" id="points_y1">
        <input type="hidden" name="points[x2]" id="points_x2">
        <input type="hidden" name="points[y2]" id="points_y2">
    </div>