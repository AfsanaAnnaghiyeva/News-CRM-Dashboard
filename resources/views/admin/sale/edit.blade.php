@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Başlıq və Geri Qayıt --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Satışın Redaktəsi</h2>
                <a href="{{ route('admin.sale.index') }}" class="btn btn-outline-secondary shadow-sm" style="border-radius: 10px;">
                    <i class="bi bi-arrow-left me-1"></i> Siyahıya qayıt
                </a>
            </div>

            {{-- Redaktə Formu --}}
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <form action="{{ route('admin.sale.update', ['sale_id' => $sale->id]) }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            {{-- Müştəri Seçimi --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Müştəri</label>
                                <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" style="border-radius: 8px;">
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $sale->customer_id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Xidmət Seçimi --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Xidmət</label>
                                <select name="service_id" class="form-select @error('service_id') is-invalid @enderror" style="border-radius: 8px;">
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ $sale->service_id == $service->id ? 'selected' : '' }}>
                                            {{ $service->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Qiymət --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Qiymət (AZN)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">₼</span>
                                    <input type="number" step="0.01" name="price" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price', $sale->price) }}" 
                                           style="border-radius: 0 8px 8px 0;">
                                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Tarix --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Satış Tarixi</label>
                                <input type="date" name="sale_date" 
                                       class="form-control @error('sale_date') is-invalid @enderror" 
                                       value="{{ old('sale_date', $sale->sale_date) }}" 
                                       style="border-radius: 8px;">
                                @error('sale_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Qeyd --}}
                            <div class="col-12">
                                <label class="form-label fw-bold">Qeyd (İstəyə bağlı)</label>
                                <textarea name="note" class="form-control @error('note') is-invalid @enderror" 
                                          rows="3" style="border-radius: 8px;" 
                                          placeholder="Əlavə məlumat yazın...">{{ old('note', $sale->note) }}</textarea>
                                @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Düymə --}}
                            <div class="col-12 mt-4 text-end">
                                <button type="submit" class="btn btn-success px-5 shadow-sm" style="border-radius: 10px;">
                                    <i class="bi bi-check-circle me-1"></i> Məlumatları Yenilə
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Xətaların Göstərilməsi --}}
                    @if($errors->any())
                        <div class="alert alert-danger mt-4 border-0 shadow-sm" style="border-radius: 10px;">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li><i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}</li>
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