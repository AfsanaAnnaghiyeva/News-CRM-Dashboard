@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2 text-center">
                    <h5 class="fw-bold mb-0 text-info">
                        <i class="bi bi-pencil-square me-2"></i>Müştəri Məlumatlarını Yenilə
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.customer.update', ['customer_id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Əgər controller PUT/PATCH gözləyirsə aşağıdakı sətri aktivləşdir --}}
                        {{-- @method('PUT') --}}
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Müştəri Adı</label>
                                <input type="text" name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $item->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Veb Sayt Linki</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-link-45deg"></i></span>
                                    <input type="text" name="link" 
                                           class="form-control @error('link') is-invalid @enderror" 
                                           value="{{ old('link', $item->link) }}">
                                </div>
                                @error('link')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <div class="p-3 border rounded bg-light">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <label class="form-label d-block small fw-bold text-secondary">Mövcud Loqo</label>
                                            @if($item->logo)
                                                <img src="{{ asset('storage/uploads/customer/' . $item->logo) }}" 
                                                     alt="logo" class="rounded border bg-white shadow-sm" width="70">
                                            @else
                                                <div class="bg-white rounded border d-flex align-items-center justify-content-center text-muted" style="width: 70px; height: 50px;">
                                                    <i class="bi bi-image small"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <label class="form-label small fw-bold text-secondary">Yeni Loqo</label>
                                            <input type="file" name="logo" class="form-control form-control-sm @error('logo') is-invalid @enderror" accept="image/*">
                                            <div class="form-text small opacity-75" style="font-size: 10px;">Dəyişmək istəmirsinizsə boş saxlayın.</div>
                                        </div>
                                    </div>
                                </div>
                                @error('logo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <hr class="text-muted opacity-25">

                            <div class="col-12 d-flex gap-2">
                                <button type="submit" class="btn btn-info text-white px-4 py-2 shadow-sm" style="border-radius: 8px; flex: 2;">
                                    <i class="bi bi-arrow-repeat me-1"></i> Məlumatları yenilə
                                </button>
                                <a href="{{ route('admin.customer.index') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px; flex: 1;">
                                    Geri qayıt
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection