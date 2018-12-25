@extends('auth.layouts.auth')

@section('page-title', 'Sign up')

@section('content')
    <form class="login-form wmin-sm-400" action="{{ route('registration') }}" method="post"  id="registration-form" autocomplete="off">
        @csrf
        <div class="card mb-0">
            <div class="tab-content card-body">
                <div class="tab-pane fade show active" id="login-tab2">
                    <div class="text-center mb-3">
                        <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">Sign Up</h5>
                        <span class="d-block text-muted">All field are required.</span>
                    </div>

                    <div class="form-group">
                        @include('backend.partials.alerts')
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" placeholder="Username">
                        <div class="form-control-feedback">
                            <i class="icon-user-check text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                        <div class="form-control-feedback">
                            <i class="icon-user-lock text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                        <div class="form-control-feedback">
                            <i class="icon-mention text-muted"></i>
                        </div>
                    </div>

                    @if (appSettings('tos'))
                       <div class="form-group">
                           <div class="form-check">
                               <label class="form-check-label">
                                   <input type="checkbox" name="tos" id="tos" value="1" class="form-check-input-styled" checked data-fouc>
                                   I accept
                                   <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_tos">Terms of Service</a>
                               </label>
                           </div>
                       </div>
                    @endif

                    <div class="form-group">
                        <button type="submit" class="btn bg-dark btn-block" id="btn-login">Sign Up</button>
                    </div>
                    <div class="form-group text-center text-muted content-divider">
                        <span class="px-2">Already have an account?</span>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('login') }}" class="btn btn-light btn-block">Login</a>
                    </div>
                    @if (appSettings('registration.captcha.enabled'))
                        <div class="g-recaptcha"
                             data-sitekey="{{env('GOOGLE_RECAPTCHA_SITEKEY')}}">
                        </div>
                        <?php //echo session('recaptcha', 'default'); ?>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <!-- Basic modal -->
    <div id="modal_tos" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <h6 class="font-weight-semibold">Terms of Services</h6>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>

                    <hr>

                    <h6 class="font-weight-semibold">Terms of Use</h6>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

                    <button type="button" class="btn bg-primary">Accept</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
@stop

@push('header')
    <script src="https://www.google.com/recaptcha/api.js?render={{env('GOOGLE_RECAPTCHA_SITEKEY')}}"></script>
@endpush

@push('footer')
    {!! JsValidator::formRequest('App\Http\Requests\Auth\RegisterRequest', '#registration-form') !!}


    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("{{env('GOOGLE_RECAPTCHA_SITEKEY')}}", {action: 'login'});
        });
    </script>

@endpush