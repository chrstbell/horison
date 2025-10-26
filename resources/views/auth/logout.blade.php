<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>HORISON - Logout</title>
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
                text-align: center;
            }

            .logo-section {
                position: relative;
                text-align: center;
                margin-bottom: 50px;
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
                max-width: 450px;
                max-height: 300px;
                width: auto;
                height: auto;
                margin: 0;
                object-fit: contain;
            }

            .logout-section {
                position: relative;
                z-index: 10;
                margin-top: 80px;
            }

            .logout-container {
                background-color: #f8f9fa;
                border-radius: 15px;
                padding: 40px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
                border: 2px solid #e9ecef;
            }

            .logout-icon {
                width: 80px;
                height: 80px;
                background-color: #dc3545;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 25px auto;
                color: white;
            }

            .logout-title {
                font-size: 28px;
                font-weight: bold;
                color: #2c3e50;
                margin-bottom: 15px;
                font-family: 'Inter', Arial, sans-serif;
            }

            .logout-message {
                font-size: 16px;
                color: #6c757d;
                margin-bottom: 35px;
                line-height: 1.5;
                font-family: 'Inter', Arial, sans-serif;
            }

            .button-container {
                display: flex;
                gap: 15px;
                justify-content: center;
            }

            .btn {
                padding: 12px 30px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                font-family: 'Inter', Arial, sans-serif;
                cursor: pointer;
                transition: all 0.2s;
                min-width: 120px;
            }

            .btn-danger {
                background-color: #dc3545;
                color: white;
            }

            .btn-danger:hover {
                background-color: #c82333;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
            }

            .btn-secondary {
                background-color: #6c757d;
                color: white;
            }

            .btn-secondary:hover {
                background-color: #5a6268;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
            }

            .btn:active {
                transform: translateY(0);
            }

            /* Loading state */
            .loading {
                opacity: 0.7;
                pointer-events: none;
            }

            .spinner {
                width: 20px;
                height: 20px;
                border: 2px solid transparent;
                border-top: 2px solid currentColor;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                display: inline-block;
                margin-right: 8px;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            /* Animation */
            .fade-in {
                animation: fadeIn 0.5s ease-in;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translate(-50%, -45%);
                }

                to {
                    opacity: 1;
                    transform: translate(-50%, -50%);
                }
            }

            /* Source indicator for debugging */
            .source-info {
                position: absolute;
                bottom: 20px;
                left: 20px;
                font-size: 12px;
                color: #6c757d;
                background: rgba(255, 255, 255, 0.9);
                padding: 5px 10px;
                border-radius: 4px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .form-wrapper {
                    width: 90%;
                    max-width: 400px;
                }

                .logout-container {
                    padding: 30px 20px;
                }

                .logout-title {
                    font-size: 24px;
                }

                .button-container {
                    flex-direction: column;
                    align-items: center;
                }

                .btn {
                    width: 100%;
                    max-width: 200px;
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="form-wrapper fade-in">

                <!-- Header dengan Logo -->
                <div class="logo-section">
                    <div class="logo-container">
                        <!-- Logo Image -->
                        <img src="{{ asset("images/logo 2.png") }}" alt="Logo" class="logo-image" />
                    </div>
                </div>

                <!-- Logout Section -->
                <div class="logout-section">
                    <div class="logout-container">
                        <!-- Logout Icon -->
                        <div class="logout-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16,17 21,12 16,7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                        </div>

                        <!-- Logout Message -->
                        <h2 class="logout-title">Konfirmasi Logout</h2>
                        <p class="logout-message" id="logoutMessage">
                            Apakah Anda yakin ingin keluar dari sistem?<br>
                            Anda akan diarahkan kembali ke halaman login.
                        </p>

                        <!-- Action Buttons -->
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" onclick="confirmLogout()" id="logoutBtn">
                                Ya, Logout
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="cancelLogout()" id="cancelBtn">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Source info for debugging (will be hidden in production) -->
            <div class="source-info" id="sourceInfo"></div>
        </div>

        <script>
            let isLoggingOut = false;
            let sourceSource = 'dashboard'; // default

            // Function to get URL parameter
            function getURLParameter(name) {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(name);
            }

            // Function to detect source from referrer or URL parameter
            function detectSource() {
                // Check URL parameter first (more reliable)
                const fromParam = getURLParameter('from');
                if (fromParam) {
                    return fromParam;
                }

                // Check referrer as fallback
                const referrer = document.referrer;
                if (referrer.includes('dashboard_dapur') || referrer.includes('dapur')) {
                    return 'dapur';
                } else if (referrer.includes('dashboard')) {
                    return 'dashboard';
                }

                // Default to dashboard
                return 'dashboard';
            }

            // Initialize page based on source
            function initializePage() {
                sourceSource = detectSource();

                // Update message based on source
                const messageEl = document.getElementById('logoutMessage');
                const sourceInfoEl = document.getElementById('sourceInfo');

                if (sourceSource === 'dapur') {
                    messageEl.innerHTML = `
                    Apakah Anda yakin ingin keluar dari sistem F&B?<br>
                    Anda akan diarahkan kembali ke halaman login.
                `;
                    sourceInfoEl.textContent = 'Source: F&B Dashboard';
                } else {
                    messageEl.innerHTML = `
                    Apakah Anda yakin ingin keluar dari sistem?<br>
                    Anda akan diarahkan kembali ke halaman login.
                `;
                    sourceInfoEl.textContent = 'Source: Main Dashboard';
                }

                // Hide source info in production (comment out the next line for debugging)
                sourceInfoEl.style.display = 'none';
            }

            function confirmLogout() {
                if (isLoggingOut) return;

                isLoggingOut = true;
                const logoutBtn = document.getElementById('logoutBtn');
                const container = document.querySelector('.logout-container');

                // Add loading state
                logoutBtn.innerHTML = '<span class="spinner"></span>Logging out...';
                logoutBtn.classList.add('loading');
                container.style.opacity = '0.7';

                // Perform actual logout
                fetch('{{ route("logout") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Show success message
                            container.innerHTML = `
                        <div class="logout-icon" style="background-color: #28a745;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20,6 9,17 4,12"/>
                            </svg>
                        </div>
                        <h2 class="logout-title">Logout Berhasil</h2>
                        <p class="logout-message">
                            Anda telah berhasil keluar dari sistem.<br>
                            Mengarahkan ke halaman login...
                        </p>
                    `;

                            container.style.opacity = '1';

                            // Redirect to login after successful logout
                            setTimeout(() => {
                                window.location.href = '{{ route("login") }}';
                            }, 2000);
                        } else {
                            throw new Error('Logout failed');
                        }
                    })
                    .catch(error => {
                        console.error('Logout error:', error);
                        // Show error message
                        container.innerHTML = `
                    <div class="logout-icon" style="background-color: #dc3545;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                    <h2 class="logout-title">Logout Gagal</h2>
                    <p class="logout-message">
                        Terjadi kesalahan saat logout.<br>
                        Silakan coba lagi.
                    </p>
                    <div class="button-container">
                        <button type="button" class="btn btn-danger" onclick="location.reload()">
                            Coba Lagi
                        </button>
                    </div>
                `;
                        container.style.opacity = '1';
                        isLoggingOut = false;
                    });
            }

            function cancelLogout() {
                // Return to appropriate dashboard based on source
                if (sourceSource === 'dapur') {
                    window.location.href = '{{ route("dapur.dashboard") }}';
                } else {
                    window.location.href = '{{ route("admin.dashboard") }}';
                }
            }

            // Handle ESC key to cancel
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !isLoggingOut) {
                    cancelLogout();
                }
            });

            // Auto focus on logout button
            window.addEventListener('load', function() {
                initializePage();
                document.getElementById('logoutBtn').focus();
            });
        </script>
    </body>

</html>
