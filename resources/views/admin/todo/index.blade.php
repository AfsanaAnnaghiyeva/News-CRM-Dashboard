@extends('layouts.admin')

@section('content')

<style>

    .task-card { transition: all .4s ease; }
    .task-card:hover { transform: scale(1.01); box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important; }
    .form-control:focus { box-shadow: none; background-color: #fff !important; border: 1px solid #0d6efd44 !important; }
    .status-icon i { transition: 0.3s; }
    .task-card:hover .status-icon i { transform: scale(1.2); }
    .shadow-xs { box-shadow: 0 2px 5px rgba(0,0,0,0.03); }
    .custom-todo-input .form-control {
        border: 0;
        box-shadow: none !important;
        outline: 0;
    }
     .form-control{background-color: #f8f9fa;}
    .custom-todo-input {
        overflow: hidden; 
        background-color: #f8f9fa;
        border-radius: 0 !important;
    }
    .custom-todo-input .form-control,
    .custom-todo-input .btn {
        border-radius: 0 !important; 
    }
    @media (max-width: 576px) {
        .form-control{font-size: .9em!important}
        .task-card .card-body > div {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 15px;
        }
        .task-card .btn-group {
            width: 100%;
            justify-content: space-between;
        }
        .btn-group .btn i {
            font-size: 1.1rem;
        }
        .welcome-section h4 {
        font-size: 1.25rem !important;
    }
        .welcome-section p {
        font-size: 0.85rem !important;
    }
        .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            
            <div class="mb-4 text-center text-md-start welcome-section">
                <h4 class="fw-bold text-dark mb-1">Xoş gəldin, {{ auth()->user()->full_name }}! 👋</h4>
                <p class="text-muted small">Bu gün üçün planların nələrdir?</p>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-3">
                    <form action="{{ route('admin.todo.store') }}" method="POST">
                        @csrf 
                        <div class="input-group input-group-lg custom-todo-input">
                            <input type="text" name="title" class="form-control fs-7" 
                                   placeholder="Yeni tapşırıq...  "  >
                            <button type="submit" class="btn btn-primary px-4" >
                                <i class="bi bi-plus-circle-fill"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="todo-list">

                @forelse($todos as $todo)
                
                @php 
                    $isDone = $todo->is_completed;
                    $borderColor = $isDone ? '#198754' : '#ffc107';
                    $textClass = $isDone ? 'text-decoration-line-through text-muted opacity-50' : 'fw-bold text-dark';
                @endphp

                <div class="card border-0 shadow-sm mb-3 task-card" 
                     style="border-radius: 15px; border-left: 5px solid ">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="status-icon">
                                    @if($isDone)
                                        <i class="bi bi-check-circle-fill text-success fs-6"></i>
                                    @else
                                        <i class="bi bi-circle text-warning fs-6"></i>
                                    @endif
                                </div>
                                
                                <div>
                                    <h6 class="mb-0 {{ $textClass }}" >
                                        {{ $todo->title }}
                                    </h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        <i class="bi bi-calendar3 me-1"></i> {{ $todo->created_at->format('d.m.Y') }}
                                    </small>
                                </div>
                            </div>

                            <div class="btn-group shadow-xs rounded-pill bg-light p-1">
                                <a href="{{ route('admin.todo.edit', ['todo_id' => $todo->id]) }}" 
                                   class="btn btn-sm btn-link text-primary p-1 px-2" title="Düzəliş et">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('admin.todo.delete', ['todo_id' => $todo->id]) }}" 
                                   class="btn btn-sm btn-link text-danger p-1 px-2"
                                   onclick="return confirm('Silinsin?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                    <i class="bi bi-journal-check display-1 text-muted opacity-25"></i>
                    <p class="mt-3 text-muted fw-medium">Bütün işlər bitib! 😎</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

@endsection