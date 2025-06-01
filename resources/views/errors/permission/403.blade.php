<!DOCTYPE html>
<html>

<head>
    <title>403 Akses Ditolak</title>
    <style>
        :root {
            --color-danger: #e53e3e;
            --color-primary: #3490dc;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #f8fafc;
        }

        .error-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 2rem;
            border: 1px solid #e2e8f0;
        }

        h1 {
            color: var(--color-danger);
            border-bottom: 2px solid #eee;
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .permission-list {
            background: #f8f9fa;
            border-left: 4px solid var(--color-danger);
            padding: 1rem;
            margin: 1.5rem 0;
            border-radius: 0 4px 4px 0;
        }

        .btn {
            display: inline-block;
            background: var(--color-primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 1rem;
            transition: all 0.2s ease;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .error-icon {
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>
            <span class="error-icon">⛔</span>
            Akses Ditolak
        </h1>

        <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>

        @if (!empty($requiredPermissions))
            <div class="permission-list">
                <strong>Izin yang Diperlukan:</strong>
                <ul>
                    @foreach ($requiredPermissions as $permission)
                        <li>{{ $permission }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($requiredRoles))
            <div class="permission-list">
                <strong>Role yang Diperlukan:</strong>
                <ul>
                    @foreach ($requiredRoles as $role)
                        <li>{{ $role }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="btn-group">
            <a href="{{route('dashboard') }}" class="btn">Kembali ke Dashboard</a>

            @auth
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Kembali ke Halaman Sebelumnya
                </a>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-secondary">
                    Login ke Akun
                </a>
            @endguest
        </div>
    </div>
</body>

</html>
