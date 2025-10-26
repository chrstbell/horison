<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield("title", "HORISON F&B")</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        @stack("styles")
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', Arial, sans-serif;
                background-color: #ffffff;
                overflow-x: hidden;
            }

            .dashboard-container {
                width: 100vw;
                height: 100vh;
                background-color: #ffffff;
                position: relative;
                display: flex;
            }

            /* Sidebar */
            .sidebar {
                width: 350px;
                height: 100vh;
                background-color: #2c3e50;
                position: relative;
                border-radius: 0 18px 18px 0;
                z-index: 1;
                overflow-y: auto;
            }

            .logo-section {
                position: absolute;
                left: 3px;
                top: 10px;
                width: 160px;
                height: 110px;
                z-index: 3;
            }

            .logo-image {
                width: 100%;
                height: 100%;
                object-fit: contain;
                cursor: pointer;
            }

            .user-profile {
                position: absolute;
                right: 25px;
                top: 35px;
                width: 40px;
                height: 40px;
                background-color: #ffffff;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.2s;
                z-index: 3;
            }

            .user-profile:hover {
                transform: scale(1.05);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            }

            /* Pesanan Section - Fixed positioning */
            .pesanan-section {
                position: absolute;
                left: 20px;
                top: 140px;
                width: 310px;
                z-index: 3;
            }

            .pesanan-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
                padding-left: 0;
            }

            .pesanan-title {
                font-size: 20px;
                font-weight: bold;
                color: #ffffff;
            }

            .notification-badge {
                width: 30px;
                height: 30px;
            }

            .badge-circle {
                width: 100%;
                height: 100%;
                background-color: #ef4444;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ffffff;
                font-size: 14px;
                font-weight: bold;
            }

            .pesanan-container {
                width: 310px;
                height: 200px;
                /* Reduced height to make room for history */
                background-color: #ededed;
                border-radius: 8px;
                padding: 15px;
                display: flex;
                flex-direction: column;
                gap: 12px;
                z-index: 3;
                position: relative;
                overflow-y: auto;
            }

            .pesanan-item {
                width: 280px;
                height: 40px;
                min-height: 40px;
                flex-shrink: 0;
                background-color: #a58857;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 16px;
                position: relative;
            }

            .pesanan-item:hover {
                background-color: #96794d;
                transform: translateX(3px);
            }

            .pesanan-item.completed {
                background-color: #28a745;
            }

            .room-name {
                color: #ededed;
                font-size: 16px;
                font-weight: bold;
                font-family: 'Inter', Arial, sans-serif;
            }

            .order-time {
                color: #ffffff;
                font-size: 12px;
                font-weight: 400;
                font-family: 'Inter', Arial, sans-serif;
                opacity: 0.9;
            }

            .status-indicator {
                position: absolute;
                right: 8px;
                top: 50%;
                transform: translateY(-50%);
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background-color: #ffc107;
            }

            /* History Section - Fixed positioning with proper spacing */
            .history-section {
                position: absolute;
                left: 20px;
                top: 415px;
                /* Adjusted to not overlap with pesanan section */
                width: 310px;
                z-index: 3;
            }

            .history-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
                /* Consistent spacing like pesanan header */
                padding-left: 0;
            }

            .history-title {
                font-size: 20px;
                font-weight: bold;
                color: #ffffff;
            }

            .history-container {
                width: 310px;
                height: 200px;
                /* Adjusted height to fit better */
                background-color: #ededed;
                border-radius: 8px;
                padding: 15px;
                display: flex;
                flex-direction: column;
                gap: 12px;
                z-index: 3;
                position: relative;
                overflow-y: auto;
            }

            .history-item {
                width: 280px;
                height: 40px;
                min-height: 40px;
                flex-shrink: 0;
                background-color: #28a745;
                /* Green for completed */
                border: none;
                border-radius: 6px;
                cursor: pointer;
                /* Make clickable */
                transition: all 0.2s;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 16px;
                position: relative;
            }

            .history-item:hover {
                background-color: #218838;
                transform: translateX(3px);
            }

            .history-item .room-name,
            .history-item .order-time {
                color: #ffffff;
            }

            .delete-history-btn {
                background: none;
                border: none;
                color: #e74c3c;
                cursor: pointer;
                font-size: 18px;
                padding: 0 5px;
                transition: color 0.2s;
            }

            .delete-history-btn:hover {
                color: #c0392b;
            }

            /* Logout Section - Fixed positioning */
            .logout-section {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 350px;
                height: 55px;
                background-color: #ededed;
                border-radius: 0 8px 0 0;
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
                padding: 60px 40px;
                background-color: #f8f9fa;
            }

            .welcome-section h1 {
                font-size: 32px;
                font-weight: bold;
                color: #000000;
                margin-bottom: 12px;
                line-height: 1.2;
            }

            .welcome-section p {
                font-size: 18px;
                font-weight: 500;
                color: #000000;
                line-height: 1.4;
            }

            .reset-section {
                margin-top: 40px;
                text-align: center;
            }

            .btn-warning {
                background-color: #f39c12;
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s;
            }

            .btn-warning:hover {
                background-color: #e67e22;
            }

            /* Animasi */
            .fade-in {
                animation: fadeIn 0.5s ease-in;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>

    <body>
        <div class="dashboard-container">
            @include("components.dapur_sidebar", [
                "activeOrderCount" => $activeOrderCount ?? 0,
                "activeOrdersData" => $activeOrdersData ?? [],
                "completedOrdersData" => $completedOrdersData ?? [],
            ])
            <!-- Main Content -->
            <div class="main-content fade-in">
                <div class="main-content">
                    @yield("content")
                </div>
            </div>
        </div>
        @stack("scripts")
    </body>

</html>
