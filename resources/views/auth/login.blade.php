<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HORISON - Login</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', Arial, sans-serif;
                background-color: #f5f5f5;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .container {
                width: 100vw;
                height: 100vh;
                background-color: #ffffff;
                position: relative;
                overflow: hidden;
                margin: 0 auto;
                min-width: 1200px;
            }

            .form-wrapper {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                width: 500px;
            }

            .logo-section {
                position: relative;
                text-align: center;
                margin-bottom: 60px;
            }

            .logo-container {
                position: absolute;
                width: 500px;
                height: 120px;
                left: 50%;
                top: -90px;
                transform: translateX(-50%);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .logo-image {
                max-width: 500px;
                max-height: 400px;
                width: auto;
                height: auto;
                margin: 0;
                object-fit: contain;
            }

            .form-section {
                position: relative;
                z-index: 10;
                margin-top: 80px;
            }

            .form-container {
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .input-field {
                position: relative;
            }

            .input-field input {
                width: 100%;
                height: 70px;
                padding: 0 20px;
                background-color: #d1ad71;
                border: none;
                border-radius: 8px;
                color: #ffffff;
                font-size: 18px;
                font-weight: 500;
                font-family: 'Inter', Arial, sans-serif;
                outline: none;
                box-sizing: border-box;
            }

            .input-field input::placeholder {
                color: #ffffff;
                opacity: 0.8;
            }

            .password-field input {
                padding-right: 60px;
            }

            .toggle-password {
                position: absolute;
                right: 18px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #ffffff;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 6px;
                opacity: 0.8;
                transition: opacity 0.2s;
            }

            .toggle-password:hover {
                opacity: 1;
            }

            .login-button {
                width: 100%;
                height: 50px;
                background-color: #d1ad71;
                color: #ffffff;
                font-size: 16px;
                font-weight: 600;
                font-family: 'Inter', Arial, sans-serif;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                margin-top: 15px;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .login-button:hover {
                background-color: #c19d65;
            }

            .login-button:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .login-button:disabled:hover {
                background-color: #d1ad71;
            }

            .spinner {
                width: 16px;
                height: 16px;
                border: 2px solid #ffffff;
                border-top: 2px solid transparent;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .eye-icon {
                width: 22px;
                height: 22px;
            }

            .error {
                color: #b91c1c;
                font-size: 14px;
                margin-top: 6px;
            }

            @media (max-width: 768px) {
                .container {
                    min-width: unset;
                }

                .form-wrapper {
                    width: 90%;
                    max-width: 400px;
                }

                .logo-container {
                    width: 100%;
                }

                .input-field input {
                    height: 60px;
                    font-size: 16px;
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="form-wrapper">
                <!-- Header dengan Logo -->
                <div class="logo-section">
                    <div class="logo-container">
                        <img src="{{ asset("images/logo 2.png") }}" alt="Logo" class="logo-image" />
                    </div>
                </div>

                <!-- Form Login -->
                <div class="form-section">
                    <form class="form-container" id="loginForm" action="{{ route("login.post") }}" method="POST"
                        onsubmit="return handleLogin(event)">
                        @csrf

                        <!-- Username Field -->
                        <div class="input-field">
                            <input type="text" id="username" name="username" placeholder="username/email"
                                value="{{ old("username") }}" required />
                            @error("username")
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="input-field password-field">
                            <input type="password" id="password" name="password" placeholder="password" required />
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <svg class="eye-icon" id="eye-open" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg class="eye-icon" id="eye-closed" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" style="display: none;">
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </button>
                            @error("password")
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="login-button" id="loginBtn">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            let isLoading = false;

            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const eyeOpen = document.getElementById('eye-open');
                const eyeClosed = document.getElementById('eye-closed');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeOpen.style.display = 'none';
                    eyeClosed.style.display = 'block';
                } else {
                    passwordInput.type = 'password';
                    eyeOpen.style.display = 'block';
                    eyeClosed.style.display = 'none';
                }
            }

            // Keep your Enter-to-submit behavior
            document.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const form = document.getElementById('loginForm');
                    if (form) form.requestSubmit();
                }
            });

            // Show spinner and let Laravel handle redirect
            function handleLogin(e) {
                if (isLoading) return false;

                const username = document.getElementById('username').value.trim();
                const password = document.getElementById('password').value.trim();

                if (!username || !password) {
                    alert('Harap isi username/email dan password');
                    return false;
                }

                isLoading = true;
                const loginBtn = document.getElementById('loginBtn');
                loginBtn.disabled = true;
                loginBtn.innerHTML = '<div class="spinner"></div> Sedang Login...';
                // Allow normal form submit to server
                return true;
            }
        </script>
    </body>

</html>
