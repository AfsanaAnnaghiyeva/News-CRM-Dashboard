@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h4 class="fw-bold mb-0 text-dark"><i class="bi bi-chat-left-dots me-2 text-primary"></i>Rəylərin İdarə Edilməsi</h4>
        <p class="text-muted small">İstifadəçilər tərəfindən yazılan son rəylər</p>
    </div>

    <div class="row">
        @forelse($comments as $comment)
        <div class="col-12 mb-3">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-3 border-end-md mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px;">
                                    <i class="bi bi-person text-secondary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">{{ $comment->guest_name }}</h6>
                                    <small class="text-muted d-block">{{ $comment->guest_email }}</small>
                                    <small class="text-primary font-monospace" style="font-size: 0.75rem;">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3 mb-md-0 px-md-4">
                            <div class="mb-2">
                                <span class="badge bg-light text-dark border fw-normal mb-1">
                                    <i class="bi bi-link-45deg me-1"></i>
                                    {{ $comment->post->title ?? 'Post tapılmadı' }}
                                </span>
                            </div>
                            <p class="text-secondary mb-0 fst-italic" style="line-height: 1.6;">
                                <i class="bi bi-quote fs-4 text-primary opacity-25"></i>
                                {{ $comment->comment_text }}
                            </p>
                        </div>

                        <div class="col-12 col-md-3 text-md-end">
                            <div class="mb-3">
                                @if($comment->status == 'pending')
                                    <span class="badge rounded-pill bg-warning-subtle text-warning px-3">
                                        <i class="bi bi-clock me-1"></i> Gözləyir
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-success-subtle text-success px-3">
                                        <i class="bi bi-check-all me-1"></i> Təsdiqlənib
                                    </span>
                                @endif
                            </div>
                            
                            <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                                @if($comment->status == 'pending')
                                    <a href="{{ route('admin.comment.approved', $comment->id) }}" class="btn btn-success btn-sm px-3 border-0" title="Təsdiqlə">
                                        <i class="bi bi-check-lg"></i> Təsdiqlə
                                    </a>
                                @endif
                                <a href="{{ route('admin.comment.delete', $comment->id) }}" class="btn btn-danger btn-sm px-3 border-0" onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-white rounded-4 shadow-sm p-5">
                <i class="bi bi-chat-square-dots display-1 text-muted opacity-25"></i>
                <p class="mt-3 text-muted">Hələ ki heç bir rəy yazılmayıb.</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $comments->links() }}
    </div>
</div>

<style>
    .border-end-md {
        border-right: 1px solid #f0f0f0;
    }
    @media (max-width: 767px) {
        .border-end-md {
            border-right: none;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 1rem;
        }
    }
    .card {
        transition: all .4s ease;
    }
    .card:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.05) !important;
    }
</style>
@endsection