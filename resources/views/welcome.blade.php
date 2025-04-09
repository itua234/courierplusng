<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <base href="{{url('')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>Blog - Courier Plus</title>
        <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/axios/axios.js')}}"></script>
        <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/logos/favicon.png')}}" />
        <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .blog-header {
                background-color: #4f659c;
                color: white;
                padding: 20px 0;
                text-align: center;
            }
            .blog-post {
                border: 1px solid #ddd;
                border-radius: 10px;
                margin-bottom: 20px;
                padding: 15px;
                background-color: #fff;
            }
            .blog-post img {
                max-width: 100%;
                border-radius: 10px;
            }
            .blog-post-title {
                font-size: 20px;
                font-weight: bold;
                margin-top: 10px;
            }
            .blog-post-meta {
                font-size: 14px;
                color: #888;
                margin-bottom: 10px;
            }
            .blog-footer {
                background-color: #4f659c;
                color: white;
                text-align: center;
                padding: 10px 0;
            }
            .action-buttons {
                margin-top: 20px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="blog-header">
            <a href="{{url('/')}}">
                <img src="{{asset('assets/images/logos/courierplus-logo.svg')}}" width="180" alt="Courier Plus Logo">
            </a>
            <h1>Welcome to Our Blog</h1>
            <p>Stay updated with the latest news and articles</p>
        </header>

        <!-- Action Buttons -->
        <div class="action-buttons">
            @guest
                <!-- Show Register button if user is not authenticated -->
                <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                <!-- Show Register button if user is not authenticated -->
                <a href="{{ route('login') }}" class="btn btn-success">Login</a>
            @else
                <!-- Show Logout button if user is authenticated -->
                <a href="{{ route('logout') }}" class="btn btn-success">Logout</a>
                <!-- Show Add Post button if user is authenticated -->
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
            @endguest
        </div>

        <main class="container mt-4">
            <div class="row">
                <!-- Blog Post 1 -->
                <div class="col-md-4">
                    <div class="blog-post">
                        <img src="{{asset('assets/images/blog/post1.jpg')}}" alt="Blog Post 1">
                        <h2 class="blog-post-title">Blog Post Title 1</h2>
                        <p class="blog-post-meta">Published on {{ now()->format('M d, Y') }}</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum...</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div class="col-md-4">
                    <div class="blog-post">
                        <img src="{{asset('assets/images/blog/post2.jpg')}}" alt="Blog Post 2">
                        <h2 class="blog-post-title">Blog Post Title 2</h2>
                        <p class="blog-post-meta">Published on {{ now()->format('M d, Y') }}</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum...</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div class="col-md-4">
                    <div class="blog-post">
                        <img src="{{asset('assets/images/blog/post3.jpg')}}" alt="Blog Post 3">
                        <h2 class="blog-post-title">Blog Post Title 3</h2>
                        <p class="blog-post-meta">Published on {{ now()->format('M d, Y') }}</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum...</p>
                        <a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
        </main>

        <footer class="blog-footer">
            <p>&copy; {{ now()->year }} Courier Plus. All rights reserved.</p>
            <a href="#" class="text-white">Privacy Policy</a> | 
            <a href="#" class="text-white">Terms and Conditions</a>
        </footer>

        <script>
            // Add any custom JavaScript here
        </script>
    </body>
</html>