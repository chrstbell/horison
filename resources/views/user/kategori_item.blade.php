@extends("layouts.home")

@section("title", "HORISON Hotels | Kategori")

@push("styles")
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, sans-serif;
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

        /* Menu Content */
        .menu-content {
            padding: 20px;
            padding-bottom: 100px;
        }

        .menu-item {
            display: flex;
            gap: 14px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid #ffd93d;
            border-radius: 12px;
            padding: 12px;
            box-shadow: 0 10px 30px rgba(255, 217, 61, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            align-items: center;
            height: 180px;
            cursor: pointer;
        }

        .menu-item:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 40px rgba(255, 217, 61, 0.4);
        }

        .menu-image {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            background: #f0f0f0;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: #999;
            text-align: center;
            line-height: 1.2;
            overflow: hidden;
        }

        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .menu-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .menu-title {
            font-weight: 700;
            font-size: 20px;
            color: #2c3e50;
            margin-top: 2px;
            line-height: 1.3;
        }

        .menu-description {
            font-weight: 500;
            font-size: 10px;
            color: #666;
            line-height: 1.3;
            margin-top: 6px;
        }

        .menu-price {
            font-weight: 600;
            font-size: 15px;
            color: #e74c3c;
            margin-top: 7px;
        }

        .add-btn {
            background: transparent;
            border: 1.5px solid #2ecc71;
            border-radius: 15px;
            padding: 6px 14px;
            font-weight: 600;
            font-size: 11px;
            color: #2ecc71;
            cursor: pointer;
            transition: all 0.3s ease;
            align-self: flex-start;
            max-width: 300px;
            text-align: center;
            margin-top: 10px;
        }

        .add-btn:hover {
            background: #2ecc71;
            color: white;
            transform: scale(1.05);
        }

        /* Quantity Selector for Menu Item */
        .menu-item .quantity-selector-inline {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            width: 100%;
            max-width: 120px;
            border: 1.5px solid #2ecc71;
            border-radius: 15px;
            overflow: hidden;
            gap: 26px;
        }

        .menu-item .quantity-selector-inline .quantity-btn {
            width: 30px;
            height: 30px;
            border: none;
            background: #2ecc71;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            flex-shrink: 0;
        }

        .menu-item .quantity-selector-inline .quantity-btn:hover {
            background: #27ae60;
        }

        .menu-item .quantity-selector-inline .quantity-value {
            flex-grow: 1;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            padding: 0 2px;
            min-width: 25px;
        }

        .menu-item {
            display: grid;
            grid-template-columns: 150px 1fr;
            align-items: stretch;
            height: 180px;
        }

        .menu-info {
            display: flex;
            flex-direction: column;
            min-width: 0;
            /* allow text to clamp instead of growing */
            min-height: 0;
        }

        /* Clamp long titles/descriptions to keep height stable */
        .menu-title {
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* max 2 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
            margin-right: 4px;
            /* tiny breathing room from right edge */
        }

        .menu-description {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* max 2 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Price sits above the button; button is pinned to bottom */
        .menu-price {
            margin-top: 6px;
        }

        .add-btn {
            margin-top: auto;
            align-self: flex-start;
            max-width: 100%;
            white-space: nowrap;
            height: 34px;
            padding: 6px 14px;
        }

        .menu-item .quantity-selector-inline {
            display: none;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
            width: 180px;
            border: 1.5px solid #2ecc71;
            border-radius: 15px;
            overflow: hidden;
            gap: 0;
        }

        .menu-item .quantity-selector-inline .quantity-btn {
            width: 34px;
            height: 34px;
        }

        .menu-item .quantity-selector-inline .quantity-value-inline {
            flex: 1 1 auto;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            padding: 0 6px;
            min-width: 28px;
        }

        /* Overlay dan Popup Detail Produk - MODIFIED */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: flex-end;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .product-detail {
            background: white;
            border-radius: 20px 20px 0 0;
            width: 100%;
            max-width: 430px;
            padding: 25px;
            position: relative;
            transform: translateY(100%);
            opacity: 0;
            transition: all 0.4s ease;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.15);
            max-height: 85vh;
            overflow-y: auto;
        }

        .overlay.active .product-detail {
            transform: translateY(0);
            opacity: 1;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #888;
            transition: color 0.3s;
            z-index: 10;
        }

        .close-btn:hover {
            color: #333;
        }

        .product-header {
            display: flex;
            margin-bottom: 20px;
        }

        .product-thumbnail {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            overflow: hidden;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .product-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-basic-info {
            flex: 1;
        }

        .product-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: #e74c3c;
        }

        .product-description {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .product-details {
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-label {
            font-weight: 500;
            color: #555;
        }

        .detail-value {
            font-weight: 400;
            color: #333;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px 0;
            background: #f9f9f9;
            border-radius: 10px;
            padding: 12px 15px;
        }

        .quantity-label {
            font-weight: 600;
            color: #333;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background: white;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .quantity-btn:hover {
            background: #f5f5f5;
        }

        .quantity-value {
            margin: 0 15px;
            font-size: 18px;
            font-weight: 600;
            min-width: 30px;
            text-align: center;
        }

        .add-to-cart-btn {
            width: 100%;
            padding: 15px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .add-to-cart-btn:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }

        .add-to-cart-btn:active {
            transform: translateY(0);
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
        <h1 class="header-title">{{ $category_name }}</h1>
    </div>

    <!-- Menu Content -->
    <div class="menu-content">
        <!-- Contoh menu item -->
        @foreach ($menu_data as $item)
            <div class="menu-item" data-id="{{ $item->id }}">
                <div class="menu-image">
                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" />
                </div>
                <div class="menu-info">
                    <h3 class="menu-title">{{ $item->name }}</h3>
                    <p class="menu-description">{{ $item->description }}</p>
                    <p class="menu-price">IDR {{ number_format($item->price, 0, ",", ".") }}</p>
                    @if ($item->is_available)
                        <button class="add-btn">Tambah ke Keranjang</button>
                    @else
                        <button class="add-btn" disabled
                            style="opacity: 0.6; cursor: not-allowed; background-color: #95a5a6;">Stok habis</button>
                    @endif
                    <!-- Quantity selector for menu item (initially hidden) -->
                    <div class="quantity-selector-inline" style="display: none;">
                        <button class="quantity-btn decrease-btn-inline">-</button>
                        <span class="quantity-value-inline">0</span>
                        <button class="quantity-btn increase-btn-inline">+</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Overlay dan Popup Detail Produk - MODIFIED -->
    <div class="overlay" id="productOverlay">
        <div class="product-detail">
            <button class="close-btn" id="closeProductDetail">&times;</button>

            <div class="product-header">
                <div class="product-thumbnail">
                    <img id="detailImage" src="" alt="Product Image" />
                </div>
                <div class="product-basic-info">
                    <h2 class="product-title" id="detailTitle"></h2>
                    <p class="product-price" id="detailPrice"></p>
                </div>
            </div>

            <p class="product-description" id="detailDescription"></p>

            <div class="product-details">
                <div class="detail-item">
                    <span class="detail-label">Kategori</span>
                    <span class="detail-value" id="detailCategory">Makanan Utama</span>
                </div>
            </div>

            <div class="quantity-selector">
                <span class="quantity-label">Jumlah:</span>
                <div class="quantity-controls">
                    <button class="quantity-btn" id="decreaseQty">-</button>
                    <span class="quantity-value" id="quantity">1</span>
                    <button class="quantity-btn" id="increaseQty">+</button>
                </div>
            </div>

            <button class="add-to-cart-btn" id="addToCartDetail">
                Tambah ke Keranjang - <span id="totalPrice"></span>
            </button>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        // Data produk
        const products = {
            @foreach ($menu_data as $item)
                {{ $item->id }}: {
                    id: {{ $item->id }},
                    title: "{{ $item->name }}",
                    price: {{ $item->price }},
                    description: "{{ $item->description }}",
                    image: "{{ asset($item->image_path) }}",
                    category: "{{ $item->subcategory_name ?? "" }}",
                    isAvailable: {{ $item->is_available ? "true" : "false" }}
                },
            @endforeach
        };

        // Elemen DOM
        const overlay = document.getElementById('productOverlay');
        const closeBtn = document.getElementById('closeProductDetail');
        const detailImage = document.getElementById('detailImage');
        const detailTitle = document.getElementById('detailTitle');
        const detailPrice = document.getElementById('detailPrice');
        const detailDescription = document.getElementById('detailDescription');
        const detailCategory = document.getElementById('detailCategory');
        const quantityElement = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decreaseQty');
        const increaseBtn = document.getElementById('increaseQty');
        const totalPriceElement = document.getElementById('totalPrice');
        const addToCartDetailBtn = document.getElementById('addToCartDetail');

        // Elemen keranjang baru
        const cartSummary = document.getElementById('cartSummary');
        const cartItemCount = document.getElementById('cartItemCount');
        const cartTotalPrice = document.getElementById('cartTotalPrice');

        let currentProductId = null;
        let currentPrice = 0;
        let quantity = 1;

        // Variabel untuk menyimpan item di keranjang
        // Inisialisasi cart dari localStorage atau array kosong jika belum ada
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Fungsi untuk menyimpan keranjang ke localStorage
        function saveCartToLocalStorage() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Fungsi untuk menampilkan detail produk
        function showProductDetail(productId) {
            const product = products[productId];
            if (!product) return;

            currentProductId = productId;
            currentPrice = product.price;

            // Dapatkan kuantitas produk dari keranjang, jika ada. Jika tidak, default ke 1.
            const existingItem = cart.find(item => item.productId == productId);
            quantity = existingItem ? existingItem.quantity : 1;

            // Isi data produk
            detailImage.src = product.image;
            detailImage.alt = product.title;
            detailTitle.textContent = product.title;
            detailPrice.textContent = `IDR ${product.price.toLocaleString('id-ID')}`;
            detailDescription.textContent = product.description;
            detailCategory.textContent = product.category;

            // Update quantity dan total harga di popup
            quantityElement.textContent = quantity;
            updateTotalPriceInPopup();

            // Handle availability status
            if (!product.isAvailable) {
                // Item not available
                addToCartDetailBtn.textContent = 'Stok habis';
                addToCartDetailBtn.disabled = true;
                addToCartDetailBtn.style.background = '#95a5a6';
                addToCartDetailBtn.style.opacity = '0.6';
                addToCartDetailBtn.style.cursor = 'not-allowed';
                // Disable quantity controls
                decreaseBtn.disabled = true;
                increaseBtn.disabled = true;
                decreaseBtn.style.opacity = '0.5';
                increaseBtn.style.opacity = '0.5';
                decreaseBtn.style.cursor = 'not-allowed';
                increaseBtn.style.cursor = 'not-allowed';
            } else {
                // Item available
                // Atur teks tombol "Tambah ke Keranjang" di pop-up berdasarkan kuantitas
                if (quantity > 0) {
                    addToCartDetailBtn.textContent =
                        `Update Keranjang - IDR ${ (currentPrice * quantity).toLocaleString('id-ID')}`;
                } else {
                    addToCartDetailBtn.textContent =
                        `Tambah ke Keranjang - IDR ${ (currentPrice * 1).toLocaleString('id-ID')}`;
                }
                addToCartDetailBtn.disabled = false;
                addToCartDetailBtn.style.background = '#2ecc71';
                addToCartDetailBtn.style.opacity = '1';
                addToCartDetailBtn.style.cursor = 'pointer';
                // Enable quantity controls
                decreaseBtn.disabled = false;
                increaseBtn.disabled = false;
                decreaseBtn.style.opacity = '1';
                increaseBtn.style.opacity = '1';
                decreaseBtn.style.cursor = 'pointer';
                increaseBtn.style.cursor = 'pointer';
            }

            // Tampilkan overlay
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Mencegah scrolling body saat overlay aktif
        }

        // Fungsi untuk menyembunyikan detail produk
        function hideProductDetail() {
            overlay.classList.remove('active');
            document.body.style.overflow = ''; // Mengembalikan scrolling body
        }

        // Fungsi untuk update total harga di popup
        function updateTotalPriceInPopup() {
            const total = currentPrice * quantity;
            totalPriceElement.textContent = `IDR ${total.toLocaleString('id-ID')}`;
            // Update teks tombol "Tambah ke Keranjang" di pop-up secara real-time
            if (quantity > 0) {
                addToCartDetailBtn.textContent = `Update Keranjang - IDR ${total.toLocaleString('id-ID')}`;
            } else {
                addToCartDetailBtn.textContent = `Hapus dari Keranjang`;
            }
        }

        // Fungsi untuk memperbarui tampilan ringkasan keranjang
        function updateCartSummary() {
            let totalItems = 0;
            let totalCartPrice = 0;

            cart.forEach(item => {
                totalItems += item.quantity;
                totalCartPrice += item.quantity * item.price;
            });

            cartItemCount.textContent = totalItems;
            cartTotalPrice.textContent = `IDR ${totalCartPrice.toLocaleString('id-ID')}`;

            if (totalItems > 0) {
                cartSummary.classList.add('active');
            } else {
                cartSummary.classList.remove('active');
            }
        }

        // Fungsi untuk menambahkan/mengupdate/menghapus produk dari keranjang
        function updateCartItem(productId, newQuantity) {
            const product = products[productId];
            if (!product) return;

            const existingItemIndex = cart.findIndex(item => item.productId == productId);

            if (newQuantity > 0) {
                if (existingItemIndex > -1) {
                    // Update kuantitas jika produk sudah ada
                    cart[existingItemIndex].quantity = newQuantity;
                } else {
                    // Tambahkan produk baru jika belum ada
                    cart.push({
                        productId: productId,
                        quantity: newQuantity,
                        price: product.price,
                        title: product.title, // Tambahkan title untuk kemudahan di checkout
                        image: product.image // Tambahkan image untuk kemudahan di checkout
                    });
                }
            } else {
                // Hapus produk jika kuantitas 0
                if (existingItemIndex > -1) {
                    cart.splice(existingItemIndex, 1);
                }
            }
            saveCartToLocalStorage(); // Simpan perubahan ke localStorage
            updateCartSummary();
            updateMenuItemDisplay(productId); // Perbarui tampilan item di daftar menu
        }

        // Fungsi untuk memperbarui tampilan item di daftar menu (tombol vs. input kuantitas)
        function updateMenuItemDisplay(productId) {
            const menuItem = document.querySelector(`.menu-item[data-id="${productId}"]`);
            if (!menuItem) return;

            const addBtn = menuItem.querySelector('.add-btn');
            const quantitySelectorInline = menuItem.querySelector('.quantity-selector-inline');
            const quantityValueInline = menuItem.querySelector('.quantity-value-inline');

            const existingItem = cart.find(item => item.productId == productId);

            if (existingItem && existingItem.quantity > 0) {
                addBtn.style.display = 'none';
                quantitySelectorInline.style.display = 'flex';
                quantityValueInline.textContent = existingItem.quantity;
            } else {
                addBtn.style.display = 'block';
                quantitySelectorInline.style.display = 'none';
                addBtn.textContent = 'Tambah ke Keranjang'; // Kembalikan teks tombol
                addBtn.style.background = 'transparent'; // Kembalikan warna tombol
                addBtn.style.color = '#2ecc71'; // Kembalikan warna teks
            }
        }

        // Event listener untuk menu item (untuk membuka pop-up)
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', (e) => {
                // Pastikan klik bukan pada tombol "Tambah ke Keranjang" atau kontrol kuantitas inline
                if (!e.target.classList.contains('add-btn') &&
                    !e.target.classList.contains('quantity-btn') &&
                    !e.target.closest('.quantity-selector-inline')) {
                    const productId = item.getAttribute('data-id');
                    showProductDetail(productId);
                }
            });
        });

        // Event listener untuk tombol close pop-up
        closeBtn.addEventListener('click', hideProductDetail);

        // Event listener untuk overlay (klik di luar popup untuk menutup)
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                hideProductDetail();
            }
        });

        // Event listener untuk tombol quantity di pop-up
        decreaseBtn.addEventListener('click', () => {
            if (quantity > 0) {
                quantity--;
                quantityElement.textContent = quantity;
                updateTotalPriceInPopup();
            }
        });

        increaseBtn.addEventListener('click', () => {
            quantity++;
            quantityElement.textContent = quantity;
            updateTotalPriceInPopup();
        });

        // Event listener untuk tombol tambah ke keranjang di pop-up
        addToCartDetailBtn.addEventListener('click', () => {
            updateCartItem(currentProductId, quantity);

            // Feedback visual
            if (quantity > 0) {
                addToCartDetailBtn.textContent = 'Ditambahkan ke Keranjang!';
                addToCartDetailBtn.style.background = '#27ae60';
            } else {
                addToCartDetailBtn.textContent = 'Dihapus dari Keranjang!';
                addToCartDetailBtn.style.background = '#e74c3c';
            }

            setTimeout(() => {
                hideProductDetail();
                // Setelah pop-up tertutup, reset teks tombol di pop-up untuk penggunaan berikutnya
                addToCartDetailBtn.textContent =
                    `Tambah ke Keranjang - IDR ${ (currentPrice * 1).toLocaleString('id-ID')}`;
                addToCartDetailBtn.style.background = '#2ecc71';
            }, 1000); // Mengurangi delay agar lebih responsif
        });

        // Event listener untuk tombol "Tambah ke Keranjang" di daftar menu
        document.querySelectorAll('.add-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const productId = e.target.closest('.menu-item').getAttribute('data-id');
                // Saat menambahkan dari tombol "Tambah ke Keranjang", selalu tambahkan 1
                updateCartItem(productId, (cart.find(item => item.productId == productId)?.quantity || 0) +
                    1);

                // Feedback visual
                button.textContent = 'Ditambahkan!';
                button.style.background = '#2ecc71';
                button.style.color = '#fff';

                setTimeout(() => {
                    updateMenuItemDisplay(productId);
                }, 500);
            });
        });

        // Event listener untuk tombol kuantitas inline di daftar menu
        document.querySelectorAll('.menu-item').forEach(menuItem => {
            const productId = menuItem.getAttribute('data-id');
            const decreaseBtnInline = menuItem.querySelector('.decrease-btn-inline');
            const increaseBtnInline = menuItem.querySelector('.increase-btn-inline');
            const quantityValueInline = menuItem.querySelector('.quantity-value-inline');

            if (decreaseBtnInline && increaseBtnInline && quantityValueInline) {
                decreaseBtnInline.addEventListener('click', (e) => {
                    e.stopPropagation();
                    let currentQty = parseInt(quantityValueInline.textContent);
                    if (currentQty > 0) {
                        currentQty--;
                        updateCartItem(productId, currentQty);
                    }
                });

                increaseBtnInline.addEventListener('click', (e) => {
                    e.stopPropagation();
                    let currentQty = parseInt(quantityValueInline.textContent);
                    currentQty++;
                    updateCartItem(productId, currentQty);
                });
            }
        });

        // Event listener untuk tombol Checkout di cart summary
        cartSummary.addEventListener('click', () => {
            // Data keranjang sudah disimpan secara otomatis oleh updateCartItem
            window.location.href = '{{ route("checkout") }}'; // Arahkan ke halaman checkout
        });

        // Inisialisasi tampilan keranjang dan item menu saat halaman dimuat
        function initializePage() {
            // Variabel cart sudah diinisialisasi dari localStorage di awal script
            updateCartSummary();
            document.querySelectorAll('.menu-item').forEach(item => {
                const productId = item.getAttribute('data-id');
                updateMenuItemDisplay(productId);
            });
        }

        initializePage();
    </script>
@endpush
