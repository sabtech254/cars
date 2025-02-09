<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Blog Posts</h1>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                        <i class="material-icons align-middle">add</i> New Post
                    </a>
                @endif
            @endauth
        </div>

        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($blog->image)
                            <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text text-muted">
                                <small>
                                    <i class="material-icons align-middle" style="font-size: 1rem;">person</i>
                                    {{ $blog->user->name }}
                                    <i class="material-icons align-middle ms-2" style="font-size: 1rem;">calendar_today</i>
                                    {{ $blog->created_at->format('M d, Y') }}
                                </small>
                            </p>
                            <p class="card-text">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                            <a href="{{ route('blogs.show', $blog) }}" class="btn btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No blog posts found.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</x-app-layout>
