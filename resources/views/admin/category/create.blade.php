@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5"> <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2">
                    <h5 class="fw-bold mb-0 text-center text-primary">
                        <i class="bi bi-plus-circle me-2"></i>Yeni Kateqoriya
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label small fw-bold text-secondary">Kateqoriya Adı</label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Məsələn: Texnologiya"
                                   value="{{ old('title') }}"
                                   required>
                            
                            {{-- Validasiya xətalarını dd əvəzinə burada səliqəli göstəririk --}}
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100 py-2 shadow-sm" style="border-radius: 8px;">
                                <i class="bi bi-check-lg me-1"></i> Yadda saxla
                            </button>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-light w-100 py-2 border" style="border-radius: 8px;">
                                Ləğv et
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection