@extends("layouts.admin")

@section("title", "Dashboard")

@push("styles")
    <style>
        /* Pengguna Section - Updated positioning */
        .pengguna-section {
            position: absolute;
            left: 20px;
            top: 416px;
            width: 310px;
            z-index: 3;
        }

        .pengguna-title {
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 20px;
            padding-left: 0;
            z-index: 3;
            position: relative;
        }

        .pengguna-container {
            width: 310px;
            /* Adjusted height to accommodate the new button */
            height: 140px;
            /* Increased from 89px to 140px */
            background-color: #ededed;
            border-radius: 8px;
            padding: 22px 16px;
            display: flex;
            flex-direction: column;
            /* Changed to column to stack buttons */
            gap: 15px;
            /* Added gap for spacing between buttons */
        }

        .pengguna-button {
            width: 280px;
            height: 45px;
            background-color: #a58857;
            border: none;
            border-radius: 6px;
            color: #ededed;
            font-size: 16px;
            font-weight: bold;
            font-family: 'Inter', Arial, sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            text-align: left;
            padding-left: 16px;
            display: flex;
            align-items: center;
        }

        .pengguna-button:hover {
            background-color: #96794d;
            transform: translateX(3px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pengguna-button:active {
            transform: translateX(2px);
        }

        .logout-section {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 350px;
            height: 55px;
            background-color: #ededed;
            border-radius: 0 18px 18px 0;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 3;
        }

        .logout-section:hover {
            background-color: #e0e0e0;
        }

        .logout-icon {
            width: 24px;
            height: 24px;
            margin-left: 25px;
            margin-right: 12px;
        }

        .logout-text {
            font-size: 18px;
            font-weight: 600;
            color: #000000;
            font-family: 'Inter', Arial, sans-serif;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px 50px;
            background-color: #ffffff;
            margin-left: 350px;
            min-height: 100vh;
        }

        .header-section {
            margin-bottom: 40px;
        }

        .header-section h1 {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .header-section .breadcrumb {
            font-size: 16px;
            color: #7f8c8d;
            font-weight: 500;
        }

        .breadcrumb a {
            color: #a58857;
            text-decoration: none;
            cursor: pointer;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .add-user-btn {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Inter', Arial, sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.2);
        }

        .add-user-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.3);
            background: linear-gradient(135deg, #229954, #27ae60);
        }

        .reset-btn {
            background: linear-gradient(135deg, #e67e22, #f39c12);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Inter', Arial, sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.2);
        }

        .reset-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(243, 156, 18, 0.3);
            background: linear-gradient(135deg, #d68910, #e67e22);
        }

        .add-time-btn {
            background: linear-gradient(135deg, #8e44ad, #9b59b6);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Inter', Arial, sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(155, 89, 182, 0.2);
        }

        .add-time-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(155, 89, 182, 0.3);
            background: linear-gradient(135deg, #7d3c98, #8e44ad);
        }

        .add-icon,
        .reset-icon,
        .time-icon {
            width: 20px;
            height: 20px;
        }

        /* Category Navigation */
        .category-nav {
            background-color: #f8f9fa;
            border-radius: 50px;
            padding: 8px;
            margin-bottom: 40px;
            position: relative;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: fit-content;
            min-width: 600px;
        }

        .nav-indicator {
            position: absolute;
            background: linear-gradient(135deg, #a58857, #c9a876);
            border-radius: 50px;
            height: 44px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(165, 136, 87, 0.3);
            z-index: 1;
        }

        .nav-item {
            padding: 12px 28px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Inter', Arial, sans-serif;
            border: none;
            background: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            color: #2c3e50;
            border-radius: 50px;
            min-width: 120px;
            text-align: center;
        }

        .nav-item:hover {
            transform: translateY(-1px);
        }

        .nav-item.active {
            color: #ffffff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Content Section */
        .content-section {
            background-color: #ffffff;
            min-height: 500px;
        }

        .divider-line {
            width: 100%;
            height: 1px;
            background-color: #cccccc;
            margin: 30px 0;
        }

        .user-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .user-card {
            background-color: #ededed;
            border-radius: 7px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
            height: 62px;
            position: relative;
        }

        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            font-size: 20px;
            font-weight: 600;
            color: #000000;
            font-family: 'Inter', Arial, sans-serif;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout-btn {
            background-color: #d71e25;
            color: white;
            border: none;
            border-radius: 41px;
            padding: 8px 18px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Inter', Arial, sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            min-width: 109px;
            height: 32px;
        }

        .logout-btn:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
        }

        .logout-btn.disabled {
            background-color: #848484;
            cursor: not-allowed;
        }

        .logout-btn.disabled:hover {
            background-color: #848484;
            transform: none;
        }

        .delete-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            transition: transform 0.2s ease;
        }

        .delete-btn:hover {
            transform: scale(1.1);
        }

        .delete-icon {
            width: 24px;
            height: 24px;
            color: #d71e25;
        }

        .see-all-btn {
            background-color: #2c3e50;
            color: #ededed;
            border: none;
            border-radius: 10px;
            padding: 6px 20px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', Arial, sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 30px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .see-all-btn:hover {
            background-color: #34495e;
            transform: translateY(-1px);
        }

        .see-all-btn.hidden {
            display: none;
        }

        .timer-expired {
            color: #848484 !important;
        }

        .blinking {
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            50% {
                opacity: 1;
            }

            51%,
            100% {
                opacity: 0.3;
            }
        }

        /* Timer Display */
        .timer-display {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: #27ae60;
            margin-left: 10px;
            padding: 4px 8px;
            background-color: rgba(39, 174, 96, 0.1);
            border-radius: 6px;
            font-size: 14px;
            min-width: 50px;
            text-align: center;
        }

        .timer-warning {
            color: #f39c12 !important;
            background-color: rgba(243, 156, 18, 0.1) !important;
        }

        .timer-critical {
            color: #e74c3c !important;
            background-color: rgba(231, 76, 60, 0.1) !important;
            animation: blink 1s infinite;
        }

        /* New User Badge */
        .new-user-badge {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 12px;
            margin-left: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Reset Animation */
        .reset-animation {
            animation: resetPulse 0.6s ease-out;
        }

        @keyframes resetPulse {
            0% {
                transform: scale(1);
                background-color: #ededed;
            }

            50% {
                transform: scale(1.02);
                background-color: #d5f3d0;
            }

            100% {
                transform: scale(1);
                background-color: #ededed;
            }
        }

        /* Add Time Animation */
        .add-time-animation {
            animation: addTimePulse 0.6s ease-out;
        }

        @keyframes addTimePulse {
            0% {
                transform: scale(1);
                background-color: #ededed;
            }

            50% {
                transform: scale(1.02);
                background-color: #e8d5f3;
            }

            100% {
                transform: scale(1);
                background-color: #ededed;
            }
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 450px;
            transform: translateY(-30px);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .modal-header h3 {
            font-size: 22px;
            color: #2c3e50;
            font-weight: 700;
        }

        .modal-body p {
            font-size: 16px;
            color: #34495e;
            line-height: 1.6;
            text-align: center;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
            margin-top: 15px;
        }

        .modal-button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .confirm-button {
            background-color: #e74c3c;
            color: white;
        }

        .confirm-button:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.2);
        }

        .cancel-button {
            background-color: #95a5a6;
            color: white;
        }

        .cancel-button:hover {
            background-color: #7f8c8d;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(149, 165, 166, 0.2);
        }

        .reset-confirm-button {
            background-color: #f39c12;
            color: white;
        }

        .reset-confirm-button:hover {
            background-color: #e67e22;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(243, 156, 18, 0.2);
        }

        .add-time-confirm-button {
            background-color: #9b59b6;
            color: white;
        }

        .add-time-confirm-button:hover {
            background-color: #8e44ad;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(155, 89, 182, 0.2);
        }

        /* Add User Form Styles */
        .add-user-form {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .add-user-form.active {
            opacity: 1;
            visibility: visible;
        }

        .form-container {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(-30px);
            transition: transform 0.3s ease;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .add-user-form.active .form-container {
            transform: translateY(0);
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }

        .close-form-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #7f8c8d;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .close-form-btn:hover {
            background-color: #f8f9fa;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-input {
            width: 100%;
            background-color: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 12px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            color: #2c3e50;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            background-color: #ffffff;
            border-color: #a58857;
            box-shadow: 0 0 0 3px rgba(165, 136, 87, 0.1);
        }

        .form-input::placeholder {
            color: #95a5a6;
        }

        .category-section {
            margin: 30px 0;
        }

        .category-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .category-options {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .category-option {
            background-color: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 25px;
            padding: 10px 20px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #7f8c8d;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }

        .category-option:hover {
            background-color: #e9ecef;
        }

        .category-option.active {
            background-color: #a58857;
            border-color: #a58857;
            color: white;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .form-btn {
            flex: 1;
            height: 50px;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn {
            background-color: #27ae60;
            color: white;
        }

        .submit-btn:hover {
            background-color: #229954;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.2);
        }

        .cancel-form-btn {
            background-color: #e74c3c;
            color: white;
        }

        .cancel-form-btn:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.2);
        }

        /* Alert Styles */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            z-index: 3000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .alert.success {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
        }

        .alert.error {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }

        .alert.show {
            opacity: 1;
            transform: translateX(0);
        }

        @keyframes slideInFromRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutToRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 1400px) {
            .sidebar {
                width: 350px;
            }

            .sidebar-overlay {
                width: 40px;
            }
        }

        @media (max-width: 1200px) {
            .main-content {
                padding: 30px 40px;
            }

            .category-nav {
                min-width: 500px;
            }
        }

        @media (max-width: 768px) {
            .button-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .category-nav {
                min-width: 400px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-item {
                min-width: 100px;
                padding: 10px 20px;
                font-size: 14px;
            }

            .form-container {
                padding: 30px 25px;
                margin: 20px;
                width: calc(100% - 40px);
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section("content")
    <div class="header-section">
        <h1>Pengguna</h1>
        <div class="breadcrumb">
            <a href="{{ route("admin.dashboard") }}">Dashboard</a> > Pengguna
        </div>
        <div class="button-group">
            <button class="add-user-btn" onclick="showAddUserForm()">
                <svg class="add-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah daftar pengguna
            </button>
            <button class="reset-btn" onclick="showResetModal()">
                <svg class="reset-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                    <path d="M21 3v5h-5" />
                    <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                    <path d="M3 21v-5h5" />
                </svg>
                Reset Semua User
            </button>
            <button class="add-time-btn" onclick="showAddTimeModal()">
                <svg class="time-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12,6 12,12 16,14"></polyline>
                    <path d="M16 8l2-2M16 8l-2 2"></path>
                </svg>
                Tambah 10 Menit
            </button>
        </div>
    </div>

    <!-- Category Navigation -->
    <div class="category-nav">
        <div class="nav-indicator" id="navIndicator"></div>
        <button class="nav-item active" onclick="switchCategory('user', this)" data-category="user">
            User
        </button>
        <button class="nav-item" onclick="switchCategory('admin', this)" data-category="admin">
            Admin
        </button>
        <button class="nav-item" onclick="switchCategory('kitchen', this)" data-category="kitchen">
            F&B
        </button>
    </div>

    <div class="divider-line"></div>

    <!-- Content Section -->
    <div class="content-section">
        <div class="user-list" id="userList">
            <!-- User cards akan dimuat di sini -->
        </div>
        <button class="see-all-btn" id="seeAllBtn" onclick="toggleUserView()">
            Lihat Semua User
        </button>
    </div>

    <!-- Add User Form -->
    <div id="addUserForm" class="add-user-form">
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Tambah Pengguna Baru</h2>
                <button class="close-form-btn" onclick="closeAddUserForm()">×</button>
            </div>

            <form id="userForm" onsubmit="submitUserForm(event)">
                <div class="form-group">
                    <label class="form-label" for="usernameInput">Username / No. Kamar</label>
                    <input type="text" class="form-input" id="usernameInput" name="username"
                        placeholder="Contoh: Kamar 103 / user103" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-input" id="password" name="password" placeholder="Masukkan password"
                        required>
                </div>

                <input type="hidden" id="categoryInput" name="category" value="user">

                <div class="category-section">
                    <h3 class="category-title">Kategori</h3>
                    <div class="category-options">
                        <button type="button" class="category-option active"
                            onclick="selectFormCategory('user')">User</button>
                        <button type="button" class="category-option" onclick="selectFormCategory('admin')">Admin</button>
                        <button type="button" class="category-option" onclick="selectFormCategory('kitchen')">F&B</button>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="form-btn submit-btn">Tambah</button>
                    <button type="button" class="form-btn cancel-form-btn" onclick="closeAddUserForm()">Batal</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Alert notification -->
    <div id="alert" class="alert"></div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Konfirmasi Log Out</h3>
            </div>
            <div class="modal-body">
                <p id="logoutMessage">Apakah Anda yakin ingin log out pengguna ini?</p>
            </div>
            <div class="modal-footer">
                <button class="modal-button cancel-button" onclick="closeLogoutModal()">Batal</button>
                <button class="modal-button confirm-button" onclick="confirmLogout()">Log Out</button>
            </div>
        </div>
    </div>

    <!-- Reset Confirmation Modal -->
    <div id="resetModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Konfirmasi Reset</h3>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mereset semua user ke status login awal?<br><br>
                    <strong>Ini akan:</strong><br>
                    - Mengaktifkan kembali semua user yang sudah logout<br>
                    - Mereset timer ke 00:00 (login baru/fresh)<br>
                    - Mengaktifkan kembali tombol logout yang berwarna merah<br>
                    - Memulai timer dari awal untuk semua user
                </p>
            </div>
            <div class="modal-footer">
                <button class="modal-button cancel-button" onclick="closeResetModal()">Batal</button>
                <button class="modal-button reset-confirm-button" onclick="confirmReset()">Reset</button>
            </div>
        </div>
    </div>

    <!-- Add Time Confirmation Modal -->
    <div id="addTimeModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Konfirmasi Tambah Waktu</h3>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menambah 10 menit ke semua user yang aktif?<br><br>
                    <strong>Ini akan:</strong><br>
                    - Menambah 10 menit ke timer semua user yang sedang aktif<br>
                    - User yang sudah logout tidak akan terpengaruh<br>
                    - Timer akan bertambah maju 10 menit dari waktu saat ini
                </p>
            </div>
            <div class="modal-footer">
                <button class="modal-button cancel-button" onclick="closeAddTimeModal()">Batal</button>
                <button class="modal-button add-time-confirm-button" onclick="confirmAddTime()">Tambah Waktu</button>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        const rawUserData = @json($user_data);
        const initialUserData = rawUserData.reduce((acc, user) => {
            if (!acc[user.role]) {
                acc[user.role] = [];
            }
            acc[user.role].push(user);
            return acc;
        }, {});


        // Data pengguna dengan informasi waktu login - TEMPLATE UNTUK RESET

        // Initialize data
        let userData = {};
        let currentCategory = 'user';
        let timers = new Map();
        let pendingLogoutUser = null;
        let showingAllUsers = false;
        let selectedFormCategory = 'user';
        // userCounter disesuaikan agar ID baru tidak bentrok dengan ID awal
        let userCounter = {
            user: 1003,
            admin: 2,
            kitchen: 2
        };

        // // Fungsi untuk generate random login time (1-20 menit yang lalu)
        // function generateRandomLoginTime() {
        //     return Date.now() - (Math.floor(Math.random() * 20 + 1) * 60 * 1000);
        // }

        // // Fungsi untuk generate fresh login time (sekarang - baru login)
        // function generateFreshLoginTime() {
        //     return Date.now();
        // }

        // Fungsi untuk menginisialisasi data user dari database
        function initializeUserData() {
            const data = {};

            Object.keys(initialUserData).forEach(category => {
                data[category] = initialUserData[category].map(user => ({
                    ...user,
                    isNewUser: false
                }));
            });

            return data;
        }

        // Fungsi untuk reset data user (timer mulai dari 0)
        // TESTING
        // function resetUserData() {
        //     const data = {};

        //     Object.keys(initialUserData).forEach(category => {
        //         data[category] = initialUserData[category].map(user => ({
        //             ...user,
        //             loginTime: user.hasTimer ? generateFreshLoginTime() : null,
        //             isActive: true,
        //             isNewUser: false
        //         }));
        //     });

        //     return data;
        // }

        // Fungsi untuk menampilkan alert
        function showAlert(message, type) {
            const alert = document.getElementById('alert');
            alert.textContent = message;
            alert.className = 'alert ' + type;
            alert.classList.add('show');

            setTimeout(() => {
                alert.classList.remove('show');
            }, 3000);
        }

        // Form functions
        function showAddUserForm() {
            const form = document.getElementById('addUserForm');
            form.classList.add('active');
            document.getElementById('usernameInput').focus(); // Mengubah fokus ke usernameInput
        }

        function closeAddUserForm() {
            const form = document.getElementById('addUserForm');
            form.classList.remove('active');
            resetUserForm();
        }

        function resetUserForm() {
            document.getElementById('userForm').reset();
            // Reset category selection
            document.querySelectorAll('.category-option').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector('.category-option').classList.add('active');
            selectedFormCategory = 'user';
        }

        function selectFormCategory(category) {
            selectedFormCategory = category;
            document.getElementById('categoryInput').value = category;
            document.querySelectorAll('.category-option').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }


        function generateUserId(category) {
            const prefix = category;
            const counter = userCounter[category]++;
            // Pastikan format ID selalu 3 digit untuk konsistensi
            return prefix + '_' + counter.toString().padStart(3, '0');
        }

        function submitUserForm(event) {
            event.preventDefault();

            const usernameInput = document.getElementById('usernameInput').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!usernameInput || !password) {
                showAlert('Mohon isi semua field!', 'error');
                return;
            }
            if (password.length < 3) {
                showAlert('Password minimal 3 karakter!', 'error');
                return;
            }

            const storeUserUrl = "{{ route("admin.users.store") }}";

            fetch(storeUserUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        username: usernameInput,
                        password: password,
                        role: selectedFormCategory
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showAlert(data.message, 'success');
                        closeAddUserForm();
                        loadUserData(currentCategory);
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    showAlert('Terjadi kesalahan server!', 'error');
                });
        }


        // Helper function to parse login_expiry from server
        function parseLoginExpiry(loginExpiry) {
            if (!loginExpiry) return null;
            let expiryMs = Date.parse(loginExpiry);
            if (Number.isNaN(expiryMs)) {
                expiryMs = Date.parse(loginExpiry + 'Z');
            }
            if (Number.isNaN(expiryMs)) {
                expiryMs = Date.parse(loginExpiry.replace(' ', 'T') + 'Z');
            }
            return Number.isNaN(expiryMs) ? null : expiryMs;
        }

        // FUNGSI TIMER REAL-TIME
        function formatTimer(milliseconds) {
            const totalSeconds = Math.floor(milliseconds / 1000);
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            return minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
        }

        function getTimerClass(remainingMs) {
            const minutes = remainingMs / (1000 * 60);
            // Color based on time LEFT
            if (minutes <= 0) return 'timer-expired'; // expired
            if (minutes <= 5) return 'timer-critical'; // last 5 minutes (red)
            if (minutes <= 10) return 'timer-warning'; // last 10 minutes (yellow)
            return ''; // normal (green/white)
        }

        // Fungsi untuk menginisialisasi indikator navigasi
        function initializeNavIndicator() {
            const activeNav = document.querySelector('.nav-item.active');
            const indicator = document.getElementById('navIndicator');

            if (activeNav && indicator) {
                const rect = activeNav.getBoundingClientRect();
                const parentRect = activeNav.parentElement.getBoundingClientRect();

                indicator.style.width = rect.width + 'px';
                indicator.style.left = (rect.left - parentRect.left) + 'px';
            }
        }

        function loadUserData(category) {
            currentCategory = category;

            const userList = document.getElementById('userList');
            const seeAllBtn = document.getElementById('seeAllBtn');
            let data = userData[category] || [];

            data.sort((a, b) => a.username.localeCompare(b.username));

            if (category === 'admin' || category === 'kitchen') {
                seeAllBtn.classList.add('hidden');
                showingAllUsers = true;
            } else {
                seeAllBtn.classList.remove('hidden');
            }

            const usersToDisplay = (category === 'user' && !showingAllUsers) ? data.slice(0, 5) : data;

            userList.innerHTML = usersToDisplay.map(user => {
                let timerDisplay = '';
                let timerClass = '';
                let logoutButtonHtml = '';
                let isExpired = true;
                let newUserBadge = '';

                if (user.isNewUser) {
                    newUserBadge = '<span class="new-user-badge">NEW</span>';
                }

                if (category === 'user') {
                    if (user.login_expiry && (user.isActive || user.is_active)) {
                        const expiryMs = parseLoginExpiry(user.login_expiry);
                        const loginTimeMs = parseLoginExpiry(user.login_time);

                        if (expiryMs && loginTimeMs) {
                            const now = Date.now();

                            // Count UP from login time
                            const elapsedMs = now - loginTimeMs;

                            // Count DOWN to expiry (for expiration check)
                            const remainingMs = expiryMs - now;

                            if (remainingMs > 0) {
                                timerDisplay = formatTimer(elapsedMs); // Show elapsed time
                                timerClass = getTimerClass(elapsedMs);
                                isExpired = false;
                            } else {
                                isExpired = true;
                            }
                        }
                    }

                    const isNewUserWithoutTimer = user.isNewUser && !user.login_expiry;

                    const isActive = user.isActive || user.is_active;
                    const isDisabled = isExpired || !isActive || isNewUserWithoutTimer;

                    logoutButtonHtml = '<button class="logout-btn' + (isDisabled ? ' disabled' : '') + '" ' +
                        'onclick="showLogoutModal(\'' + user.id + '\')" ' +
                        (isDisabled ? 'disabled' : '') + '>' +
                        'Log Out' +
                        '</button>';
                }

                const isActiveForDisplay = user.isActive || user.is_active;
                const userInfoClass = category === 'user' && (!isActiveForDisplay || isExpired) ? 'timer-expired' :
                    '';
                const timerHtml = category === 'user' && timerDisplay && isActiveForDisplay && !isExpired ?
                    '<span class="timer-display ' + timerClass + '">' + timerDisplay + '</span>' :
                    '';

                return '<div class="user-card" data-user-id="' + user.id + '">' +
                    '<div class="user-info ' + userInfoClass + '">' +
                    user.username + newUserBadge +
                    timerHtml +
                    '</div>' +
                    '<div class="user-actions">' +
                    logoutButtonHtml +
                    '<button class="delete-btn" onclick="deleteUser(\'' + user.id + '\')">' +
                    '<svg class="delete-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">' +
                    '<polyline points="3,6 5,6 21,6"></polyline>' +
                    '<path d="m19,6v14c0,1-1,2-2,2H7c-1,0-2-1-2-2V6m3,0V4c0-1,1-2,2-2h4c0,1,1-2,2-2v2"></path>' +
                    '</svg>' +
                    '</button>' +
                    '</div>' +
                    '</div>';
            }).join('');

            if (category === 'user') {
                const totalUsers = data.length;
                const displayedUsers = usersToDisplay.length;

                if (!showingAllUsers && totalUsers > 5) {
                    seeAllBtn.textContent = 'Lihat Semua User (' + totalUsers + ')';
                } else if (showingAllUsers && totalUsers > 5) {
                    seeAllBtn.textContent = 'Lihat Beberapa User (5)';
                } else {
                    seeAllBtn.classList.add('hidden');
                }
            }

            startRealTimeTimers(); // will now reference the correct currentCategory
        }

        // TIMER REAL-TIME - FUNGSI BARU
        function startRealTimeTimers() {
            timers.forEach(timer => clearInterval(timer));
            timers.clear();

            const list = userData[currentCategory] || [];
            list.forEach(user => {
                const isActive = user.isActive || user.is_active;
                if (user.login_expiry && isActive) {
                    const expiryMs = parseLoginExpiry(user.login_expiry);
                    if (expiryMs && expiryMs > Date.now()) {
                        const timer = setInterval(() => updateUserTimer(user.id), 1000);
                        timers.set(user.id, timer);
                    }
                }
            });
        }

        const DEFAULT_SESSION_MS = 30 * 60 * 1000; // 30 minutes

        function updateUserTimer(userId) {
            const users = userData[currentCategory] || [];
            const user = users.find(u => u.id === userId);
            const isActive = user ? (user.isActive || user.is_active) : false;
            if (!user || !isActive || !user.login_expiry) return;

            // Parse expiry
            const expiryMs = parseLoginExpiry(user.login_expiry);
            if (!expiryMs) return;

            const loginTimeMs = parseLoginExpiry(user.login_time);
            if (!loginTimeMs) return;

            const now = Date.now();

            // Count UP from
            const elapsedMs = now - loginTimeMs;

            // Count DOWN to expiry (for expiration logic)
            const remainingMs = expiryMs - now;

            const userCard = document.querySelector('[data-user-id="' + userId + '"]');
            if (!userCard) return;

            const timerElement = userCard.querySelector('.timer-display');
            const userInfo = userCard.querySelector('.user-info');
            const logoutBtn = userCard.querySelector('.logout-btn');

            // If expired (remaining <= 0), stop and mark expired
            if (remainingMs <= 0) {
                user.isActive = false;

                const t = timers.get(userId);
                if (t) {
                    clearInterval(t);
                    timers.delete(userId);
                }

                if (timerElement) timerElement.textContent = 'Expired';
                userInfo && userInfo.classList.add('timer-expired');
                if (logoutBtn) {
                    logoutBtn.classList.add('disabled');
                    logoutBtn.disabled = true;
                }

                showAutoLogoutNotification(user.room_number);
                return;
            }

            // Otherwise update elapsed (counting up)
            if (timerElement) {
                timerElement.textContent = formatTimer(elapsedMs);
                // getTimerClass now receives ELAPSED time (adjust implementation if it assumed remaining)
                timerElement.className = 'timer-display ' + getTimerClass(remainingMs);
            }
        }

        // Fungsi untuk switch kategori dengan indikator
        function switchCategory(category, element) {
            // Remove active class from all nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Add active class to clicked item
            element.classList.add('active');

            // Move indicator
            const indicator = document.getElementById('navIndicator');
            const rect = element.getBoundingClientRect();
            const parentRect = element.parentElement.getBoundingClientRect();

            indicator.style.width = rect.width + 'px';
            indicator.style.left = (rect.left - parentRect.left) + 'px';

            currentCategory = category;
            // Reset showingAllUsers ketika pindah kategori
            showingAllUsers = false;
            loadUserData(category);
        }

        // Fungsi untuk toggle tampilan user (baru)
        function toggleUserView() {
            showingAllUsers = !showingAllUsers;
            loadUserData(currentCategory);
        }

        // FUNGSI RESET - DIPERBAIKI
        function showResetModal() {
            const modal = document.getElementById('resetModal');
            modal.classList.add('active');
        }

        function closeResetModal() {
            const modal = document.getElementById('resetModal');
            modal.classList.remove('active');
        }

        function confirmReset() {
            // Call API to reset all users (logout all)
            const resetUrl = "{{ route("admin.users.resetAll") }}";

            fetch(resetUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Clear all existing timers
                        timers.forEach(timer => clearInterval(timer));
                        timers.clear();

                        // Show reset animation
                        const userCards = document.querySelectorAll('.user-card');
                        userCards.forEach(card => {
                            card.classList.add('reset-animation');
                        });

                        // Reload page after animation to get updated data from server
                        setTimeout(() => {
                            location.reload();
                        }, 300);

                        showAlert(data.message, 'success');
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat reset!', 'error');
                });

            closeResetModal();
        }

        function showResetSuccessMessage() {
            showAlert('Semua user berhasil direset! Timer dimulai dari 00:00', 'success');
        }

        // FUNGSI TAMBAH WAKTU - BARU
        function showAddTimeModal() {
            const modal = document.getElementById('addTimeModal');
            modal.classList.add('active');
        }

        function closeAddTimeModal() {
            const modal = document.getElementById('addTimeModal');
            modal.classList.remove('active');
        }

        function confirmAddTime() {
            // Call API to add 10 minutes to all active users
            const addTimeUrl = "{{ route("admin.users.addTime") }}";

            fetch(addTimeUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show add time animation
                        const userCards = document.querySelectorAll('.user-card');
                        userCards.forEach(card => {
                            card.classList.add('add-time-animation');
                        });

                        // Reload data setelah animasi
                        setTimeout(() => {
                            location.reload(); // Reload page to get updated data from server

                            // Show success message
                            showAlert(data.message, 'success');
                        }, 300);
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat menambah waktu!', 'error');
                });

            closeAddTimeModal();
        }

        function showAddTimeSuccessMessage(affectedUsers) {
            // Create temporary success message
            const successMsg = document.createElement('div');
            successMsg.innerHTML = `
                <div style="
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #8e44ad, #9b59b6);
                    color: white;
                    padding: 15px 25px;
                    border-radius: 10px;
                    box-shadow: 0 4px 15px rgba(155, 89, 182, 0.3);
                    z-index: 2000;
                    font-family: 'Inter', Arial, sans-serif;
                    font-weight: 600;
                    animation: slideInFromRight 0.5s ease-out;
                ">
                    ⏰ Berhasil menambah 10 menit untuk ${affectedUsers} user aktif!
                </div>
            `;

            document.body.appendChild(successMsg);

            // Remove message after 3 seconds
            setTimeout(() => {
                successMsg.style.animation = 'slideOutToRight 0.5s ease-in forwards';
                setTimeout(() => {
                    if (successMsg.parentNode) {
                        successMsg.parentNode.removeChild(successMsg);
                    }
                }, 500);
            }, 3000);
        }

        // Fungsi untuk menampilkan notifikasi auto logout
        function showAutoLogoutNotification(roomName) {
            alert(roomName + ' telah otomatis logout karena sesi sudah lebih dari 30 menit.');
        }

        // Fungsi untuk menampilkan modal logout
        function showLogoutModal(userId) {
            const user = userData[currentCategory] ? userData[currentCategory].find(u => u.id == userId) : null;
            if (!user) return;

            const isActive = user.isActive || user.is_active;

            // Check if user has login_expiry and is active
            if (!user.login_expiry || !isActive) {
                return; // Tidak bisa logout jika tidak ada login_expiry atau inactive
            }

            // Parse and check if expired
            const expiryMs = parseLoginExpiry(user.login_expiry);
            if (!expiryMs) return;

            const remainingMs = expiryMs - Date.now();
            if (remainingMs <= 0) {
                return; // Already expired
            }

            pendingLogoutUser = userId;
            const modal = document.getElementById('logoutModal');
            const message = document.getElementById('logoutMessage');

            message.textContent = 'Apakah Anda yakin ingin log out ' + user.username + '?';
            modal.classList.add('active');
        }

        // Fungsi untuk menutup modal logout
        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('active');
            pendingLogoutUser = null;
        }

        // Fungsi untuk konfirmasi logout
        function confirmLogout() {
            if (pendingLogoutUser && userData[currentCategory]) {
                const user = userData[currentCategory].find(u => u.id == pendingLogoutUser);
                if (user) {
                    // Call API to logout user
                    const logoutUrl = "{{ route("admin.users.logout", ":id") }}".replace(':id', pendingLogoutUser);

                    fetch(logoutUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                user.isActive = false;
                                user.login_expiry = null;

                                // Clear timer
                                const timer = timers.get(pendingLogoutUser);
                                if (timer) {
                                    clearInterval(timer);
                                    timers.delete(pendingLogoutUser);
                                }

                                // Reload data to update UI
                                loadUserData(currentCategory);

                                showAlert(data.message, 'success');
                            } else {
                                showAlert(data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showAlert('Terjadi kesalahan saat logout!', 'error');
                        });
                }
            }
            closeLogoutModal();
        }

        // Fungsi untuk menghapus pengguna
        function deleteUser(userId) {
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                const deleteUserUrl = "{{ route("admin.users.destroy", ":id") }}".replace(':id', userId);

                fetch(deleteUserUrl, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Gagal menghapus pengguna.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus pengguna.');
                    });
            }
        }

        function showUserMenu() {
            alert('Menu User: Profile & Pengaturan');
        }

        function handleLogout() {
            window.location.href = '../logout.php';
        }

        function showAddUserModal() {
            alert('Fitur tambah pengguna akan dikembangkan selanjutnya');
        }

        // Initialize page
        window.addEventListener('load', function() {
            // Initialize userData
            userData = initializeUserData();

            // Set active button untuk pengguna
            const penggunaBtn = document.querySelector('.pengguna-button');
            if (penggunaBtn) penggunaBtn.classList.add('active');

            // Initialize navigation indicator
            setTimeout(initializeNavIndicator, 100);

            // Load initial data
            loadUserData(currentCategory);

            // Add entrance animation
            const mainContent = document.querySelector('.main-content');
            if (mainContent) {
                mainContent.style.opacity = '0';
                mainContent.style.transform = 'translateY(20px)';
                mainContent.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    mainContent.style.opacity = '1';
                    mainContent.style.transform = 'translateY(0)';
                }, 200);
            }
        });

        // Cleanup timers when page unloads
        window.addEventListener('beforeunload', function() {
            timers.forEach(timer => clearInterval(timer));
            timers.clear();
        });

        // Handle visibility change to pause/resume timers
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                // Pause timers when tab is hidden
                timers.forEach(timer => clearInterval(timer));
            } else {
                // Resume timers when tab is visible
                startRealTimeTimers();
            }
        });

        // Handle window resize for indicator
        window.addEventListener('resize', function() {
            initializeNavIndicator();
        });
    </script>
@endpush
