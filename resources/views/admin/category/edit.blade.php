@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2">
                    <h5 class="fw-bold mb-0 text-center text-info">
                        <i class="bi bi-pencil-square me-2"></i>Kateqoriyanı Redaktə Et
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.category.update', ['category_id' => request()->route('category_id')]) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label small fw-bold text-secondary">Kateqoriya Adı</label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $item->title) }}"
                                   required>
                            
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-info text-white w-100 py-2 shadow-sm" style="border-radius: 8px;">
                                <i class="bi bi-save me-1"></i> Yenilə
                            </button>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-light w-100 py-2 border" style="border-radius: 8px;">
                                Geri qayıt
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection