<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Blog Post</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                    id="content" name="content" rows="10" required>{{ old('content', $blog->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($blog->image)
                                <div class="mb-3">
                                    <label class="form-label">Current Image</label>
                                    <div>
                                        <img src="{{ Storage::url($blog->image) }}" alt="Current image" 
                                            class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="image" class="form-label">Change Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('blogs.show', $blog) }}" class="btn btn-outline-secondary">
                                    <i class="material-icons align-middle">arrow_back</i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="material-icons align-middle">save</i> Update Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
