@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2 text-center">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="bi bi-plus-circle me-2"></i>Yeni Tapşırıq
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.todo.store') }}" method="POST">
                        @csrf 
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Görüləcək iş:</label>
                            <input type="text" name="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Məsələn: Hesabatı hazırla..." 
                                   value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 8px; flex: 2;">
                                <i class="bi bi-save me-1"></i> Yadda saxla
                            </button>
                            <a href="{{ route('admin.todo.index') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px; flex: 1;">
                                Geri
                            </a>
                        </div>
                    </form>

                    {{-- Xətaların göstərilməsi --}}
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