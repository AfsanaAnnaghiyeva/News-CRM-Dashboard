@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2 text-center">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="bi bi-person-plus me-2"></i>Yeni Müştəri Əlavə Et
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    {{-- Şəkil (Loqo) yükləndiyi üçün enctype mütləqdir --}}
                    <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Müştəri Adı</label>
                                <input type="text" name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Məsələn: Tech Solution" 
                                       value="{{ old('name') }}" required>
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
                                           placeholder="https://example.com" 
                                           value="{{ old('link') }}">
                                </div>
                                @error('link')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label small fw-bold text-secondary">Loqo (Şəkil)</label>
                                <input type="file" name="logo" 
                                       class="form-control @error('logo') is-invalid @enderror" 
                                       accept="image/*">
                                <div class="form-text mt-1 italic" style="font-size: 11px;">Müştəri loqosunu JPG və ya PNG formatında yükləyin.</div>
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="text-muted opacity-25">

                            <div class="col-12 d-flex gap-2 pt-2">
                                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 8px; flex: 2;">
                                    <i class="bi bi-check-lg me-1"></i> Yadda saxla
                                </button>
                                <a href="{{ route('admin.customer.index') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px; flex: 1;">
                                    Ləğv et
                                </a>
                            </div>
                        </div>
                    </form>

                    {{-- Xətaların siyahısı (Alternativ olaraq) --}}
                    @if($errors->any())
                        <div class="alert alert-danger mt-4 py-2 small">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection