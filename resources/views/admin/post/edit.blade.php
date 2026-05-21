@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2">
                    <h5 class="fw-bold mb-0 text-info">
                        <i class="bi bi-pencil-square me-2"></i>Postu Redaktə Et: <span class="text-dark">{{ $item->title }}</span>
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    <form action="{{ route('admin.post.update', ['post_id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Əgər controller-də update metodu PUT gözləyirsə, aşağıdakı sətri aktiv et: --}}
                        {{-- @method('PUT') --}}
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Başlıq</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $item->title) }}">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-secondary">Kateqoriya</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('category_id', $item->category_id) == $category->id) ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-secondary">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ old('status', $item->status) == 0 ? 'selected' : '' }}>Deaktiv</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Məzmun</label>
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6">{{ old('content', $item->content) }}</textarea>
                                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <div class="p-3 border rounded bg-light">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <label class="form-label d-block small fw-bold text-secondary">Hazırkı Şəkil</label>
                                            @if($item->image)
                                                <img src="{{ asset('storage/uploads/' . $item->image) }}" alt="sekil" class="img-thumbnail" width="100">
                                            @else
                                                <span class="text-muted small">Şəkil yoxdur</span>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <label class="form-label small fw-bold text-secondary">Yeni Şəkil (Dəyişmək istəmirsinizsə boş qoyun)</label>
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex gap-2">
                                <button type="submit" class="btn btn-info text-white px-5 py-2 shadow-sm" style="border-radius: 8px;">
                                    <i class="bi bi-save me-1"></i> Yadda Saxla
                                </button>
                                <a href="{{ route('admin.post.index') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px;">
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