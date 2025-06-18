<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Medical App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #1e3c72;
            --accent-color: #4facfe;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-gray: #f8f9fa;
            --dark-gray: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .register-container {
            max-width: 600px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .header-section {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
            text-align: center;
            padding: 40px 30px;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .header-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .header-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .form-section {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            font-size: 1rem;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            background: white;
            transform: translateY(-1px);
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger-color);
            background: #fff5f5;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark-gray);
            font-size: 1.1rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .input-icon:hover {
            color: var(--accent-color);
        }

        .btn-register {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            border: none;
            padding: 15px 30px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 20px;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(44, 90, 160, 0.3);
        }

        .btn-register:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: var(--dark-gray);
        }

        .login-link a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .alert-danger {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert-danger li {
            margin-bottom: 5px;
        }

        .role-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }

        .role-card {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .role-card:hover {
            border-color: var(--accent-color);
            background: white;
            transform: translateY(-2px);
        }

        .role-card.selected {
            border-color: var(--accent-color);
            background: rgba(79, 172, 254, 0.1);
        }

        .role-card i {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        .role-card h6 {
            margin: 0;
            color: var(--primary-color);
            font-weight: 600;
        }

        .role-card p {
            margin: 5px 0 0 0;
            font-size: 0.85rem;
            color: var(--dark-gray);
        }

        .password-strength {
            margin-top: 5px;
            font-size: 0.8rem;
        }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }

        .strength-weak { background: #dc3545; width: 25%; }
        .strength-medium { background: #ffc107; width: 50%; }
        .strength-good { background: #fd7e14; width: 75%; }
        .strength-strong { background: #28a745; width: 100%; }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-container {
                margin: 20px;
                max-width: none;
            }

            .header-section {
                padding: 30px 20px;
            }

            .header-title {
                font-size: 1.8rem;
            }

            .form-section {
                padding: 30px 20px;
            }

            .role-cards {
                grid-template-columns: 1fr;
            }
        }

        /* Form Animation */
        .form-group {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.6s ease forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }
        .form-group:nth-child(7) { animation-delay: 0.7s; }
        .form-group:nth-child(8) { animation-delay: 0.8s; }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <!-- Header Section -->
            <div class="header-section">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h1 class="header-title">Daftar Akun</h1>
                    <p class="header-subtitle">
                        Bergabunglah dengan platform kesehatan digital terpercaya
                    </p>
                </div>
            </div>

            <!-- Form Section -->
            <div class="form-section">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/register') }}" id="registerForm">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="bi bi-person"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="Masukkan nama lengkap Anda" required autofocus>
                        <i class="bi bi-person input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i>Email
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="Masukkan alamat email" required>
                        <i class="bi bi-envelope input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="no_ktp" class="form-label">
                            <i class="bi bi-card-text"></i>Nomor KTP
                        </label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" 
                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" 
                               placeholder="Masukkan 16 digit nomor KTP" required maxlength="16">
                        <i class="bi bi-card-text input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="no_hp" class="form-label">
                            <i class="bi bi-phone"></i>Nomor HP
                        </label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                               id="no_hp" name="no_hp" value="{{ old('no_hp') }}" 
                               placeholder="Contoh: 081234567890" required>
                        <i class="bi bi-phone input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="form-label">
                            <i class="bi bi-geo-alt"></i>Alamat Lengkap
                        </label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                               id="alamat" name="alamat" value="{{ old('alamat') }}" 
                               placeholder="Masukkan alamat lengkap" required>
                        <i class="bi bi-geo-alt input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock"></i>Password
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" 
                               placeholder="Minimal 8 karakter" required>
                        <i class="bi bi-eye-slash input-icon" onclick="togglePassword('password', this)"></i>
                        <div class="password-strength" id="password-strength">
                            <div class="strength-bar" id="strength-bar"></div>
                            <small id="strength-text"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <i class="bi bi-lock-fill"></i>Konfirmasi Password
                        </label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Ulangi password yang sama" required>
                        <i class="bi bi-eye-slash input-icon" onclick="togglePassword('password_confirmation', this)"></i>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-person-badge"></i>Daftar Sebagai
                        </label>
                        <div class="role-cards">
                            <div class="role-card selected" onclick="selectRole('pasien', this)">
                                <i class="bi bi-person-heart"></i>
                                <h6>Pasien</h6>
                                <p>Konsultasi & layanan kesehatan</p>
                            </div>
                            <div class="role-card" onclick="selectRole('dokter', this)">
                                <i class="bi bi-person-badge"></i>
                                <h6>Dokter</h6>
                                <p>Memberikan layanan medis</p>
                            </div>
                        </div>
                        <select class="form-select @error('role') is-invalid @enderror" 
                                id="role" name="role" style="display: none;">
                            <option value="pasien" selected>Pasien</option>
                            <option value="dokter">Dokter</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-register">
                        <span class="btn-text">Daftar Sekarang</span>
                    </button>
                </form>

                <div class="login-link">
                    <p>Sudah punya akun? <a href="{{ url('/login') }}">Login disini</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle icon
            if (type === 'text') {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }

        // Role selection
        function selectRole(role, element) {
            // Remove selected class from all cards
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            element.classList.add('selected');
            
            // Update hidden select
            document.getElementById('role').value = role;
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            let feedback = '';
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');
            
            strengthBar.className = 'strength-bar';
            
            switch (strength) {
                case 0:
                case 1:
                    strengthBar.classList.add('strength-weak');
                    feedback = 'Password terlalu lemah';
                    break;
                case 2:
                    strengthBar.classList.add('strength-medium');
                    feedback = 'Password cukup';
                    break;
                case 3:
                case 4:
                    strengthBar.classList.add('strength-good');
                    feedback = 'Password baik';
                    break;
                case 5:
                    strengthBar.classList.add('strength-strong');
                    feedback = 'Password sangat kuat';
                    break;
            }
            
            strengthText.textContent = feedback;
        }

        // Document ready
        document.addEventListener('DOMContentLoaded', function() {
            // KTP number validation
            const ktpInput = document.getElementById('no_ktp');
            ktpInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/\D/g, '');
            });

            // Phone number validation
            const phoneInput = document.getElementById('no_hp');
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value && !value.startsWith('0') && !value.startsWith('62')) {
                    value = '0' + value;
                }
                e.target.value = value;
            });

            // Password strength monitoring
            const passwordInput = document.getElementById('password');
            passwordInput.addEventListener('input', function(e) {
                checkPasswordStrength(e.target.value);
            });

            // Form submission with loading state
            const form = document.getElementById('registerForm');
            form.addEventListener('submit', function(e) {
                const button = form.querySelector('.btn-register');
                const buttonText = button.querySelector('.btn-text');
                
                button.disabled = true;
                buttonText.innerHTML = '<span class="loading"></span>Mendaftarkan...';
            });

            // Input focus effects
            const inputs = document.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });

            // Email validation
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('blur', function() {
                const email = this.value;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email && !emailRegex.test(email)) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            // Password confirmation validation
            const confirmPasswordInput = document.getElementById('password_confirmation');
            confirmPasswordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                const confirmPassword = this.value;
                
                if (confirmPassword && password !== confirmPassword) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        });
    </script>
</body>
</html>