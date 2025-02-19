<footer class="footer py-4">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                Copyright &copy; {{ date('Y') }} AutoMarket Admin Panel
                <span class="mx-1">·</span>
                <span>Version 1.0</span>
            </div>
            <div>
                <a href="#" class="text-decoration-none">
                    <i class="fas fa-question-circle me-1"></i>
                    Help Center
                </a>
                <span class="mx-2">|</span>
                <a href="#" class="text-decoration-none">
                    <i class="fas fa-bug me-1"></i>
                    Report an Issue
                </a>
                <span class="mx-2">|</span>
                <a href="#" class="text-decoration-none">
                    <i class="fas fa-book me-1"></i>
                    Documentation
                </a>
            </div>
        </div>
    </div>
</footer>

@push('styles')
<style>
    .footer {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        position: relative;
        bottom: 0;
        width: 100%;
    }

    .footer a {
        color: #6c757d;
    }

    .footer a:hover {
        color: #0d6efd;
    }
</style>
@endpush
