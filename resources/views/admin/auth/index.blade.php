<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş - {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5; /* Yumşaq boz rəng */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .btn-login {
            background-color: #0d6efd;
            border: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="card login-card bg-white">
        <div class="card-body">
            <h3 class="text-center mb-4 fw-bold text-dark">{{ $title }}</h3>

            <form action="{{ route('admin.auth.login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary small">E-poçt ünvanı</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           placeholder="nümunə@mail.com" autocomplete="off" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-secondary small">Şifrə</label>
                    <input type="password" name="password" id="password" class="form-control" 
                           placeholder="********" autocomplete="off" required>
                </div>

                <button type="submit" class="btn btn-primary btn-login w-100 py-2">
                    Daxil Ol
                </button>
            </form>

            <div class="mt-4 text-center">
                <small class="text-muted">Problem yarandı? Administratorla əlaqə saxlayın.</small>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>