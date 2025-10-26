@extends("layouts.home")

@section("title", "Order Status")

@push("styles")
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            background: #fff;
            overflow-x: hidden;
            width: 100%;
        }

        .container {
            width: 100vw;
            min-height: 100vh;
            position: relative;
            background: white;
            border-radius: 25px;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            padding: 20px;
            background: white;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #f0f0f0;
        }

        .back-btn {
            width: 24px;
            height: 24px;
            background: none;
            border: none;
            cursor: pointer;
            margin-right: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .back-btn svg {
            width: 20px;
            height: 20px;
            stroke: #333;
        }

        .header-title {
            font-weight: 700;
            font-size: 23px;
            color: #333;
        }

        /* Status Tabs */
        .status-tabs {
            width: 100%;
            padding: 20px;
            margin-bottom: 20px;
        }

        .tabs-container {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
            background: transparent;
            /* no gray bar needed for single tab */
            height: auto;
        }

        .tab {
            text-align: center;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: -0.48px;
            color: #fff;
            background: #ed1c24;
            border-radius: 12px;
            cursor: default;
            width: 100%;
        }

        .tab.active {
            color: #fff;
        }

        /* Kill the red sliding indicator if still present in DOM */
        .tab-indicator {
            display: none !important;
        }

        /* Divider Line */
        .divider {
            width: 338px;
            height: 3px;
            background: #ddd;
            margin: 0 auto 30px auto;
            margin-bottom: 0px;
        }

        /* Order Cards */
        .orders-list {
            padding: 0 20px;
            margin-bottom: 140px;
            margin-top: 0px;
        }

        .order-card {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .order-details {
            flex: 1;
        }

        .order-title {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.8px;
            color: #333;
            margin-bottom: 8px;
        }

        .order-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .order-items {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: -0.44px;
            color: #333;
        }

        .order-price {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: -0.44px;
            color: #333;
        }

        .order-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .order-time-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: -0.28px;
            color: #333;
        }

        .order-time {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: -0.28px;
            color: #333;
        }

        .order-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 8px 12px;
            border-radius: 20px;
            border: none;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: -0.28px;
            color: white;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-cooking {
            background: #ed1c24;
        }

        .btn-reorder {
            background: #2ecc71;
        }

        .btn-receipt {
            background: #d1ad71;
        }
    </style>
@endpush

@section("content")
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="window.history.back()">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <h1 class="header-title">Status Pesanan</h1>
    </div>

    <!-- Status Tabs -->
    

    <!-- Orders List -->
    <div class="orders-list" id="ordersList">
        <!-- Pesanan akan dimuat secara dinamis berdasarkan tab yang aktif -->
    </div>

@endsection

@push("scripts")
    <script>
        // Data pesanan dari database
        const ordersData = [
            @foreach ($ordersWithItems as $order)
                {
                    id: {{ $order->id }},
                    orderId: '{{ $order->id }}',
                    title: 'Pesanan #{{ $order->id }} - {{ $order->room_number }}',
                    items: {{ $order->item_count }},
                    price: 'IDR {{ number_format($order->total, 0, ",", ".") }}',
                    time: '{{ \Carbon\Carbon::parse($order->order_time)->format("H:i") }}',
                    date: '{{ \Carbon\Carbon::parse($order->order_time)->format("d/m/Y") }}',
                    status: '{{ $order->status == "completed" ? "selesai" : ($order->status == "processing" ? "sedang-dimasak" : $order->status) }}',
                    originalStatus: '{{ $order->status }}',
                    icon: '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 21h18M5 21V10M19 21V10M9 21V15C9 13.8954 9.89543 13 11 13H13C14.1046 13 15 13.8954 15 15V21M3 7L5 3H19L21 7H3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 9V5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
                    customerNote: '{{ addslashes($order->customer_note ?? "") }}',
                    orderItems: [
                        @foreach ($order->items as $item)
                            {
                                name: '{{ addslashes($item->menu_name) }}',
                                quantity: {{ $item->quantity }},
                                price: {{ $item->price }},
                                notes: '{{ addslashes($item->notes ?? "") }}'
                            }
                            {{ !$loop->last ? "," : "" }}
                        @endforeach
                    ]
                }
                {{ !$loop->last ? "," : "" }}
            @endforeach
        ];

        // Tab switching functionality
        function switchTab(tabName) {
            const tabs = document.querySelectorAll('.tab');
            const indicator = document.getElementById('tabIndicator');

            // Remove active class from all tabs
            tabs.forEach(tab => tab.classList.remove('active'));

            // Add active class to clicked tab
            const activeTab = document.querySelector(`[data-tab="${tabName}"]`);
            activeTab.classList.add('active');

            // Move indicator
            indicator.className = 'tab-indicator';
            if (tabName === 'sedang-dimasak') {
                indicator.classList.add('middle');
            } else if (tabName === 'selesai') {
                indicator.classList.add('right');
            }

            // Filter orders based on selected tab
            if (tabName === 'sedang-dimasak') {
                filterOrders('pending');
            } else {
                filterOrders(tabName);
            }
        }

        function showCookingOnly() {
            const ordersList = document.getElementById('ordersList');
            ordersList.innerHTML = '';

            // Include both variants just in case your data uses either one
            const cookingStatuses = new Set(['pending', 'sedang-dimasak']);

            const filteredOrders = ordersData.filter(o => cookingStatuses.has(o.status));

            if (filteredOrders.length === 0) {
                ordersList.innerHTML = '<div class="no-orders">Tidak ada pesanan</div>';
                return;
            }

            filteredOrders.forEach(order => {
                const orderCard = document.createElement('div');
                orderCard.className = 'order-card';

                let actionButtons = `
      <button class="action-btn btn-cooking">Sedang dimasak</button>
      <button class="action-btn btn-receipt" onclick="viewReceipt('${order.id}')">Lihat struk</button>
    `;

                if (order.status === 'cancelled') {
                    actionButtons = `
        <button class="action-btn btn-cooking" style="background: #e74c3c;">Dibatalkan</button>
        <button class="action-btn btn-receipt" onclick="viewReceipt('${order.id}')">Lihat struk</button>
      `;
                }

                orderCard.innerHTML = `
      <div class="order-icon">
        ${order.icon}
      </div>
      <div class="order-details">
        <div class="order-title">${order.title}</div>
        <div class="order-info">
          <span class="order-items">${order.items} item</span>
          <span class="order-price">${order.price}</span>
        </div>
        <div class="order-meta">
          <span class="order-time-label">Ordered :</span>
          <span class="order-time">${order.date} ${order.time}</span>
        </div>
        <div class="order-actions">
          ${actionButtons}
        </div>
      </div>
    `;

                ordersList.appendChild(orderCard);
            });
        }

        function filterOrders(status) {
            const ordersList = document.getElementById('ordersList');
            ordersList.innerHTML = '';

            let filteredOrders = [];

            if (status === 'riwayat') {
                // Tab riwayat menampilkan semua pesanan
                filteredOrders = ordersData;
            } else {
                // Tab lainnya hanya menampilkan pesanan dengan status yang sesuai
                filteredOrders = ordersData.filter(order => order.status === status);
            }

            if (filteredOrders.length === 0) {
                ordersList.innerHTML = '<div class="no-orders">Tidak ada pesanan</div>';
                return;
            }

            filteredOrders.forEach(order => {
                const orderCard = document.createElement('div');
                orderCard.className = 'order-card';

                let actionButtons = '';

                if (order.status === 'pending') {
                    actionButtons = `
                        <button class="action-btn btn-cooking">Menunggu</button>
                        <button class="action-btn btn-receipt" onclick="viewReceipt('${order.id}')">Lihat struk</button>
                    `;
                } else if (order.status === 'sedang-dimasak') {
                    actionButtons = `
                        <button class="action-btn btn-cooking">Sedang dimasak</button>
                        <button class="action-btn btn-receipt" onclick="viewReceipt('${order.id}')">Lihat struk</button>
                    `;
                } else if (order.status === 'selesai') {
                    actionButtons = `
                        <button class="action-btn btn-reorder" onclick="pesanLagi()">Pesan lagi</button>
                        <button class="action-btn btn-receipt" onclick="viewReceipt('${order.id}')">Lihat struk</button>
                    `;
                } else if (order.status === 'cancelled') {
                    actionButtons = `
                        <button class="action-btn btn-cooking" style="background: #e74c3c;">Dibatalkan</button>
                        <button class="action-btn btn-receipt" onclick="viewReceipt('${order.id}')">Lihat struk</button>
                    `;
                }

                orderCard.innerHTML = `
                    <div class="order-icon">
                        ${order.icon}
                    </div>
                    <div class="order-details">
                        <div class="order-title">${order.title}</div>
                        <div class="order-info">
                            <span class="order-items">${order.items} item</span>
                            <span class="order-price">${order.price}</span>
                        </div>
                        <div class="order-meta">
                            <span class="order-time-label">Ordered :</span>
                            <span class="order-time">${order.time}</span>
                        </div>
                        <div class="order-actions">
                            ${actionButtons}
                        </div>
                    </div>
                `;

                ordersList.appendChild(orderCard);
            });
        }

        // View receipt functionality
        function viewReceipt(orderId) {
            // Open receipt page in new tab
            const receiptUrl = "{{ route("receipt", ":orderId") }}".replace(':orderId', orderId);
            window.open(receiptUrl, '_blank');
        }

        // Fungsi untuk pesan lagi
        function pesanLagi() {
            window.location.href = '{{ route("menu") }}';
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Directly render cooking queue
            showCookingOnly();

            console.log('Status Pesanan page loaded (Sedang dimasak only) with', ordersData.length, 'orders');

            // Initialize cart summary (unchanged)
            initializeCartSummary();
        });
        // --- Cart Summary Functionality ---
        const cartSummary = document.getElementById('cartSummary');
        const cartItemCount = document.getElementById('cartItemCount');
        const cartTotalPrice = document.getElementById('cartTotalPrice');

        // Get cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Function to update cart summary display
        function updateCartSummary() {
            let totalItems = 0;
            let totalCartPrice = 0;

            cart.forEach(item => {
                totalItems += item.quantity;
                totalCartPrice += item.quantity * item.price;
            });

            if (cartItemCount) {
                cartItemCount.textContent = totalItems;
            }
            if (cartTotalPrice) {
                cartTotalPrice.textContent = `IDR ${totalCartPrice.toLocaleString('id-ID')}`;
            }

            if (cartSummary) {
                if (totalItems > 0) {
                    cartSummary.classList.add('active');
                } else {
                    cartSummary.classList.remove('active');
                }
            }
        }

        // Initialize cart summary
        function initializeCartSummary() {
            updateCartSummary();
        }

        // Event listener for checkout button in cart summary
        if (cartSummary) {
            cartSummary.addEventListener('click', () => {
                window.location.href = '{{ route("checkout") }}';
            });
        }

        // Listen for storage changes (when cart is updated in other tabs)
        window.addEventListener('storage', function(e) {
            if (e.key === 'cart') {
                cart = JSON.parse(e.newValue) || [];
                updateCartSummary();
            }
        });

        // Listen for custom storage event (when cart is updated in same tab)
        window.addEventListener('storage', updateCartSummary);
    </script>
@endpush
