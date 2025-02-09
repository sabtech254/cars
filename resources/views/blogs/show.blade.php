<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    @if($blog->image)
                        <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="max-height: 400px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title">{{ $blog->title }}</h1>
                        
                        <div class="d-flex align-items-center text-muted mb-4">
                            <i class="material-icons me-1">person</i>
                            <span>{{ $blog->user->name }}</span>
                            <i class="material-icons ms-3 me-1">calendar_today</i>
                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="blog-content">
                            {!! nl2br(e($blog->content)) !!}
                        </div>

                        @auth
                            @if(auth()->user()->is_admin)
                                <div class="mt-4 pt-3 border-top">
                                    <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-primary me-2">
                                        <i class="material-icons align-middle">edit</i> Edit
                                    </a>
                                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                            <i class="material-icons align-middle">delete</i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">
                        <i class="material-icons align-middle">arrow_back</i> Back to Blog
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
