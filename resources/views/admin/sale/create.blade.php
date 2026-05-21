@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Başlıq və Geri Qayıt --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-0">Yeni Satış Əlavə Et</h2>
                    <p class="text-muted small">Sistemə yeni bir xidmət satışı daxil edin.</p>
                </div>
                <a href="{{ route('admin.sale.index') }}" class="btn btn-outline-secondary shadow-sm" style="border-radius: 10px;">
                    <i class="bi bi-arrow-left me-1"></i> Geri qayıt
                </a>
            </div>

            {{-- Satış Formu --}}
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <form action="{{ route('admin.sale.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            {{-- Müştəri Seçimi --}}
                            <div class="col-md-6">
                                <label for="customer_id" class="form-label fw-bold text-secondary small">Müştəri Seçin</label>
                                <select name="customer_id" id="customer_id" class="form-select @error('customer_id') is-invalid @enderror" style="border-radius: 8px; height: 45px;">
                                    <option value="" selected disabled>-- Müştərini seçin --</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Xidmət Seçimi --}}
                            <div class="col-md-6">
                                <label for="service_id" class="form-label fw-bold text-secondary small">Xidmət Seçin</label>
                                <select name="service_id" id="service_id" class="form-select @error('service_id') is-invalid @enderror" style="border-radius: 8px; height: 45px;">
                                    <option value="" selected disabled>-- Xidməti seçin --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Qiymət --}}
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold text-secondary small">Satış Qiyməti</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 8px 0 0 8px;">₼</span>
                                    <input type="number" step="0.01" name="price" id="price" 
                                           class="form-control border-start-0 @error('price') is-invalid @enderror" 
                                           value="{{ old('price') }}" placeholder="0.00"
                                           style="border-radius: 0 8px 8px 0; height: 45px;">
                                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Tarix --}}
                            <div class="col-md-6">
                                <label for="sale_date" class="form-label fw-bold text-secondary small">Satış Tarixi</label>
                                <input type="date" name="sale_date" id="sale_date" 
                                       class="form-control @error('sale_date') is-invalid @enderror" 
                                       value="{{ old('sale_date', date('Y-m-d')) }}" 
                                       style="border-radius: 8px; height: 45px;">
                                @error('sale_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Qeyd --}}
                            <div class="col-12">
                                <label for="note" class="form-label fw-bold text-secondary small">Qeyd (Könüllü)</label>
                                <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" 
                                          rows="4" style="border-radius: 8px;" 
                                          placeholder="Satış haqqında əlavə qeydləriniz...">{{ old('note') }}</textarea>
                                @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Göndər Düyməsi --}}
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm" style="border-radius: 10px; height: 50px;">
                                    <i class="bi bi-cart-plus me-2"></i> Satışı Tamamla
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    @if($errors->any())
                        <div class="alert alert-danger mt-4 border-0 shadow-sm" style="border-radius: 10px;">
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)
                                    <li><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</li>
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