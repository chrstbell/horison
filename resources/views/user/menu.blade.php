@extends("layouts.home")

@section("title", "HORISON Hotels | Menu")

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
            border: 2px solid #FFD93D;
            border-radius: 12px;
            padding: 12px;
            box-shadow: 0 10px 30px rgba(255, 217, 61, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            align-items: center;
            height: auto;
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
            gap: 8px;
        }

        .menu-title {
            font-weight: 700;
            font-size: 20px;
            color: #2c3e50;
            margin-top: 2px;
            line-height: 1.3;
            overflow-wrap: anywhere;
            word-break: break-word;
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
            max-width: none;
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
            /* Menambahkan gap */
            gap: 26px;
            /* Memberikan jarak antara elemen */
        }

        .menu-item .quantity-selector-inline .quantity-btn {
            width: 30px;
            /* Mengubah lebar tombol */
            height: 30px;
            /* Mengubah tinggi tombol */
            border: none;
            background: #2ecc71;
            color: white;
            font-size: 16px;
            /* Mengubah ukuran font */
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            flex-shrink: 0;
            /* Mencegah tombol menyusut */
        }

        .menu-item .quantity-selector-inline .quantity-btn:hover {
            background: #27ae60;
        }

        .menu-item .quantity-selector-inline .quantity-value,
        .menu-item .quantity-selector-inline .quantity-value-inline {
            flex-grow: 1;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            padding: 0 2px;
            min-width: 25px;
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

        @media (max-width: 480px) {
            .menu-item {
                align-items: flex-start;
                /* top align to avoid stretch/overlap */
                gap: 10px;
            }

            .menu-image {
                width: 100px;
                height: 100px;
                border-radius: 10px;
            }

            .menu-title {
                font-size: 16px;
            }

            .menu-price {
                font-size: 14px;
            }

            .menu-description {
                font-size: 11px;
                /* clamp to 2 lines */
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .menu-info {
                gap: 6px;
            }

            /* Make button full width to avoid crowding */
            .add-btn {
                align-self: stretch;
                width: 100%;
                padding: 8px 12px;
                margin-top: 6px;
            }

            /* Quantity bar full width */
            .menu-item .quantity-selector-inline {
                align-self: stretch;
                width: 100%;
                max-width: none;
                justify-content: space-between;
                gap: 0;
            }
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
        <h1 class="header-title">
            @if (isset($searchTerm) && !empty($searchTerm))
                Hasil untuk "{{ $searchTerm }}"
            @else
                Jelajahi Menu
            @endif
        </h1>
    </div>

    <!-- Menu Content -->
    <div class="menu-content" id="menuContent">
        <!-- Menu items will be dynamically loaded here -->
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
    <script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.min.js"></script>
    <script>
        // Data produk (sama seperti di menu.html, pastikan konsisten)
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

        const searchSynonymsMap = {
            // Kategori
            "signature dishes": "Signature Dishes",
            "hidangan utama": "Signature Dishes",
            "signature rice": "Signature Rice",
            "nasi": "Signature Rice",
            "rice": "Signature Rice",
            "makanan pembuka": "Bite & Start",
            "cemilan": "Bite & Start",
            "appetizer": "Bite & Start",
            "starter": "Bite & Start",
            "snack": "Bite & Start",
            "burger": "Burgers & Sandwiches",
            "sandwich": "Burgers & Sandwiches",
            "roti lapis": "Burgers & Sandwiches",
            "sup": "Soups & Broths",
            "soup": "Soups & Broths",
            "kaldu": "Soups & Broths",
            "kuah": "Soups & Broths",
            "pasta": "Pasta & Noodles",
            "mie": "Pasta & Noodles",
            "noodles": "Pasta & Noodles",
            "panggang": "Grilled Specialties",
            "grilled": "Grilled Specialties",
            "bakar": "Grilled Specialties",
            "pencuci mulut": "Sweet Endings",
            "dessert": "Sweet Endings",
            "manis": "Sweet Endings",
            "new menu": "New Menu",
            "menu baru": "New Menu",
            "baru": "New Menu",
            "minuman": "All Drinks",
            "minuman segar": "Mocktail",
            "cocktail non alkohol": "Mocktail",
            "susu": "Milk House",
            "jus": "Juices",
            "juice": "Juices",
            "minuman ringan": "Soft Drink",
            "kopi": "Coffee, Traditional & Tea",
            "coffee": "Coffee, Traditional & Tea",
            "teh": "Coffee, Traditional & Tea",
            "tea": "Coffee, Traditional & Tea",
            "wedang": "Coffee, Traditional & Tea",
            "minuman tradisional": "Coffee, Traditional & Tea",

            // Kata Kunci Umum Makanan
            "soto": "Soto Santan",
            "timbel": "Timbel Rice",
            "steak": "Tenderloin Steak",
            "ayam": "Chicken Steak",
            "sate": "Sate Maranggi",
            "cikur": "Cikur Rice",
            "fries": "Cheese Fries",
            "kentang": "Cheese Fries",
            "salad": "Imperial Caesar Salad",
            "sayap": "BBQ Chicken Wings",
            "wings": "BBQ Chicken Wings",
            "bebek": "Duck Aglio Olio Sambal Matah",
            "duck": "Duck Aglio Olio Sambal Matah",
            "kwetiau": "Pad Thai",
            "mie goreng": "Chicken Fried Noodle",
            "soto ayam": "Soto Ayam Madura",
            "iga": "Beef Ribs Soup",
            "ribs": "Beef Ribs Soup",
            "tomyum": "Tom Yum Soup",
            "tom yum": "Tom Yum Soup",
            "buntut": "Horison Oxtail Soup",
            "oxtail": "Horison Oxtail Soup",
            "nasi goreng": "Horison Fried Rice",
            "fried rice": "Horison Fried Rice",
            "rawon": "Rawon Fried Rice",
            "burger": "Basil Burger's",
            "hamburger": "Basil Burger's",
            "fish and chips": "Fish And Chips",
            "ikan": "Fish And Chips",
            "club sandwich": "Club Sandwiches",
            "bebek goreng": "Aromatic Fried Duck",
            "pisang": "Fried Banana Fritters",
            "banana": "Fried Banana Fritters",
            "colenak": "Colenak",
            "ramen": "Soto Ramen Fusion",
            "hotpot": "Tom Yum Seafood Hotpot",
            "sampler": "Horison Sampler Platter",
            "nasi liwet": "Nasi Liwet Risotto",

            // Kata Kunci Umum Minuman
            "mojito": "Virgin Mojito",
            "milkshakes": "Milkshakes",
            "smoothies": "Vanilla Smoothies",
            "cokelat": "Hot Chocolate",
            "chocolate": "Hot Chocolate",
            "squash": "Your Own Squash",
            "jus jeruk": "Fresh Orange Juice",
            "mineral water": "Mineral Water",
            "air mineral": "Mineral Water",
            "air": "Mineral Water",
            "wedang jahe": "Wedang Jahe",
            "bajigur": "Wedang Bajigur",
            "bandrek": "Wedang Bandrek",
            "espresso": "Espresso",
            "doppio": "Doppio",
            "caramel macchiato": "Caramel Macchiato",
            "affogato": "Vanilla Affogato",
            "cappuccino": "Cappuccino",
            "latte": "Cafe Latte",
            "avocado coffee": "Avocado Coffee",
            "barista": "Barista Recommendation",

            // Typo
            "chiken": "Chicken Steak",
            "chickn": "Chicken Steak",
            "sate ayam": "Grilled Chicken Satay",
            "soto santan": "Soto Santan",
            "timbel": "Timbel Rice",
            "frie": "Cheese Fries",
            "frise": "Cheese Fries",
            "noodels": "Chicken Fried Noodle",
            "sandwitch": "Club Sandwiches",
            "sandwichs": "Club Sandwiches",
            "basil burger's": "Basil Burger's",
            "fish & chips": "Fish And Chips",
            "pisangg": "Fried Banana Fritters",
            "banana fried": "Fried Banana Fritters",
            "hotpot seafood": "Tom Yum Seafood Hotpot",
            "kopi hitam": "Black Coffee",
            "espress": "Espresso",
            "capucino": "Cappuccino",
            "latte": "Cafe Latte",
            "avocado": "Avocado Coffee",
            "caramel": "Caramel Macchiato",
            "pisang goreng": "Fried Banana Fritters",
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
        const menuContent = document.getElementById('menuContent');

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
            // Trigger event storage untuk memberitahu halaman lain (misal index.html)
            window.dispatchEvent(new Event('storage'));
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

        // Fungsi untuk membuat elemen menu item
        function createMenuItemElement(product) {
            const menuItem = document.createElement('div');
            menuItem.classList.add('menu-item');
            menuItem.setAttribute('data-id', product.id); // Menggunakan product.id

            const isAvailable = product.isAvailable;
            const buttonText = isAvailable ? 'Tambah ke Keranjang' : 'Stok habis';
            const buttonDisabled = !isAvailable ? 'disabled' : '';
            const buttonStyle = !isAvailable ? 'opacity: 0.6; cursor: not-allowed; background-color: #95a5a6;' : '';

            menuItem.innerHTML = `
                <div class="menu-image">
                    <img src="${product.image}" alt="${product.title}" />
                </div>
                <div class="menu-info">
                    <h3 class="menu-title">${product.title}</h3>
                    <p class="menu-description">${product.description}</p>
                    <p class="menu-price">IDR ${product.price.toLocaleString('id-ID')}</p>
                    <button class="add-btn" ${buttonDisabled} style="${buttonStyle}">${buttonText}</button>
                    <div class="quantity-selector-inline" style="display: none;">
                        <button class="quantity-btn decrease-btn-inline">-</button>
                        <span class="quantity-value-inline">1</span>
                        <button class="quantity-btn increase-btn-inline">+</button>
                    </div>
                </div>
            `;

            // Attach event listeners for the new elements
            const addBtn = menuItem.querySelector('.add-btn');
            if (addBtn && !addBtn.disabled) {
                addBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const productId = e.target.closest('.menu-item').getAttribute('data-id');
                    updateCartItem(
                        productId,
                        (cart.find(item => item.productId == productId)?.quantity || 0) + 1
                    );

                    addBtn.textContent = 'Ditambahkan!';
                    addBtn.style.background = '#2ecc71';
                    addBtn.style.color = '#fff';

                    setTimeout(() => {
                        updateMenuItemDisplay(productId);
                    }, 500);
                });
            }
            const decreaseBtnInline = menuItem.querySelector('.decrease-btn-inline');
            const increaseBtnInline = menuItem.querySelector('.increase-btn-inline');
            const quantityValueInline = menuItem.querySelector('.quantity-value-inline');

            if (decreaseBtnInline && increaseBtnInline && quantityValueInline) {
                decreaseBtnInline.addEventListener('click', (e) => {
                    e.stopPropagation();
                    let currentQty = parseInt(quantityValueInline.textContent);
                    if (currentQty > 0) {
                        currentQty--;
                        updateCartItem(product.id, currentQty);
                    }
                });

                increaseBtnInline.addEventListener('click', (e) => {
                    e.stopPropagation();
                    let currentQty = parseInt(quantityValueInline.textContent);
                    currentQty++;
                    updateCartItem(product.id, currentQty);
                });
            }

            menuItem.addEventListener('click', (e) => {
                if (!e.target.classList.contains('add-btn') &&
                    !e.target.classList.contains('quantity-btn') &&
                    !e.target.closest('.quantity-selector-inline')) {
                    const productId = menuItem.getAttribute('data-id');
                    showProductDetail(productId);
                }
            });

            return menuItem;
        }

        // Fungsi untuk merender daftar menu
        function renderMenuItems(filteredProducts) {
            menuContent.innerHTML = ''; // Clear existing items
            if (filteredProducts.length === 0) {
                menuContent.innerHTML =
                    '<p style="text-align: center; margin-top: 20px; color: #666;">Tidak ada menu yang ditemukan.</p>';
                return;
            }
            filteredProducts.forEach(product => {
                menuContent.appendChild(createMenuItemElement(product));
                updateMenuItemDisplay(product.id); // Update display based on cart
            });
        }

        // --- Fuzzy Search Logic for menu.html ---
        const productList = Object.keys(products).map(id => ({
            id: id,
            ...products[id]
        }));

        const fuseOptions = {
            keys: ['title', 'description', 'category'],
            threshold: 0.3, // Adjust this value for more or less strict matching (0 = exact, 1 = fuzzy)
            ignoreLocation: true,
            distance: 100,
        };

        const fuse = new Fuse(productList, fuseOptions);

        function performSearchAndRender(searchTerm) {
            if (searchTerm) {
                const mappedCategory = mapSearchTermToCategory(searchTerm);
                if (mappedCategory) {
                    // Filter produk berdasarkan kategori yang dipetakan
                    const filteredByCategory = productList.filter(p =>
                        p.category === mappedCategory ||
                        (p.categorySynonyms && p.categorySynonyms.includes(mappedCategory.toLowerCase()))
                    );
                    renderMenuItems(filteredByCategory);
                } else {
                    // Jika tidak ada mapping kategori, lakukan pencarian fuzzy biasa
                    const result = fuse.search(searchTerm);
                    const filtered = result.map(item => item.item);
                    renderMenuItems(filtered);
                }
            } else {
                renderMenuItems(productList);
            }
        }

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

        // Event listener untuk tombol Checkout di cart summary
        cartSummary.addEventListener('click', () => {
            // Data keranjang sudah disimpan secara otomatis oleh updateCartItem
            window.location.href = '{{ route("checkout") }}'; // Arahkan ke halaman checkout
        });

        // Inisialisasi tampilan keranjang dan item menu saat halaman dimuat
        function initializePage() {
            updateCartSummary();
            // Render menu items (already filtered from backend if search parameter exists)
            renderMenuItems(productList);
        }

        function mapSearchTermToCategory(searchTerm) {
            const lowerTerm = searchTerm.toLowerCase();
            for (const key in searchSynonymsMap) {
                if (lowerTerm.includes(key)) {
                    return searchSynonymsMap[key];
                }
            }
            return null;
        }

        document.addEventListener('DOMContentLoaded', initializePage);
        // Tambahkan event listener untuk storage agar update otomatis jika ada perubahan di tab lain
        window.addEventListener('storage', updateCartSummary);
    </script>
@endpush
