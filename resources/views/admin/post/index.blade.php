@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">{{ $title }}</h4>
            <p class="text-muted small mb-0">Toplam {{ count($posts) }} xəbər siyahılanıb</p>
        </div>
        <a href="{{ route('admin.post.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Yeni Post
        </a>
    </div>

    <div class="row">
        @foreach($posts as $post)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; overflow: hidden; transition: 0.3s;">
                <div class="position-relative">
                    @if($post->image)
                        <img src="{{ asset('storage/uploads/' . $post->image) }}" class="card-img-top" style="height: 300px;  width: 100%;object-fit: cover; object-position: center;" alt="post">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-image text-muted display-4"></i>
                        </div>
                    @endif
                    <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-primary shadow">
                        {{ $post->category->title }}
                    </span>
                </div>

                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ $post->created_at->format('d.m.Y') }}</small>
                        <small class="text-muted fw-bold">#{{ $post->id }}</small>
                    </div>
                    <h6 class="card-title fw-bold text-dark text-truncate-2" style="height: 45px; overflow: hidden;">
                        {{ $post->title }}
                    </h6>
                </div>

                <div class="card-footer bg-white border-0 p-3 pt-0 d-flex justify-content-between align-items-center">
                    <div class="btn-group w-100 gap-2">
                        <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="bi bi-pencil-square me-1"></i> Redaktə
                        </a>
                        <a href="{{ route('admin.post.delete', $post->id) }}" 
                           class="btn btn-outline-danger btn-sm rounded-pill px-3"
                           onclick="return confirm('Silmək istədiyinizdən əminsiniz?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .card{transition: all .4s ease;}
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .text-truncate-2 {
        overflow: hidden;
    }
    .row { margin-right: -10px; margin-left: -10px; }
    .col-12 { padding-right: 10px; padding-left: 10px; }
</style>
@endsection