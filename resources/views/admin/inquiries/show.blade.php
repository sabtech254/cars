<x-admin-layout>
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">View Inquiry</h1>
            <div>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">
                    <i class="material-icons align-middle">arrow_back</i> Back to Inquiries
                </a>
            </div>
        </div>

        <!-- Inquiry Details -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Contact Information</h5>
                        <dl class="row">
                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">{{ $inquiry->name }}</dd>

                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9">
                                <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                            </dd>

                            <dt class="col-sm-3">Date</dt>
                            <dd class="col-sm-9">{{ $inquiry->created_at->format('F j, Y g:i A') }}</dd>

                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">
                                <span class="badge bg-{{ $inquiry->status === 'new' ? 'danger' : 'success' }}">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </dd>
                        </dl>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="card-title">Message</h5>
                        <div class="card bg-light">
                            <div class="card-body">
                                {{ $inquiry->message }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this inquiry?');"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="material-icons align-middle">delete</i> Delete Inquiry
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
