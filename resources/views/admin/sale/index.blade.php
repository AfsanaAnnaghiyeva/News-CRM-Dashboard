@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    {{-- Üst başlıq və Yeni Satış Düyməsi --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Satış Siyahısı</h2>
            <p class="text-muted">Sistemdəki bütün satış əməliyyatları burada göstərilir.</p>
        </div>
        <a href="{{ route('admin.sale.create') }}" class="btn btn-primary shadow-sm" style="border-radius: 10px;">
            <i class="bi bi-plus-lg me-1"></i> Yeni satış əlavə et
        </a>
    </div>

    {{-- Cədvəl Kartı --}}
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Müştəri</th>
                            <th>Xidmət</th>
                            <th>Qiymət</th>
                            <th>Tarix</th>
                            <th>Qeyd</th>
                            <th class="text-end pe-4">Əməliyyatlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td class="ps-4 text-muted">#{{ $sale->id }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $sale->customer->name ?? 'Naməlum' }}</div>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $sale->service->title ?? 'Xidmət yoxdur' }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-success">{{ number_format($sale->price, 2) }} AZN</span>
                            </td>
                            <td>
                                <div class="small">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d.m.Y') }}</div>
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($sale->note, 30) ?: '-' }}</small>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.sale.edit', $sale->id) }}" class="btn btn-sm btn-outline-warning" title="Redaktə et">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('admin.sale.delete', $sale->id) }}" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Bu satışı silmək istədiyinizə əminsiniz?')" 
                                       title="Sil">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Hələ ki, heç bir satış qeydə alınmayıb.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection