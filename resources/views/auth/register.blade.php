@include("auth.layouts.header")

<section class="d-flex align-items-center justify-content-center" style="height:100vh;width:100%;background-color:#4f659c;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow p-4">
                    <div class="text-center mb-4">
                        <a href="{{url('/')}}">
                            <img src="{{asset('assets/images/logos/courierplus-logo.svg')}}" width="180" alt="Courier Plus Logo">
                        </a>
                    </div>
                    <h4 class="text-center" style="font-weight:700" id="auth-heading">Create Account</h4>
                    <form id="signup" action="{{route('user-signup')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 auth-form-group">
                                <label for="firstname" class="custom-input-label">First Name</label>
                                <div class="d-flex position-relative input-box">
                                    <div class="d-flex align-items-center justify-content-center p-l-10 p-r-10 position-absolute h-100 px-2 icon-box">
                                        <img src="{{asset('assets/images/icons/auth/ooui_user-avatar.svg')}}" width="15" alt="">
                                    </div>
                                    <input value="{{ old('firstname') }}" type="text" id="firstname" name="firstname" placeholder="First name" class="custom-input" />
                                </div>
                                <div class="text-danger backend-msg">
                                    @error('firstname')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 auth-form-group">
                                <label for="lastname" class="custom-input-label">Last Name</label>
                                <div class="d-flex position-relative input-box">
                                    <div class="d-flex align-items-center justify-content-center p-l-10 p-r-10 position-absolute h-100 px-2 icon-box">
                                        <img src="{{asset('assets/images/icons/auth/ooui_user-avatar.svg')}}" width="15" alt="">
                                    </div>
                                    <input value="{{ old('lastname') }}" type="text" id="lastname" name="lastname" placeholder="Last name" class="custom-input" />
                                </div>
                                <div class="text-danger backend-msg">
                                    @error('lastname')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 auth-form-group">
                                <label for="email" class="custom-input-label">Email</label>
                                <div class="d-flex position-relative input-box">
                                    <div class="d-flex align-items-center justify-content-center p-l-10 p-r-10 position-absolute h-100 px-2 icon-box">
                                        <img src="{{asset('assets/images/icons/auth/iconamoon_email-thin.svg')}}" width="15" alt="">
                                    </div>
                                    <input value="{{ old('email') }}" type="email" id="email" name="email" placeholder="Email" class="custom-input" />
                                </div>
                                <div class="text-danger backend-msg">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 auth-form-group">
                                <label for="password" class="custom-input-label">Password</label>
                                <div class="d-flex position-relative input-box">
                                    <div class="d-flex align-items-center justify-content-center p-l-10 p-r-10 position-absolute h-100 px-2">
                                        <img src="{{asset('assets/images/icons/auth/mdi_password-outline.svg')}}" width="15" alt="">
                                    </div>
                                    <input value="{{ old('password') }}" type="password" id="password" name="password" placeholder="Enter Password" class="custom-input" />
                                    <div class="d-flex align-items-center justify-content-center p-l-10 p-r-10 position-absolute h-100 px-2" style="top:0;right:0">
                                        <img src="{{asset('assets/images/icons/auth/ion_eye.svg')}}" class="show-hide" width="15" alt="">
                                    </div>
                                </div>
                                <div class="text-danger backend-msg">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            
                        </div>
                        <p style="font-size:14px;color:#1E1E1E;" class="mt-3">By clicking the Sign Up button below, you agree to Courier Plus's 
                            <a href="#" style="font-weight:600" class="custom-text-secondary">terms of acceptable use.</a>
                        </p>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="custom-btn fs-4 mb-2 reg-btn">
                                Sign Up 
                                <img src="{{asset('assets/images/icons/auth/cil_arrow-right.svg')}}" width="20" class="ml-2" alt="">
                            </button>
                        </div>
                        <h6 style="font-size:14px;" class="mt-2 text-center">Already have an account? <a href="#" class="custom-text-secondary">Sign in</a></h6>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    <script>

        $(".show-hide").click(function (event) {
            let icon = $(this);
            var input = $("#password");
            if(input.attr("type") === "password"){
                input.attr("type", "text");
                icon.attr("name", "eye-off-outline");
            }else{
                input.attr("type", "password");
                icon.attr("name", "eye-outline");
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </body>
</html>