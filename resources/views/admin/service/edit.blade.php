@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2 text-center">
                    <h5 class="fw-bold mb-0 text-info">
                        <i class="bi bi-pencil-square me-2"></i>Xidməti Redaktə Et
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.service.update', ['service_id' => request()->route('service_id')]) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Xidmətin Başlığı</label>
                                <input type="text" name="title" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $item->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Qiymət (AZN)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted">₼</span>
                                    <input type="number" name="price" step="0.01" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price', $item->price) }}" required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label small fw-bold text-secondary">Xidmət Haqqında</label>
                                <textarea name="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="4">{{ old('description', $item->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex gap-2">
                                <button type="submit" class="btn btn-info text-white px-4 py-2 shadow-sm" style="border-radius: 8px; flex: 2;">
                                    <i class="bi bi-save me-1"></i> Yenilə
                                </button>
                                <a href="{{ route('admin.service.index') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px; flex: 1;">
                                    Geri qayıt
                                </a>
                            </div>
                        </div>
                    </form>
                    
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