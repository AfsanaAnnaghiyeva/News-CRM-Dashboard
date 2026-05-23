@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Kateqoriyalar</h4>
            <p class="text-muted small mb-0">Ümumi {{ count($items) }} kateqoriya mövcuddur</p>
        </div>
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Yeni Kateqoriya
        </a>
    </div>

    <div class="row">
        @forelse($items as $item)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; transition: transform 0.2s;">
                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <span class="fw-bold small">#{{ $item->id }}</span>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">{{ $item->title }}</h6>
                                <small class="text-muted">ID: {{ $item->id }}</small>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.category.edit', ['category_id' => $item->id]) }}" 
                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                               style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-pencil-square text-primary"></i>
                            </a>
                            <a href="{{ route('admin.category.delete', ['category_id' => $item->id]) }}" 
                               class="btn btn-light btn-sm rounded-circle shadow-sm" 
                               onclick="return confirm('Silinsin?')"
                               style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                    <i class="bi bi-folder-x display-1 text-muted"></i>
                    <p class="mt-3 text-muted">Hələ ki heç bir kateqoriya əlavə edilməyib.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .card{ transition: all .4s ease;}
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
    
    .bg-primary-subtle {
        background-color: #e7f1ff !important;
    }
</style>
@endsection