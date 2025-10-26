@extends("layouts.home")

@section("title", "HORISON Hotels | Checkout")

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

        /* Content */
        .content {
            padding: 20px;
            padding-bottom: 180px;
        }

        /* Delivery Details Section */
        .delivery-section {
            background: #ededed;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            position: relative;
        }

        .delivery-header {
            font-weight: 600;
            font-size: 11px;
            color: #333;
            margin-bottom: 8px;
        }

        .room-number {
            font-weight: 700;
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .notes-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #D1AD71;
            border: none;
            border-radius: 20px;
            padding: 4px 12px;
            display: flex;
            height: 33px;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notes-btn:hover {
            background: #B8985C;
            transform: scale(1.02);
        }

        .notes-btn span {
            font-weight: 700;
            font-size: 13px;
            color: white;
        }

        .notes-icon {
            width: 16px;
            height: 16px;
            background: white;
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .notes-icon::before {
            content: '+';
            color: #D1AD71;
            font-weight: bold;
            font-size: 12px;
        }

        /* Added styles for displayed notes */
        .displayed-note {
            background: #dcdcdc;
            /* Slightly darker grey */
            border-radius: 8px;
            padding: 8px 12px;
            margin-top: 10px;
            font-size: 14px;
            color: #555;
            word-wrap: break-word;
        }

        /* Order Items Section */
        .order-section {
            background: #ededed;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            position: relative;
        }

        .order-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .item-image {
            width: 150px;
            height: 150px;
            border-radius: 13px;
            background: #f0f0f0;
            flex-shrink: 0;
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .item-title {
            font-weight: 700;
            font-size: 24px;
            color: #333;
            margin-bottom: 8px;
            text-align: right;
        }

        .item-price {
            font-weight: 700;
            font-size: 16px;
            color: #333;
            text-align: right;
            margin-bottom: 15px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid #D1AD71;
            background: transparent;
            font-size: 16px;
            font-weight: bold;
            color: #D1AD71;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: #D1AD71;
            color: white;
        }

        .quantity-value {
            font-weight: 700;
            font-size: 16px;
            color: #333;
            min-width: 20px;
            text-align: center;
        }

        .section-divider {
            height: 3px;
            background: #D1AD71;
            border-radius: 67px;
            margin: 20px 0;
        }

        .add-more-section {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .add-more-content {
            flex: 1;
        }

        .add-more-title {
            font-weight: 700;
            font-size: 18px;
            color: #333;
            margin-bottom: 8px;
        }

        .add-more-subtitle {
            font-weight: 500;
            font-size: 13px;
            color: #333;
            margin-bottom: 10px;
        }

        .add-more-btn {
            background: transparent;
            border: 3px solid #D1AD71;
            border-radius: 14px;
            padding: 6px 20px;
            font-weight: 600;
            font-size: 13px;
            color: #D1AD71;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 15px;
        }

        .add-more-btn:hover {
            background: #D1AD71;
            color: white;
            transform: scale(1.05);
        }

        /* Payment Details Section */
        .payment-section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: 700;
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
            margin-top: 28px;
        }

        .payment-details {
            background: #ededed;
            border-radius: 10px;
            padding: 15px;
            position: relative;
        }

        .payment-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .payment-item:last-child {
            margin-bottom: 0;
        }

        .payment-label {
            color: #333;
            font-weight: 400;
        }

        .payment-value {
            color: #333;
            font-weight: 400;
        }

        .total-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 3px solid #D1AD71;
        }

        .total-item {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        /* Bottom Payment Section */
        .bottom-payment {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 390px;
            background: #ededed;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .payment-method {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .payment-icon {
            width: 55px;
            height: 55px;
            background: #f0f0f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .payment-info {
            flex: 1;
        }

        .payment-method-label {
            font-size: 14px;
            color: #333;
            margin-bottom: 4px;
        }

        .payment-amount {
            font-weight: 700;
            font-size: 20px;
            color: #333;
        }

        .pay-button {
            width: 100%;
            background: #D1AD71;
            border: none;
            border-radius: 31px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pay-button:hover {
            background: #B8985C;
            transform: translateY(-2px);
        }

        .pay-button:active {
            transform: translateY(0);
        }

        /* Notes Modal - Modified for bottom slide-up */
        .notes-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: flex-end;
            /* Align to bottom */
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .notes-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .notes-content {
            background: white;
            border-radius: 20px 20px 0 0;
            /* Rounded top corners */
            padding: 25px;
            width: 100%;
            /* Full width */
            max-width: 430px;
            /* Max width like container */
            position: relative;
            transform: translateY(100%);
            /* Start off-screen */
            opacity: 0;
            transition: all 0.4s ease;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.15);
            max-height: 85vh;
            /* Limit height */
            overflow-y: auto;
        }

        .notes-modal.active .notes-content {
            transform: translateY(0);
            /* Slide up */
            opacity: 1;
        }

        .notes-title {
            font-weight: 700;
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
        }

        .notes-input {
            width: 100%;
            min-height: 100px;
            border: 2px solid #ededed;
            border-radius: 10px;
            padding: 15px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            resize: vertical;
            margin-bottom: 20px;
        }

        .notes-buttons {
            display: flex;
            gap: 10px;
        }

        .notes-cancel-btn,
        .notes-save-btn {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notes-cancel-btn {
            background: transparent;
            border: 2px solid #ddd;
            color: #666;
        }

        .notes-save-btn {
            background: #D1AD71;
            border: 2px solid #D1AD71;
            color: white;
        }

        .notes-cancel-btn:hover {
            background: #f5f5f5;
        }

        .notes-save-btn:hover {
            background: #B8985C;
            border-color: #B8985C;
        }

        /* Success Message */
        .success-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #2ecc71;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            font-weight: 600;
            z-index: 3000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .success-message.show {
            opacity: 1;
            visibility: visible;
        }

        /* Confirmation Modal */
        .confirmation-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2500;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .confirmation-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .confirmation-content {
            background: white;
            border-radius: 20px;
            padding: 25px;
            width: 90%;
            max-width: 380px;
            text-align: center;
        }

        .confirmation-title {
            font-weight: 700;
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .confirmation-message {
            font-size: 16px;
            color: #555;
            margin-bottom: 25px;
        }

        .confirmation-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .confirmation-btn {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .confirmation-btn.cancel {
            background: transparent;
            border: 2px solid #ddd;
            color: #666;
        }

        .confirmation-btn.confirm {
            background: #e74c3c;
            border: 2px solid #e74c3c;
            color: white;
        }

        .confirmation-btn.cancel:hover {
            background: #f5f5f5;
        }

        .confirmation-btn.confirm:hover {
            background: #c0392b;
            border-color: #c0392b;
        }

        /* Responsive untuk layar besar/tablet */
        @media (min-width: 768px) {
            .container {
                max-width: 480px;
                margin: 0 auto;
                box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
            }
        }
    </style>
@endpush

@section("content")
    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="window.history.back()">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <h1 class="header-title">Pembayaran</h1>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Delivery Details Section -->
        <div class="delivery-section">
            <div class="delivery-header">Detail pengiriman</div>
            <div class="room-number" id="deliveryLocation">{{ $roomNumber ? "Kamar " . $roomNumber : "Kamar 201" }}</div>
            <button class="notes-btn" onclick="openNotesModal('delivery')">
                <div class="notes-icon"></div>
                <span>Catatan</span>
            </button>
            <div id="deliveryNotesDisplay" class="displayed-note" style="display: none;"></div>
        </div>

        <!-- Order Items Section -->
        <div class="order-section">
            <div id="orderItems">
                <!-- Order items will be dynamically populated here -->
            </div>

            <div class="section-divider"></div>

            <div class="add-more-section">
                <div class="add-more-content">
                    <div class="add-more-title">Ada yang ingin dicoba lagi?</div>
                    <div class="add-more-subtitle">Menu lainnya masih tersedia</div>
                </div>
                <button class="add-more-btn" onclick="window.location.href='{{ route("menu") }}'">Tambah</button>
            </div>
        </div>

        <!-- Payment Details Section -->
        <div class="payment-section">
            <div class="section-title">Detail pembayaran</div>
            <div class="payment-details">
                <div class="payment-item">
                    <span class="payment-label">Harga</span>
                    <span class="payment-value" id="subtotal"></span>
                </div>
                <div class="total-section">
                    <div class="total-item">
                        <span>Total pembayaran</span>
                        <span id="totalPayment"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Payment Section -->
    <div class="bottom-payment">
        <div class="payment-method">
            <div class="payment-icon">💵</div>
            <div class="payment-info">
                <div class="payment-method-label">Tunai</div>
                <div class="payment-amount" id="totalAmount"></div>
            </div>
        </div>
        <button class="pay-button" onclick="processPayment()">
            Pesan dan bayar sekarang
        </button>
    </div>

    <!-- Notes Modal -->
    <div class="notes-modal" id="notesModal">
        <div class="notes-content">
            <h3 class="notes-title">Tambah Catatan</h3>
            <textarea class="notes-input" id="notesInput" placeholder="Masukkan catatan Anda disini..."></textarea>
            <div class="notes-buttons">
                <button class="notes-cancel-btn" onclick="closeNotesModal()">Batal</button>
                <button class="notes-save-btn" onclick="saveNotes()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <div class="success-message" id="successMessage">
        Pesanan berhasil dibuat!
    </div>

    <!-- Confirmation Modal -->
    <div class="confirmation-modal" id="confirmationModal">
        <div class="confirmation-content">
            <h3 class="confirmation-title">Konfirmasi Penghapusan</h3>
            <p class="confirmation-message">Apakah Anda yakin ingin menghapus semua produk dari keranjang?</p>
            <div class="confirmation-buttons">
                <button class="confirmation-btn cancel" onclick="cancelConfirmation()">Tidak</button>
                <button class="confirmation-btn confirm" onclick="confirmDeletion()">Ya, Hapus Semua</button>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let currentNotesType = '';
        let deliveryNotes = localStorage.getItem('deliveryNotes') || ''; // Load delivery notes
        let orderNotes = JSON.parse(localStorage.getItem('orderNotes')) || {}; // Load order notes

        // Initialize checkout page
        function initializeCheckout() {
            if (cart.length === 0) {
                // If cart is empty, redirect to menu
                alert('Keranjang Anda kosong. Silakan pilih menu terlebih dahulu.');
                window.location.href = '{{ route("home") }}';
                return;
            }

            displayOrderItems();
            calculateTotals();
            displaySavedNotes(); // Display notes on load
        }

        // Display order items
        function displayOrderItems() {
            const orderItemsContainer = document.getElementById('orderItems');
            orderItemsContainer.innerHTML = '';

            cart.forEach((item, index) => {
                const orderItem = document.createElement('div');
                console.log(item.image);
                orderItem.className = 'order-item';
                orderItem.innerHTML = `
                    <div class="item-image">
                        <img src="${item.image}" alt="${item.title}" />
                    </div>
                    <div class="item-info">
                        <div class="item-title">${item.title}</div>
                        <div class="item-price">IDR ${item.price.toLocaleString('id-ID')}</div>
                        <div class="quantity-control">
                            <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">-</button>
                            <span class="quantity-value">${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">+</button>
                        </div>
                        <button class="notes-btn" onclick="openNotesModal('order-${index}')" style="position: relative; top: auto; right: auto; margin-top: 10px;">
                            <div class="notes-icon"></div>
                            <span>Catatan</span>
                        </button>
                        <div id="orderNotesDisplay-${index}" class="displayed-note" style="display: none;"></div>
                    </div>
                `;
                orderItemsContainer.appendChild(orderItem);
            });
            displaySavedNotes(); // Re-display notes after updating items
        }

        // Update quantity
        function updateQuantity(index, change) {
            if (cart[index].quantity + change <= 0) {
                // Show confirmation modal if quantity becomes 0 and it's the last item
                if (cart.length === 1) {
                    showConfirmationModal();
                    return; // Stop further processing until confirmation
                } else {
                    // Remove item if quantity becomes 0
                    cart.splice(index, 1);
                    // Also remove its associated note
                    delete orderNotes[`order-${index}`];
                    localStorage.setItem('orderNotes', JSON.stringify(orderNotes));
                }
            } else {
                cart[index].quantity += change;
            }

            // Save to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Check if cart is empty after update
            if (cart.length === 0) {
                alert('Keranjang Anda kosong. Mengarahkan ke home...');
                window.location.href = '{{ route("home") }}';
                return;
            }

            // Refresh display
            displayOrderItems();
            calculateTotals();
        }

        // Calculate totals
        function calculateTotals() {
            let subtotal = 0;
            cart.forEach(item => {
                subtotal += item.price * item.quantity;
            });

            const taxRate = 0.10; // 10%
            const tax = Math.round(subtotal * taxRate);
            const total = subtotal;


            document.getElementById('subtotal').textContent = subtotal.toLocaleString('id-ID');
            // document.getElementById('tax').textContent = tax.toLocaleString('id-ID');
            document.getElementById('totalPayment').textContent = total.toLocaleString('id-ID');
            document.getElementById('totalAmount').textContent = `IDR ${total.toLocaleString('id-ID')}`;
        }

        // Open notes modal
        function openNotesModal(type) {
            currentNotesType = type;
            const modal = document.getElementById('notesModal');
            const input = document.getElementById('notesInput');

            // Load existing notes
            if (type === 'delivery') {
                input.value = deliveryNotes;
            } else {
                input.value = orderNotes[type] || '';
            }

            modal.classList.add('active');
            input.focus();
        }

        // Close notes modal
        function closeNotesModal() {
            const modal = document.getElementById('notesModal');
            modal.classList.remove('active');
            currentNotesType = '';
        }

        // Save notes
        function saveNotes() {
            const input = document.getElementById('notesInput');
            const notes = input.value.trim();

            if (currentNotesType === 'delivery') {
                deliveryNotes = notes;
                localStorage.setItem('deliveryNotes', deliveryNotes); // Save to localStorage
            } else {
                orderNotes[currentNotesType] = notes;
                localStorage.setItem('orderNotes', JSON.stringify(orderNotes)); // Save to localStorage
            }

            closeNotesModal();
            displaySavedNotes(); // Update displayed notes

            // Show brief confirmation
            showSuccessMessage('Catatan berhasil disimpan!');
        }

        // Display saved notes
        function displaySavedNotes() {
            const deliveryNotesDisplay = document.getElementById('deliveryNotesDisplay');
            if (deliveryNotes) {
                deliveryNotesDisplay.textContent = deliveryNotes;
                deliveryNotesDisplay.style.display = 'block';
            } else {
                deliveryNotesDisplay.style.display = 'none';
            }

            cart.forEach((item, index) => {
                const noteId = `orderNotesDisplay-${index}`;
                const itemNoteDisplay = document.getElementById(noteId);
                const noteContent = orderNotes[`order-${index}`];
                if (itemNoteDisplay) {
                    if (noteContent) {
                        itemNoteDisplay.textContent = noteContent;
                        itemNoteDisplay.style.display = 'block';
                    } else {
                        itemNoteDisplay.style.display = 'none';
                    }
                }
            });
        }

        // Process payment
        function processPayment() {
            // Validate cart is not empty
            if (cart.length === 0) {
                alert('Keranjang kosong. Silakan tambah item terlebih dahulu.');
                return;
            }

            const payButton = document.querySelector('.pay-button');
            payButton.textContent = 'Memproses...';
            payButton.disabled = true;

            // Calculate totals
            let subtotal = 0;
            cart.forEach(item => {
                subtotal += item.price * item.quantity;
            });
            const taxRate = 0.10;
            const tax = Math.round(subtotal * taxRate);
            const total = subtotal;

            // Prepare order items with notes
            const orderItems = cart.map((item, index) => {
                const menuId = item.productId || item.id || item.menu_id;
                if (!menuId) {
                    console.error('Menu ID not found for item:', item);
                }
                return {
                    menu_id: parseInt(menuId), // Ensure it's an integer
                    quantity: parseInt(item.quantity),
                    price: parseFloat(item.price),
                    notes: orderNotes[`order-${index}`] || null
                };
            });

            // Prepare order data
            const orderData = {
                room_number: '{{ $roomNumber }}',
                subtotal: subtotal,
                tax: tax,
                total: total,
                customer_note: deliveryNotes || null,
                items: orderItems
            };

            // Debug: Log the order data being sent
            console.log('Sending order data:', orderData);

            // Send order to server
            fetch('{{ route("orders.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Order response:', data);
                    if (data.success) {
                        // Clear cart and notes after successful payment
                        localStorage.removeItem('cart');
                        localStorage.removeItem('deliveryNotes');
                        localStorage.removeItem('orderNotes');
                        cart = [];
                        deliveryNotes = '';
                        orderNotes = {};

                        // Show success message
                        showSuccessMessage('Pesanan berhasil dibuat!');

                        // Redirect to status page or home after delay
                        setTimeout(() => {
                            window.location.href = '{{ route("status") }}';
                        }, 2000);
                    } else {
                        payButton.textContent = 'Pesan dan bayar sekarang';
                        payButton.disabled = false;
                        alert('Gagal membuat pesanan: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error creating order:', error);
                    payButton.textContent = 'Pesan dan bayar sekarang';
                    payButton.disabled = false;

                    // Show more detailed error message
                    if (error.message.includes('401')) {
                        alert('Sesi Anda telah berakhir. Silakan login kembali.');
                        window.location.href = '{{ route("login") }}';
                    } else if (error.message.includes('422')) {
                        alert('Data pesanan tidak valid. Silakan periksa kembali.');
                    } else {
                        alert('Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
                    }
                });
        }

        // Show success message
        function showSuccessMessage(message) {
            const successElement = document.getElementById('successMessage');
            successElement.textContent = message;
            successElement.classList.add('show');

            setTimeout(() => {
                successElement.classList.remove('show');
            }, 3000);
        }

        // Close modal when clicking outside
        document.getElementById('notesModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeNotesModal();
            }
        });

        // Confirmation Modal functions
        function showConfirmationModal() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.add('active');
        }

        function cancelConfirmation() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.remove('active');
            // If user cancels, revert the quantity change or do nothing
            // In this case, since updateQuantity already checked for cart.length === 1,
            // we just close the modal and the item remains in the cart.
        }

        function confirmDeletion() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.remove('active');

            // Clear cart and notes
            localStorage.removeItem('cart');
            localStorage.removeItem('deliveryNotes');
            localStorage.removeItem('orderNotes');
            cart = [];
            deliveryNotes = '';
            orderNotes = {};

            showSuccessMessage('Semua produk berhasil dihapus!');
            setTimeout(() => {
                window.location.href = '{{ route("home") }}'; // Redirect to home/menu
            }, 1500);
        }

        // Initialize page when DOM is loaded
        document.addEventListener('DOMContentLoaded', initializeCheckout);

        // Handle back button (optional, as cart is saved on updateQuantity)
        window.addEventListener('beforeunload', function() {
            // Save any unsaved data if needed (already handled by updateQuantity and saveNotes)
        });
    </script>
@endpush
