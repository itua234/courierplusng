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
                    <h4 class="text-center" style="font-weight:700" id="auth-heading">Create Blog Post</h4>
                    <form id="create-post" action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 auth-form-group">
                                <label for="title" class="custom-input-label">Post Title</label>
                                <div class="d-flex position-relative input-box">
                                    <div class="d-flex align-items-center justify-content-center p-l-10 p-r-10 position-absolute h-100 px-2 icon-box">
                                        <img src="{{asset('assets/images/icons/auth/ooui_user-avatar.svg')}}" width="15" alt="">
                                    </div>
                                    <input value="{{ old('title') }}" type="text" id="title" name="title" placeholder="Enter Post Title" class="custom-input" />
                                </div>
                                <div class="text-danger backend-msg">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 auth-form-group">
                                <label for="content" class="custom-input-label">Post Content</label>
                                <textarea id="content" name="content" rows="6" placeholder="Write your post content here..." class="custom-input">{{ old('content') }}</textarea>
                                <div class="text-danger backend-msg">
                                    @error('content')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 auth-form-group">
                                <label for="image" class="custom-input-label">Upload Image (Optional)</label>
                                <input type="file" id="image" name="image" class="form-control">
                                <div class="text-danger backend-msg">
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="custom-btn fs-4 mb-2 reg-btn">
                                Publish Post
                                <img src="{{asset('assets/images/icons/auth/cil_arrow-right.svg')}}" width="20" class="ml-2" alt="">
                            </button>
                        </div>
                        <h6 style="font-size:14px;" class="mt-2 text-center"><a href="{{url('/')}}" class="custom-text-secondary">Back to Home</a></h6>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Add any custom JavaScript here if needed
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>