@extends("layouts.dapur")

@section("title", "Dashboard")

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
@endpush

@section("content")
    <div class="welcome-section">
        <h1>Halo Tim F&B!</h1>
        <p>Mari ciptakan kelezatan terbaik hari ini!</p>
    </div>

    {{-- <div class="reset-section">
        <button class="btn btn-warning" onclick="resetAllOrders()">
            Reset Semua Pesanan (Admin Only)
        </button>
    </div> --}}
@endsection

@push("scripts")
    <script>
        // Data pesanan dari database
        let activeOrders = @json($activeOrdersData);
        let completedOrders = @json($completedOrdersData);

        // Convert to format expected by existing functions
        let allOrders = {};

        // Initialize orders from database data
        function initializeOrders() {
            // Convert active orders to the format expected by existing functions
            activeOrders.forEach(order => {
                allOrders[order.id] = {
                    id: order.id,
                    room: order.room,
                    datetime: order.datetime,
                    completed: false,
                    status: order.status,
                    items: order.items,
                    notes: order.notes || '',
                    total: order.total
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
                    status: order.status,
                    items: order.items,
                    notes: order.notes || '',
                    total: order.total
                };
            });
        }

        // Fungsi untuk merender daftar pesanan masuk
        function renderOrders() {
            const pesananContainer = document.getElementById('pesananContainer');
            pesananContainer.innerHTML = '';

            let activeOrderCount = 0;
            for (const key in allOrders) {
                if (allOrders.hasOwnProperty(key) && !allOrders[key].completed) {
                    activeOrderCount++;
                    const order = allOrders[key];
                    const div = document.createElement('div');
                    div.className = 'pesanan-item';
                    div.setAttribute('onclick', `goToOrderDetailById(${order.id})`);
                    div.setAttribute('data-room', order.room);
                    div.setAttribute('data-id', order.id);
                    div.innerHTML = `
                        <div class="room-name">Kamar ${order.room}</div>
                        <div class="order-time"> ${order.datetime}</div>
                        <div class="status-indicator"></div>
                    `;
                    pesananContainer.appendChild(div);
                }
            }
            updateOrderCount(activeOrderCount);
            renderHistory();
        }

        // Fungsi untuk merender daftar history pesanan
        function renderHistory() {
            const historyContainer = document.getElementById('historyContainer');
            historyContainer.innerHTML = '';

            let hasHistory = false;
            for (const key in allOrders) {
                if (allOrders.hasOwnProperty(key) && allOrders[key].completed) {
                    hasHistory = true;
                    const order = allOrders[key];
                    const div = document.createElement('div');
                    div.className = 'history-item';
                    // Make history items clickable to view details (read-only mode)
                    div.setAttribute('onclick', `goToOrderDetailById(${order.id})`);
                    div.innerHTML = `
                    <div class="room-name">Kamar ${order.room}</div>
                    <div class="order-time">${order.datetime}</div>
                    `;
                    // <button class="delete-history-btn" onclick="deleteHistoryOrder(event, ${order.id}, '${order.room}')">
                    //     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    // </button>
                    historyContainer.appendChild(div);
                }
            }

            // Tampilkan pesan jika tidak ada history
            if (!hasHistory) {
                historyContainer.innerHTML = `
                    <div style="text-align: center; color: #7f8c8d; font-size: 14px; padding-top: 20px;">
                        Belum ada pesanan yang selesai.
                    </div>
                `;
            }
        }

        // Fungsi untuk menghapus pesanan dari history
        function deleteHistoryOrder(event, orderId, room) {
            event.stopPropagation();
            if (confirm(`Apakah Anda yakin ingin menghapus history pesanan Kamar ${room}?`)) {
                // Make API call to delete order
                fetch(`{{ route("dapur.orders.destroy", ":id") }}`.replace(':id', orderId), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Remove from local data
                            const keyToDelete = Object.keys(allOrders).find(key =>
                                allOrders[key].id === orderId && allOrders[key].completed
                            );
                            if (keyToDelete) {
                                delete allOrders[keyToDelete];
                            }

                            // Update UI
                            renderHistory();
                            alert(`History pesanan Kamar ${room} telah dihapus.`);

                            // Reload page to refresh data
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            alert('Gagal menghapus pesanan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus pesanan.');
                    });
            }
        }

        // Fungsi untuk memperbarui jumlah pesanan
        function updateOrderCount(count) {
            const badge = document.getElementById('orderCount');
            badge.textContent = count;

            if (count === 0) {
                badge.style.backgroundColor = '#28a745';
                setTimeout(() => {
                    showAllCompleteMessage();
                }, 500);
            } else {
                badge.style.backgroundColor = '#ef4444';
            }
        }

        // Fungsi reset semua pesanan
        function resetAllOrders() {
            if (confirm(
                    "⚠️ Reset semua pesanan ke status awal? Tindakan ini tidak dapat dibatalkan! Ini juga akan menghapus semua history pesanan."
                )) {
                allOrders = getDefaultOrders();
                saveOrdersToLocalStorage();
                renderOrders();
                alert("✅ Semua pesanan telah direset!");

                const pesananContainer = document.getElementById('pesananContainer');
                if (pesananContainer) {
                    pesananContainer.scrollTop = 0;
                }
            }
        }

        // Fungsi untuk menampilkan pesan ketika semua pesanan selesai
        function showAllCompleteMessage() {
            const message = document.createElement('div');
            message.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: linear-gradient(45deg, #28a745, #20c997);
                color: white;
                padding: 30px 40px;
                border-radius: 12px;
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                z-index: 1000;
                box-shadow: 0 8px 25px rgba(0,0,0,0.3);
                animation: celebrationPulse 3s ease-in-out;
            `;
            message.innerHTML = `
                 Selamat! <br>
                Semua pesanan telah selesai!<br>
                <small style="font-size: 16px; opacity: 0.9;">Tim F&B hebat!</small>
            `;
            document.body.appendChild(message);

            setTimeout(() => {
                document.body.removeChild(message);
            }, 3000);
        }

        // Fungsi navigasi
        function goToHome() {
            window.location.href = '{{ route("dapur.dashboard") }}';
        }


        // Function to go to order detail by ID (used by sidebar clicks)
        function goToOrderDetailById(orderId) {
            window.location.href = `{{ route("dapur.orders.detail", ["id" => ":id"]) }}`.replace(':id', orderId);
        }

        // Fungsi lainnya
        function showUserMenu() {
            alert('Menu user:\n- Profile\n- Pengaturan\n- Bantuan');
        }

        function handleLogout() {
            window.location.href = '{{ route("logout_page") }}';
        }

        // Inisialisasi saat halaman dimuat
        window.addEventListener('load', function() {
            initializeOrders();
            renderOrders();

            // Tambahkan animasi CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes celebrationPulse {
                    0% { opacity: 0; transform: translate(-50%, -50%) scale(0.8); }
                    10% { opacity: 1; transform: translate(-50%, -50%) scale(1.1); }
                    20% { transform: translate(-50%, -50%) scale(1); }
                    80% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
                    100% { opacity: 0; transform: translate(-50%, -50%) scale(0.9); }
                }
            `;
            document.head.appendChild(style);

            console.log('Dashboard F&B loaded successfully!');
        });
    </script>
@endpush
