@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                
                <div class="card-header bg-white py-3 border-0 mt-2">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="bi bi-file-earmark-plus me-2"></i>{{ $title }}
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">
                    {{-- Sənin orijinal action və method kodun --}}
                    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Başlıq</label>
                                <input type="text" name="title" class="form-control" placeholder="Basliq" value="{{ old('title') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-secondary">Kateqoriya</label>
                                <select name="category_id" class="form-select">
                                    <option value="">Kateqoriya seçin</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-secondary">Şəkil</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold text-secondary">Məqalə mətni</label>
                                <textarea name="content" class="form-control" rows="5" placeholder="Meqale metni...">{{ old('content') }}</textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-secondary">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Status seçin</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktiv</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Passiv</option>
                                </select>
                            </div>

                            <div class="col-12 d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm" style="border-radius: 8px;">
                                    Share
                                </button>
                                <a href="{{ route('admin.post.index') }}" class="btn btn-light border px-4 py-2" style="border-radius: 8px;">
                                    Geri qayıt
                                </a>
                            </div>
                        </div>
                    </form>

                    {{-- Xətaları görmək üçün (debug məqsədli saxlayıram, dizaynı pozmur) --}}
                    @if($errors->any())
                        <div class="alert alert-danger mt-4">
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