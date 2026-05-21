@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2 text-center">
                    <h5 class="fw-bold mb-0 text-info">
                        <i class="bi bi-pencil-square me-2"></i>Tapşırığı Redaktə Et
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.todo.update', ['todo_id' => $item->id]) }}" method="POST">
                        @csrf
                        {{-- Laravel update üçün adətən PUT metodundan istifadə edir, əgər Controller-də dəyişsən bura @method('PUT') əlavə edə bilərsən --}}
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Tapşırıq:</label>
                            <input type="text" name="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $item->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch p-3 border rounded bg-light shadow-xs">
                                <input class="form-check-input ms-0 me-2" type="checkbox" name="is_completed" 
                                       value="1" id="flexSwitchCheckDefault" 
                                       {{ old('is_completed', $item->is_completed) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold text-dark" for="flexSwitchCheckDefault">
                                    Tamamlanıb
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-info text-white px-4 py-2 shadow-sm" style="border-radius: 8px; flex: 2;">
                                <i class="bi bi-arrow-repeat me-1"></i> Yenilə
                            </button>
                            <a href="{{ route('admin.todo.index') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px; flex: 1;">
                                Geri
                            </a>
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