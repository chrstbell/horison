@extends("layouts.dapur")

@section("title", "Detail Pesanan")

@push("styles")
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
            margin-bottom: 25px;
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
            background-color: #ededed;
            border-radius: 8px;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 3;
            position: relative;
            overflow-y: auto;
        }

        .pesanan-item {
            width: 280px;
            height: 40px;
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

        .pesanan-item.active {
            background-color: #3498db;
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

        /* History Section - Same positioning as dashboard */
        .history-section {
            position: absolute;
            left: 20px;
            top: 415px;
            width: 310px;
            z-index: 3;
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
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
            background-color: #28a745;
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

        .history-item:hover {
            background-color: #218838;
            transform: translateX(3px);
        }

        .history-item.active {
            background-color: #1e7e34;
            transform: translateX(3px);
        }

        .history-item .room-name,
        .history-item .order-time {
            color: #ffffff;
        }

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
            padding: 40px;
            background-color: #f8f9fa;
            overflow-y: auto;
        }

        .back-button {
            background: none;
            border: none;
            color: #2c3e50;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .back-button:hover {
            color: #3498db;
        }

        .detail-header {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .room-title {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .order-info {
            color: #7f8c8d;
            font-size: 16px;
        }

        /* History mode indicator */
        .history-mode-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: none;
        }

        .history-mode-badge.show {
            display: block;
        }

        .order-details {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .menu-list {
            list-style: none;
            margin-bottom: 30px;
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #ecf0f1;
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .menu-name {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 500;
        }

        .menu-quantity {
            color: #7f8c8d;
            font-size: 14px;
            margin-left: 10px;
        }

        .menu-price {
            font-size: 16px;
            font-weight: 600;
            color: #27ae60;
        }

        .menu-notes {
            display: block;
            color: #95a5a6;
            margin-top: 8px;
            font-style: italic;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .custom-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #bdc3c7;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            background-color: #ffffff;
        }

        .custom-checkbox.checked {
            background-color: #27ae60;
            border-color: #27ae60;
        }

        .custom-checkbox.disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .custom-checkbox .checkmark {
            color: #ffffff;
            font-size: 14px;
            display: none;
        }

        .custom-checkbox.checked .checkmark {
            display: block;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', Arial, sans-serif;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-primary {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: #c0392b;
        }

        .btn-primary.completed {
            background-color: #27ae60;
        }

        .btn-primary.completed:hover:not(:disabled) {
            background-color: #229954;
        }

        .btn-print {
            background-color: #3498db;
            color: white;
        }

        .btn-print:hover:not(:disabled) {
            background-color: #2980b9;
        }

        .total-section {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total-row.final {
            border-top: 2px solid #bdc3c7;
            padding-top: 10px;
            margin-top: 10px;
            font-weight: bold;
            font-size: 18px;
        }

        .notes-section {
            margin-top: 20px;
            padding: 20px;
            background-color: #f0f4f7;
            border-radius: 8px;
        }

        .notes-section p {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .notes-section .note-content {
            background-color: #ffffff;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            padding: 15px;
            min-height: 80px;
            font-size: 15px;
            color: #555;
            line-height: 1.5;
            white-space: pre-wrap;
        }

        /* Modal Konfirmasi */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transform: scale(0.8) translateY(-20px);
            transition: all 0.3s ease;
            text-align: center;
        }

        .modal-overlay.show .modal-container {
            transform: scale(1) translateY(0);
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #ffffff;
            animation: iconPulse 1.5s ease-in-out infinite;
        }

        @keyframes iconPulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(46, 204, 113, 0);
            }
        }

        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .modal-message {
            font-size: 16px;
            color: #7f8c8d;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .modal-room-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #27ae60;
        }

        .modal-room-name {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .modal-room-time {
            font-size: 14px;
            color: #7f8c8d;
        }

        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .modal-btn {
            padding: 14px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', Arial, sans-serif;
            min-width: 120px;
            position: relative;
            overflow: hidden;
        }

        .modal-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .modal-btn:hover::before {
            left: 100%;
        }

        .modal-btn-cancel {
            background-color: #95a5a6;
            color: #ffffff;
        }

        .modal-btn-cancel:hover {
            background-color: #7f8c8d;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(149, 165, 166, 0.4);
        }

        .modal-btn-confirm {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: #ffffff;
        }

        .modal-btn-confirm:hover {
            background: linear-gradient(135deg, #229954, #27ae60);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.4);
        }

        .modal-btn-confirm:active {
            transform: translateY(0);
        }

        /* Loading Animation */
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
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

        /* Animasi */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        .slide-in {
            animation: slideIn 0.3s ease-out;
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

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse {
            animation: pulse 0.3s ease-in-out;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
                padding: 20px;
            }

            .detail-header,
            .order-details {
                padding: 20px;
            }

            .room-title {
                font-size: 24px;
            }
        }

        @media (max-width: 768px) {
            .modal-container {
                padding: 30px 20px;
            }

            .modal-buttons {
                flex-direction: column;
            }

            .modal-btn {
                width: 100%;
            }
        }

        /* Styles for Print Receipt */
        @media print {
            body * {
                visibility: hidden;
            }

            #receipt-print-area,
            #receipt-print-area * {
                visibility: visible;
            }

            #receipt-print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 80mm;
                font-family: 'monospace', 'Courier New', Courier, monospace;
                font-size: 12px;
                padding: 10px;
                box-sizing: border-box;
                color: #000;
            }
        }
    </style>
@endpush

@section("content")
    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main Content -->
    <div class="main-content fade-in">
        <button class="back-button" onclick="goToDashboard()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5" />
                <path d="M12 19l-7-7 7-7" />
            </svg>
            Kembali ke Dashboard
        </button>

        <div class="detail-header slide-in">
            <h1 class="room-title" id="roomTitle"></h1>
            <p class="order-info" id="orderInfo"></p>
            <div class="history-mode-badge" id="historyModeBadge"></div>
        </div>

        <div class="order-details slide-in">
            <h2 class="section-title">Menu yang Dipesan</h2>
            <ul class="menu-list" id="menuList">
                <!-- Menu items will be loaded here by JavaScript -->
            </ul>

            <div class="total-section">
                <!-- Total section will be loaded here by JavaScript -->
            </div>

            <div class="notes-section">
                <p>Catatan Pelanggan:</p>
                <div class="note-content" id="customerNotes">
                    Tidak ada catatan.
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn btn-print" onclick="printReceipt()">
                    Cetak Struk
                </button>
                <button class="btn btn-primary" id="completeBtn" onclick="showConfirmationModal()">
                    Selesai
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal-overlay" id="confirmationModal">
        <div class="modal-container">
            <div class="modal-icon">
                🍽️
            </div>
            <h3 class="modal-title">Pesanan Siap Disajikan?</h3>
            <p class="modal-message">
                Apakah Anda yakin pesanan ini sudah siap untuk disajikan ke pelanggan?
            </p>
            <div class="modal-room-info">
                <div class="modal-room-name" id="modalRoomName"></div>
                <div class="modal-room-time" id="modalRoomTime"></div>
            </div>
            <div class="modal-buttons">
                <button class="modal-btn modal-btn-cancel" onclick="closeConfirmationModal()">
                    Cancel
                </button>
                <button class="modal-btn modal-btn-confirm" onclick="completeOrder()">
                    <span class="loading-spinner" id="loadingSpinner"></span>
                    <span id="confirmBtnText">Selesai</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        // Data pesanan dari database
        let currentOrder = @json($orderData);
        let activeOrders = @json($activeOrdersData);
        let completedOrders = @json($completedOrdersData);
        let allOrders = {};
        let isHistoryMode = false;
        let currentRoom = currentOrder.room;

        // Initialize orders data for sidebar compatibility
        function initializeOrders() {
            // Add active orders
            activeOrders.forEach(order => {
                allOrders[order.id] = {
                    id: order.id,
                    room: order.room,
                    datetime: order.datetime,
                    completed: false,
                    status: order.status
                };
            });

            // Add completed orders
            completedOrders.forEach(order => {
                const key = `${order.room}_completed_${order.id}`;
                allOrders[key] = {
                    id: order.id,
                    room: order.room,
                    datetime: order.datetime,
                    completed: true,
                    status: order.status
                };
            });
        }

        // Fungsi untuk memuat detail pesanan dari database
        function loadCurrentOrderDetail() {
            isHistoryMode = (currentOrder.status === 'completed');

            // Show/hide history mode badge
            const historyBadge = document.getElementById('historyModeBadge');
            if (isHistoryMode) {
                historyBadge.classList.add('show');
            } else {
                historyBadge.classList.remove('show');
            }

            // Update title dan info
            const titlePrefix = isHistoryMode ? 'History Pesanan' : 'Detail Pesanan';
            document.getElementById('roomTitle').textContent = `${titlePrefix} - Kamar ${currentOrder.room}`;
            const statusText = isHistoryMode ? 'Selesai pada' : 'Dipesan pada';
            const timeToShow = isHistoryMode && currentOrder.completed_time ? currentOrder.completed_time : currentOrder
                .datetime;
            document.getElementById('orderInfo').textContent = `${statusText} ${timeToShow} WIB`;

            // Update menu list
            const menuList = document.getElementById('menuList');
            menuList.innerHTML = '';

            currentOrder.items.forEach((item, index) => {
                const total = item.price * item.quantity;

                const li = document.createElement('li');
                li.className = 'menu-item';

                if (isHistoryMode) {
                    // History mode - no checkboxes, all items marked as completed
                    li.innerHTML = `
                        <div>
                            <span class="menu-name">${item.name}</span>
                            <span class="menu-quantity">x${item.quantity}</span>
                            ${item.notes ? `<span class="menu-notes">${item.notes}</span>` : ''}
                        </div>
                        <div class="checkbox-container">
                            <span class="menu-price">Rp ${total.toLocaleString('id-ID')}</span>
                            <div class="custom-checkbox checked disabled">
                                <span class="checkmark">✓</span>
                            </div>
                        </div>
                    `;
                } else {
                    // Normal mode - interactive checkboxes
                    li.innerHTML = `
                        <div>
                            <span class="menu-name">${item.name}</span>
                            <span class="menu-quantity">x${item.quantity}</span>
                            ${item.notes ? `<span class="menu-notes">${item.notes}</span>` : ''}
                        </div>
                        <div class="checkbox-container">
                            <span class="menu-price">Rp ${total.toLocaleString('id-ID')}</span>
                            <div class="custom-checkbox ${item.checked ? 'checked' : ''}" onclick="toggleMenuItem(this, ${index})">
                                <span class="checkmark">✓</span>
                            </div>
                        </div>
                    `;
                }
                menuList.appendChild(li);
            });

            // Update total using database values
            const totalSection = document.querySelector('.total-section');
            totalSection.innerHTML = `
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>Rp ${parseFloat(currentOrder.subtotal).toLocaleString('id-ID')}</span>
                </div>
                <div class="total-row final">
                    <span>Total:</span>
                    <span>Rp ${parseFloat(currentOrder.total).toLocaleString('id-ID')}</span>
                </div>
            `;

            // Update catatan pelanggan
            const customerNotes = document.getElementById('customerNotes');
            customerNotes.textContent = currentOrder.notes || 'Tidak ada catatan.';

            // Show/hide action buttons based on mode
            const completeBtn = document.getElementById('completeBtn');
            if (isHistoryMode) {
                completeBtn.style.display = 'none';
            } else {
                completeBtn.style.display = 'inline-block';
                updateCompleteButtonStatus();
            }
        }

        // Function to save checkbox states (simplified for database version)
        function saveCurrentOrderCheckboxes() {
            // In database version, checkbox states are handled by toggleMenuItem function
            // This function is kept for compatibility but no longer saves to localStorage
        }

        // Fungsi untuk toggle menu item
        function toggleMenuItem(checkbox, index) {
            if (isHistoryMode || checkbox.classList.contains('disabled')) return;

            checkbox.classList.toggle('checked');
            checkbox.classList.add('pulse');

            // Update current order item checked status
            if (currentOrder.items[index]) {
                currentOrder.items[index].checked = checkbox.classList.contains('checked');
            }

            setTimeout(() => {
                checkbox.classList.remove('pulse');
            }, 300);

            updateCompleteButtonStatus();
        }

        // Fungsi untuk update tombol selesai
        function updateCompleteButtonStatus() {
            if (isHistoryMode) return;

            const allCheckboxes = document.querySelectorAll('.custom-checkbox:not(.disabled)');
            const checkedCount = document.querySelectorAll('.custom-checkbox.checked:not(.disabled)').length;
            const completeBtn = document.getElementById('completeBtn');

            if (checkedCount === allCheckboxes.length && allCheckboxes.length > 0) {
                completeBtn.classList.add('completed');
            } else {
                completeBtn.classList.remove('completed');
            }
        }

        // Fungsi untuk menampilkan modal konfirmasi
        function showConfirmationModal() {
            if (isHistoryMode) return;

            const allCheckboxes = document.querySelectorAll('.custom-checkbox:not(.disabled)');
            const checkedCount = document.querySelectorAll('.custom-checkbox.checked:not(.disabled)').length;

            if (checkedCount < allCheckboxes.length) {
                showMessage('Harap centang semua menu yang sudah selesai!', 'warning');
                return;
            }

            // Update informasi di modal
            document.getElementById('modalRoomName').textContent = `Kamar ${currentOrder.room}`;
            document.getElementById('modalRoomTime').textContent = `Dipesan pada ${currentOrder.datetime} WIB`;

            // Reset tombol konfirmasi
            const confirmBtn = document.querySelector('.modal-btn-confirm');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const confirmBtnText = document.getElementById('confirmBtnText');

            confirmBtn.disabled = false;
            loadingSpinner.style.display = 'none';
            confirmBtnText.textContent = 'Selesai';

            // Tampilkan modal
            const modal = document.getElementById('confirmationModal');
            modal.classList.add('show');
        }

        // Fungsi untuk menutup modal konfirmasi
        function closeConfirmationModal() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.remove('show');
        }

        // Fungsi untuk menyelesaikan pesanan
        function completeOrder() {
            if (isHistoryMode) return;

            const confirmBtn = document.querySelector('.modal-btn-confirm');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const confirmBtnText = document.getElementById('confirmBtnText');

            // Tampilkan loading
            confirmBtn.disabled = true;
            loadingSpinner.style.display = 'inline-block';
            confirmBtnText.textContent = 'Memproses...';

            // Make API call to update order status
            fetch(`{{ route("dapur.orders.update_status", ["id" => ":id"]) }}`.replace(':id', currentOrder.id), {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                            '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: 'completed'
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Tutup modal
                        closeConfirmationModal();

                        // Update current order status
                        currentOrder.status = 'completed';

                        // Tampilkan pesan sukses
                        showMessage(`Pesanan Kamar ${currentOrder.room} telah selesai dan siap disajikan!`, 'success');

                        // Redirect ke dashboard setelah delay
                        setTimeout(() => {
                            goToDashboard();
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Failed to complete order');
                    }
                })
                .catch(error => {
                    console.error('Error completing order:', error);

                    // Reset button state
                    confirmBtn.disabled = false;
                    loadingSpinner.style.display = 'none';
                    confirmBtnText.textContent = 'Selesai';

                    // Show error message
                    alert('Terjadi kesalahan saat menyelesaikan pesanan. Silakan coba lagi.');
                });
        }

        // Fungsi untuk tampilkan pesan
        function showMessage(text, type = 'info') {
            const colors = {
                success: '#27ae60',
                warning: '#f39c12',
                error: '#e74c3c',
                info: '#3498db'
            };

            const message = document.createElement('div');
            message.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: ${colors[type]};
                color: white;
                padding: 20px 30px;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                z-index: 10000;
                box-shadow: 0 4px 15px rgba(0,0,0,0.3);
                animation: messageSlide 3s ease-in-out;
            `;
            message.textContent = text;
            document.body.appendChild(message);

            setTimeout(() => {
                document.body.removeChild(message);
            }, 3000);
        }

        // Fungsi untuk render pesanan di sidebar
        function renderSidebarOrders() {
            const pesananContainer = document.getElementById('pesananContainer');
            pesananContainer.innerHTML = '';

            let activeCount = 0;
            for (const key in allOrders) {
                if (allOrders[key].completed) continue;

                activeCount++;
                const order = allOrders[key];
                const div = document.createElement('div');
                div.className = `pesanan-item ${order.id === currentOrder.id && !isHistoryMode ? 'active' : ''}`;
                div.setAttribute('onclick', `goToOrderDetailById(${order.id})`);
                div.setAttribute('data-room', order.room);
                div.setAttribute('data-id', order.id);
                div.innerHTML = `
                    <div class="room-name">Kamar ${order.room}</div>
                    <div class="order-time"> ${order.datetime}</div>
                `;
                pesananContainer.appendChild(div);
            }

            document.getElementById('orderCount').textContent = activeCount;
        }

        // Fungsi untuk render history di sidebar
        function renderSidebarHistory() {
            const historyContainer = document.getElementById('historyContainer');
            historyContainer.innerHTML = '';

            let hasHistory = false;
            for (const key in allOrders) {
                if (!allOrders[key].completed) continue;

                hasHistory = true;
                const order = allOrders[key];
                const div = document.createElement('div');
                div.className = `history-item ${order.id === currentOrder.id && isHistoryMode ? 'active' : ''}`;
                div.setAttribute('onclick', `goToOrderDetailById(${order.id})`);
                div.setAttribute('data-room', order.room);
                div.setAttribute('data-id', order.id);
                div.innerHTML = `
                    <div class="room-name">Kamar ${order.room}</div>
                    <div class="order-time"> ${order.datetime}</div>
                    `;
                // <button class="delete-history-btn" onclick="deleteHistoryOrder(event, ${order.id}, '${order.room}')">
                //     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                // </button>
                historyContainer.appendChild(div);
            }

            if (!hasHistory) {
                historyContainer.innerHTML = `
                    <div style="text-align: center; color: #7f8c8d; font-size: 14px; padding-top: 20px;">
                        Belum ada pesanan yang selesai.
                    </div>
                `;
            }
        }

        // Fungsi untuk mencetak struk
        function printReceipt() {
            if (!currentOrder || !currentOrder.id) {
                showMessage('Data pesanan tidak ditemukan untuk dicetak.', 'error');
                return;
            }

            // Open receipt page in new tab using the order ID
            const receiptUrl = "{{ route("receipt", ":orderId") }}".replace(':orderId', currentOrder.id);
            console.log('Opening receipt URL:', receiptUrl);
            window.open(receiptUrl, '_blank');
        }

        // Fungsi navigasi
        function goToDashboard() {
            window.location.href = '{{ route("dapur.dashboard") }}';
        }

        function goToOrderDetail(room) {
            // Find the order by room number
            const order = Object.values(allOrders).find(o => o.room === room && !o.completed);
            if (order && order.id) {
                window.location.href = `{{ route("dapur.orders.detail", ["id" => ":id"]) }}`.replace(':id', order.id);
            } else {
                alert('Order not found');
            }
        }

        function goToHistoryDetail(room) {
            // Find the completed order by room number
            const order = Object.values(allOrders).find(o => o.room === room && o.completed);
            if (order && order.id) {
                window.location.href = `{{ route("dapur.orders.detail", ["id" => ":id"]) }}`.replace(':id', order.id) +
                    '?mode=history';
            } else {
                alert('Order not found');
            }
        }

        // Function to go to order detail by ID (used by sidebar clicks)
        function goToOrderDetailById(orderId) {
            window.location.href = `{{ route("dapur.orders.detail", ["id" => ":id"]) }}`.replace(':id', orderId);
        }

        function showUserMenu() {
            alert('Menu user:\n- Profile\n- Pengaturan\n- Bantuan');
        }

        function handleLogout() {
            window.location.href = '{{ route("logout_page") }}';
        }

        // Load data saat halaman dimuat
        window.addEventListener('load', function() {
            initializeOrders();
            loadCurrentOrderDetail();
            renderSidebarOrders();
            renderSidebarHistory();

            // Tambahkan animasi CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes messageSlide {
                    0% { opacity: 0; transform: translate(-50%, -60%); }
                    10% { opacity: 1; transform: translate(-50%, -50%); }
                    90% { opacity: 1; transform: translate(-50%, -50%); }
                    100% { opacity: 0; transform: translate(-50%, -40%); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endpush
