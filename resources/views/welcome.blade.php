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
                <!-- Show Add Post button only if user status is approved -->
                @if(auth()->user()->status === 'approved')
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
                @else
                    <p class="text-danger mt-2">Your account is not approved to add posts.</p>
                @endif
            @endguest
        </div>

        <main class="container mt-4">
            <div class="row">
                <!-- Blog Post 1 -->
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="blog-post">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                            <h2 class="blog-post-title">{{ $post->title }}</h2>
                            <p class="blog-post-meta">Published on {{ $post->created_at->format('M d, Y') }}</p>
                            <p>{{ Str::limit($post->content, 100, '...') }}</p>
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary btn-sm">Read More</a>
                        </div>
                    </div>
                @endforeach
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