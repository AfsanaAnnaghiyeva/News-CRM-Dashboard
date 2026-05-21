@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Xidmətlərin Siyahısı</h4>
            <p class="text-muted small mb-0">Ümumi {{ count($items) }} aktiv xidmət təklif olunur</p>
        </div>
        <a href="{{ route('admin.service.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Yeni xidmət əlavə et
        </a>
    </div>

    <div class="row">
        @forelse($items as $item)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; transition: 0.3s;">
                <div class="card-body p-4 d-flex flex-column">
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-light text-muted rounded-pill px-3">#{{ $item->id }}</span>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.service.edit', ['service_id' => $item->id]) }}">
                                        <i class="bi bi-pencil me-2 text-primary"></i> Redaktə et
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('admin.service.delete', ['service_id' => $item->id]) }}" 
                                       onclick="return confirm('Silinsin?')">
                                        <i class="bi bi-trash me-2"></i> Sil
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">
                        {{ $item->title }}
                    </h3>
                    
                    <div class="mb-3">
                        <span class="fs-4 fw-bold text-primary">{{ number_format($item->price, 2) }}</span>
                        <span class="text-muted fw-medium" style="font-size: 0.85rem;">AZN</span>
                    </div>

                    <p class="text-muted small mb-4" style="line-height: 1.6; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $item->description }}
                    </p>

                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('admin.service.edit', ['service_id' => $item->id]) }}" 
                           class="btn btn-primary btn-sm rounded-pill py-2 fw-bold shadow-sm">
                            <i class="bi bi-pencil-square me-1"></i> Düzəliş et
                        </a>
                        <a href="{{ route('admin.service.delete', ['service_id' => $item->id]) }}" 
                           class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                           style="width: 40px; height: 40px;"
                           onclick="return confirm('Bu xidməti silmək istədiyinizdən əminsiniz?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-white rounded-4 shadow-sm p-5">
                <i class="bi bi-briefcase display-1 text-muted opacity-25"></i>
                <p class="mt-3 text-muted">Hələ ki heç bir xidmət əlavə edilməyib.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* Kart effekti */
    .card {
        border: 1px solid rgba(0,0,0,0.05) !important;
    }
    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
        border-color: #0d6efd33 !important;
    }
    
    /* Qiymət rəngi */
    .text-primary {
        color: #0d6efd !important;
    }

    /* Düymə keçidi */
    .btn-primary {
        background-color: #0d6efd;
        border: none;
        transition: 0.2s;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: scale(1.02);
    }

    /* Mobil üçün tənzimləmə */
    @media (max-width: 576px) {
        .display-6 {
            font-size: 2rem;
        }
        h3 {
            font-size: 1.5rem;
        }
    }
</style>
@endsection