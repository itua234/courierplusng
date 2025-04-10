@include("layouts.header")
<div class="container-fluid" style="background-color:#F6F6F7;">
    <!-- Row 1 -->
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title fw-normal bg-white py-2 px-3 rounded-pill">All Blog Posts</h5>
            </div>

            <div class="row mt-3">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">By {{ $post->user->firstname . ' ' . $post->user->lastname }} on {{ $post->created_at->format('d M, Y') }}</small>
                                </p>
                                <p class="card-text">{{ Str::limit($post->content, 100, '...') }}</p>
                                <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center my-2">
                {{ $posts->links() }} <!-- Laravel Pagination -->
            </div>
        </div>
    </div>
</div>
@include("layouts.footer")