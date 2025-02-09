<x-admin-layout>
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Inquiries</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Inquiries Table -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="inquiriesTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inquiries as $inquiry)
                                <tr>
                                    <td>{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $inquiry->name }}</td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td>{{ Str::limit($inquiry->message, 50) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $inquiry->status === 'new' ? 'danger' : 'success' }}">
                                            {{ ucfirst($inquiry->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this inquiry?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No inquiries found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $inquiries->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
