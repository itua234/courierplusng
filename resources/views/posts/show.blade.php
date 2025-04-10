<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $post->title }} - Blog Details</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
        <style>
            .blog-header {
                background-color: #4f659c;
                color: white;
                padding: 20px 0;
                text-align: center;
            }
            .blog-content {
                margin-top: 20px;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            .blog-content img {
                max-width: 100%;
                border-radius: 10px;
                margin-bottom: 20px;
            }
            .blog-footer {
                background-color: #4f659c;
                color: white;
                text-align: center;
                padding: 10px 0;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <header class="blog-header">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/logos/courierplus-logo.svg') }}" width="180" alt="Courier Plus Logo">
            </a>
            <h1>{{ $post->title }}</h1>
            <p>Published on {{ $post->created_at->format('M d, Y') }}</p>
        </header>

        <main class="container mt-4">
            <div class="blog-content">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                @endif
                <p>{{ $post->content }}</p>
                <!-- Show Delete Button if Authenticated User is the Post Owner -->
                @auth
                    @if(auth()->user()->id === $post->user_id)
                        <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Post</button>
                        </form>
                    @endif
                @endauth
            </div>
        </main>

        <footer class="blog-footer">
            <p>&copy; {{ now()->year }} Courier Plus. All rights reserved.</p>
            <a href="#" class="text-white">Privacy Policy</a> | 
            <a href="#" class="text-white">Terms and Conditions</a>
        </footer>
    </body>
</html>