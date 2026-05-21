@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    {{-- Xoş gəldin Paneli --}}
    <div class="card p-4 border-0 shadow-sm mb-4" style="border-radius: 15px; background: linear-gradient(to right, #ffffff, #f8f9ff);">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->full_name }}&background=0d6efd&color=fff" width="60" class="rounded-circle shadow-sm">
            </div>
            <div>
                <h2 class="fw-bold mb-1">Xoş gəldin, {{ auth()->user()->full_name }}! 👋</h2>
                <p class="text-muted mb-0">Sistemdə son vəziyyət və statistikalar aşağıdakı kimidir:</p>
            </div>
        </div>
    </div>

    {{-- Statistika Kartları --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <div class="text-primary fs-2 mb-2"><i class="bi bi-newspaper"></i></div>
                <h4 class="fw-bold mb-0">{{ $totalPosts }}</h4>
                <small class="text-muted">Xəbərlər</small>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <div class="text-secondary fs-2 mb-2"><i class="bi bi-chat-dots"></i></div>
                <h4 class="fw-bold mb-0">{{ $totalComments }}</h4>
                <small class="text-muted">Şərhlər</small>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <div class="text-success fs-2 mb-2"><i class="bi bi-people"></i></div>
                <h4 class="fw-bold mb-0">{{ $totalCustomers }}</h4>
                <small class="text-muted">Müştərilər</small>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
         <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
          <div class="text-warning fs-2 mb-2"><i class="bi bi-check2-circle"></i></div>
         
        <h4 class="fw-bold mb-0">{{ $activeTodosCount }}</h4>
        <small class="text-muted">Aktiv İşlər</small>
    </div>
</div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <div class="text-info fs-2 mb-2"><i class="bi bi-briefcase"></i></div>
                <h4 class="fw-bold mb-0">{{ $totalServices }}</h4>
                <small class="text-muted">Xidmətlər</small>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm p-3 text-center" style="border-radius: 12px;">
                <div class="text-danger fs-2 mb-2"><i class="bi bi-cart-check"></i></div>
                <h4 class="fw-bold mb-0">{{ $totalSales }}</h4>
                <small class="text-muted">Satışlar</small>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Qrafik 1: Müştəri Satış Aktivliyi --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
                <h5 class="fw-bold mb-4"><i class="bi bi-graph-up me-2"></i>Müştəri Satış Aktivliyi</h5>
                <canvas id="dashboardChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

        {{-- Qrafik 2: Aylıq Gəlir --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
                <h5 class="fw-bold mb-4"><i class="bi bi-cash-stack me-2"></i>Aylıq Gəlir Trendi (AZN)</h5>
                <canvas id="revenueChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

        {{-- Son Satışlar Cədvəli --}}
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
                <h5 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>Son Satışlar</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Müştəri</th>
                                <th>Xidmət</th>
                                <th>Məbləğ</th>
                                <th>Tarix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSales as $sale)
                            <tr>
                                <td class="fw-bold">{{ $sale->customer->name ?? 'Naməlum' }}</td>
                                <td><span class="badge bg-info text-dark">{{ $sale->service->title ?? 'Xidmət yoxdur' }}</span></td>
                                <td class="text-success fw-bold">{{ $sale->price }} AZN</td>
                                <td class="small text-muted">{{ $sale->created_at->format('d.m.Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Hələ ki, satış qeydə alınmayıb.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Son Tapşırıqlar --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 15px; min-height: 100%;">
                <h5 class="fw-bold mb-3"><i class="bi bi-list-task me-2"></i>Son Tapşırıqlar</h5>
                <ul class="list-group list-group-flush">
                    @forelse($lastTodos as $todo)
                        <li class="list-group-item px-0 border-0 d-flex align-items-center {{ $todo->status ? 'opacity-50' : '' }}">
                            <i class="bi {{ $todo->status ? 'bi-check-circle-fill text-success' : 'bi-circle text-primary' }} me-2"></i>
                            <span class="small {{ $todo->status ? 'text-decoration-line-through' : '' }}">{{ $todo->title }}</span>
                        </li>
                    @empty
                        <li class="list-group-item px-0 border-0 text-muted small">Hələ ki, tapşırıq yoxdur.</li>
                    @endforelse
                </ul>
                <a href="{{ route('admin.todo.index') }}" class="btn btn-light btn-sm mt-3 w-100">Hamısına bax</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Datalları alırıq
        const labels = {!! json_encode($labels) !!};
        const values = {!! json_encode($values ?? []) !!};
        const monthlyLabels = {!! json_encode($monthlyLabels) !!};
        const monthlyValues = {!! json_encode($monthlyValues ?? []) !!};

        // 1. Müştəri Aktivliyi (Line Chart) - Modern Dizayn
        const canvas1 = document.getElementById('dashboardChart');
        if (canvas1 && labels && labels.length > 0) {
            const ctx = canvas1.getContext('2d');
            let gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(13, 110, 253, 0.2)');
            gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Satış Sayı',
                        data: values,
                        borderColor: '#0d6efd',
                        backgroundColor: gradient,
                        fill: true,
                        borderWidth: 2,
                        tension: 0.5, // Xətti tam yumşaq (oval) edir
                        pointRadius: 5,
                        pointBackgroundColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            suggestedMax: Math.max(...values) +3, // Üstdən boşluq qoyur
                            ticks: { 
                                stepSize: 1,
                                precision: 0
                            } 
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        // 2. Aylıq Gəlir (Bar Chart) - Zərif Sütunlar
        const canvas2 = document.getElementById('revenueChart');
        if (canvas2 && monthlyLabels && monthlyLabels.length > 0) {
            new Chart(canvas2.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Gəlir (AZN)',
                        data: monthlyValues,
                        backgroundColor: '#198754',
                        borderRadius: 5, // Küncləri yuvarlaq edir
                        barPercentage: 0.6, // Sütunu xeyli incəldir
                        categoryPercentage: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { grid: { color: '#f0f0f0' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
    });
</script>
@endpush