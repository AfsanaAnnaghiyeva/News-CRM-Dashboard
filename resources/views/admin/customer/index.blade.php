@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold mb-0 text-dark">Müştərilərin Siyahısı</h4>
            <p class="text-muted small mb-0">Ümumi {{ count($items) }} tərəfdaş müştəri</p>
        </div>
        <a href="{{ route('admin.customer.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-person-plus me-2"></i>Yeni müştəri əlavə et
        </a>
    </div>

    <div class="row">
        @forelse($items as $item)
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm h-100 text-center" style="border-radius: 20px; transition: 0.3s;">
                <div class="card-body p-3 d-flex flex-column align-items-center">
                    
                    <span class="badge bg-light text-muted rounded-pill px-2 mb-3 align-self-start" style="font-size: 0.7rem;">#{{ $item->id }}</span>

                    <div class="mb-3">
                        @if($item->logo)
                            <img src="{{ asset('storage/uploads/customer/' . $item->logo) }}" 
                                 class="rounded-circle border p-1 shadow-xs" 
                                 width="80" 
                                 height="80" 
                                 style="object-fit: contain; background: #fff;" 
                                 alt="logo">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border" style="width: 80px; height: 80px;">
                                <i class="bi bi-building text-muted fs-2"></i>
                            </div>
                        @endif
                    </div>

                    <h6 class="fw-bold text-dark mb-2 text-truncate w-100 px-2">
                        {{ $item->name }}
                    </h6>

                    <div class="mb-3 mt-auto">
                        @if($item->link)
                            <a href="{{ $item->link }}" target="_blank" class="text-primary text-decoration-none small fw-medium">
                                <i class="bi bi-link-45deg"></i> Vebsayta keçid
                            </a>
                        @else
                            <span class="text-muted small opacity-50">Link yoxdur</span>
                        @endif
                    </div>

                    <div class="d-flex gap-2 w-100">
                        <a href="{{ route('admin.customer.edit', ['customer_id' => $item->id]) }}" 
                           class="btn btn-outline-primary btn-sm  rounded-pill">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{ route('admin.customer.delete', ['customer_id' => $item->id]) }}" 
                           class="btn btn-outline-danger btn-sm  rounded-pill"
                           onclick="return confirm('Bu müştərini silmək istədiyinizdən əminsiniz?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-white rounded-4 shadow-sm p-5">
                <i class="bi bi-people display-1 text-muted opacity-25"></i>
                <p class="mt-3 text-muted">Siyahıda müştəri tapılmadı.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card{transition: all .4s ease;}
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        border: 1px solid #0d6efd22 !important;
    }

    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    @media (max-width: 576px) {
        .col-6 {
            padding-left: 8px;
            padding-right: 8px;
        }
        h6 {
            font-size: 0.9rem;
        }
        img, .bg-light.rounded-circle {
            width: 65px !important;
            height: 65px !important;
        }
    }
</style>
@endsection