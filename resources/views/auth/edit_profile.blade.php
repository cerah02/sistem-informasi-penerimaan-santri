<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 900px;
            margin: auto;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .profile-img-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 160px;
            height: 160px;
            border: 4px solid #667eea;
            padding: 5px;
            transition: transform 0.3s, border-color 0.3s;
            border-radius: 50%;
        }

        .profile-img:hover {
            transform: scale(1.08);
            border-color: #764ba2;
        }

        .upload-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #667eea;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, transform 0.3s;
        }

        .upload-btn:hover {
            background: #764ba2;
            transform: scale(1.1);
        }

        .upload-btn input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .info-box {
            background: rgba(240, 240, 255, 0.9);
            border-left: 5px solid #667eea;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-top: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5563c1, #5a3d8e);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .profile-info-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid rgba(102, 126, 234, 0.2);
            background: rgba(240, 240, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .profile-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .detail-item {
            background: rgba(255, 255, 255, 0.7);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            border-left: 3px solid #667eea;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .detail-item:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .profile-details p {
            font-size: 0.95rem;
        }

        .text-primary {
            color: #667eea !important;
        }

        h2 {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #667eea;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #4a5257);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-card">
            <div class="row justify-content-center align-items-center">
                <!-- Profil dan Informasi dalam Satu Card -->
                <div class="col-md">
                    <!-- Form Edit Profil -->
                    <div class="col-md-8 mx-auto">
                        <h2 class="text-center mb-4">Edit Profile</h2>
                        <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="text-center mb-4">
                                <div class="profile-img-container">
                                    <img src="{{ asset('storage/profil/' . (auth()->user()->foto ?? 'default.png')) }}"
                                        class="profile-img rounded-circle" id="preview-image">
                                    <div class="upload-btn">
                                        <i class="fas fa-camera"></i>
                                        <input type="file" class="form-control" name="profile_image"
                                            id="profile-image-input" onchange="previewImage(event)">
                                    </div>
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="mt-3 mb-0 fw-bold">{{ Auth::user()->name }}</h5>
                                    <small class="text-muted">{{ Auth::user()->getRoleNames()[0] }}</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-user me-2"></i>Name</label>
                                <input type="text" class="form-control form-control-lg" name="name"
                                    value="{{ auth()->user()->name }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                <input type="email" class="form-control form-control-lg" name="email"
                                    value="{{ auth()->user()->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-key me-2"></i>Password</label>
                                <input type="password" class="form-control form-control-lg" name="password"
                                    placeholder="**********">
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg rounded-pill">
                                    <i class="icofont icofont-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4 ms-3">
                                    <i class="fas fa-save me-2"></i>Simpan perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview-image');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>
