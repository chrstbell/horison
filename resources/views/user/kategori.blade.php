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

        /* Header - Diperbarui agar konsisten dengan menu.html */
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
            stroke-width: 2.5;
            /* Ditambahkan untuk konsistensi */
        }

        .header-title {
            font-weight: 700;
            /* Tetap 700 seperti di menu.html */
            font-size: 20px;
            /* Diperbesar menjadi 25px seperti di menu.html */
            color: #333;
        }

        /* Category Section */
        .category-section {
            padding: 20px 20px 100px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .category-card {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.2s ease;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .category-img {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-bottom: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-name {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            /* Diubah kembali ke 700 untuk konsistensi */
            font-size: 13px;
            color: #333;
            text-align: center;
            line-height: 1.3;
            width: 90px;
        }

        /* Desktop Responsive */
        @media (min-width: 768px) {
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 30px;
            }

            .container {
                border-radius: 25px;
            }
        }

        /* Responsive untuk mobile kecil */
        @media (max-width: 430px) {
            .container {
                width: 100vw;
                max-width: none;
            }

            .bottom-nav {
                width: calc(100vw - 40px);
                max-width: 360px;
            }

            .category-grid {
                gap: 15px;
            }

            .category-img {
                width: 80px;
                height: 80px;
            }

            .category-name {
                width: 80px;
                font-size: 10px;
            }

            /* Header responsive */
            .header-title {
                font-size: 22px;
                /* Sedikit lebih kecil di mobile */
            }
        }

        /* Untuk layar sangat kecil */
        @media (max-width: 350px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .header-title {
                font-size: 20px;
                /* Lebih kecil untuk layar sangat kecil */
            }
        }
    </style>
@endpush

@section("content")
    <!-- Header Section - Diperbarui agar konsisten dengan menu.html -->
    <div class="header">
        <button class="back-btn" onclick="window.history.back()">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <div class="header-title">Aneka Kuliner yang Menggugah Selera</div>
    </div>
    <!-- Category Section -->
    <div class="category-section">
        <div class="category-grid">
            <!-- Row 1 -->
            <a href="{{ route("kategori_item", ["category" => "bite-start"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/cheese-fries.png") }}')"></div>
                <div class="category-name">Bite & Start</div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "pasta"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/duck-aglio-olio.png") }}')">
                </div>
                <div class="category-name">Pasta & Noodles</div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "soup"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/oxtail-soup.png") }}')"></div>
                <div class="category-name">Soups & Broths</div>
            </a>

            <!-- Row 2 -->
            <a href="{{ route("kategori_item", ["category" => "rice"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/beef-ribs-fried-rice.png") }}')">
                </div>
                <div class="category-name">Signature Rice</div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "sandwiches"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/club-sandwiches.png") }}')">
                </div>
                <div class="category-name">Burgers & Sandwiches</div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "grilled"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/grilled-chicken-satay.png") }}')">
                </div>
                <div class="category-name">Grilled Specialties</div>
            </a>

            <!-- Row 3 -->
            <a href="{{ route("kategori_item", ["category" => "signature"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/chicken-steak.png") }}')">
                </div>
                <div class="category-name">Signature Dishes</div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "sweet"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/banana-fritters.png") }}')">
                </div>
                <div class="category-name">Sweet Endings</div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "new_menu"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/soto-ramen-fusion.png") }}')">
                </div>
                <div class="category-name">New Menu!</div>
            </a>

            <!-- Row 4 -->
            <a href="{{ route("kategori_item", ["category" => "minuman"]) }}" class="category-card">
                <div class="category-img" style="background-image: url('{{ asset("images/minuman.png") }}')"></div>
                <div class="category-name">Drinks</div>
            </a>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        // Data produk (sama seperti di menu.html, pastikan konsisten)
        const products = {
            1: {
                title: "Soto Santan",
                price: 45000,
                description: "Tasikmalaya chicken soup that are slowly simmered in a coconut milk broth",
                image: "/image/soto-santan.png",
                category: "Signature Dishes",
                serveTime: "10-15 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            2: {
                title: "Timbel Rice",
                price: 45000,
                description: "Steamed rice wrapped up with banana leaves served with chicken and fresh vegetables",
                image: "/image/timbel-rice.png",
                category: "Signature Dishes",
                serveTime: "5-10 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            3: {
                title: "Tenderloin Steak",
                price: 125000,
                description: "Grilled tenderloin served with vegetables, french fries, and barbeque sauce",
                image: "/image/tenderloin-steak.png",
                category: "Signature Dishes",
                serveTime: "20-25 menit",
                spiceLevel: "Tidak pedas"
            },
            4: {
                title: "Chicken Steak",
                price: 45000,
                description: "Grilled chicken served with vegetables, french fries, and barbeque sauce",
                image: "/image/chicken-steak.png",
                category: "Signature Dishes",
                serveTime: "15-20 menit",
                spiceLevel: "Tidak pedas"
            },
            5: {
                title: "Sate Maranggi",
                price: 75000,
                description: "One of traditional dish from West Java, Sweet & Savoury grill beef skewers served with Sambal Gowang, Peanut Spicy Sauce, & Steam Rice",
                image: "/image/sate-maranggi.png",
                category: "Signature Dishes",
                serveTime: "15-20 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            6: {
                title: "Cikur Rice",
                price: 45000,
                description: "Steamed Marinated Galangal Rice served with Chicken and Fresh Vegetables",
                image: "/image/rice-cikur.png",
                category: "Signature Dishes",
                serveTime: "5-10 menit",
                spiceLevel: "Sedang"
            },
            7: {
                title: "Cheese Fries",
                price: 30000,
                description: "Fries potatoes served withmelted cheese sauce",
                image: "/image/cheese-fries.png",
                category: "Bite & Start",
                serveTime: "10-15 menit",
                spiceLevel: "Tidak Pedas"
            },
            8: {
                title: "Imperial Caesar Salad",
                price: 45000,
                description: "Romaine Lettuce, Grill Chicken, Grill Prawn served with Caesar Dressing.",
                image: "/image/caesar-salad.png",
                category: "Bite & Start",
                serveTime: "10-15 menit",
                spiceLevel: "Tidak pedas"
            },
            9: {
                title: "BBQ Chicken Wings",
                price: 30000,
                description: "Braised Chicken Wings and Homemade BBQ Sauce.",
                image: "/image/bbq-wings.png",
                category: "Bite & Start",
                serveTime: "10-15 menit",
                spiceLevel: "Sedang"
            },
            10: {
                title: "Duck Aglio Olio Sambal Matah",
                price: 55000,
                description: "Italian pasta cooked with traditional braised duck & Sambal Matah ",
                image: "/image/duck-aglio-olio.png",
                category: "Pasta & Noodles",
                serveTime: "15-20 menit",
                spiceLevel: "Pedas"
            },
            11: {
                title: "Pad Thai",
                price: 50000,
                description: "Thai Kwetiau cooked with hot paste Thailand spices & Local Prawn",
                image: "/image/pad-thai.png",
                category: "Pasta & Noodles",
                serveTime: "15-20 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            12: {
                title: "Chicken Fried Noodle",
                price: 45000,
                description: "Eggs noodles with Kampung spices & Seared Chicken Fillet on top",
                image: "/image/chicken-fried-noodle.png",
                category: "Pasta & Noodles",
                serveTime: "10-15 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            13: {
                title: "Soto Ayam Madura",
                price: 45000,
                description: "Traditional Chicken soup, Boiled Eggs, Chicken Shredded, Sambal, Kerupuk, & Steam Rice",
                image: "/image/soto-ayam-madura.png",
                category: "Soups & Broths",
                serveTime: "10-15 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            14: {
                title: "Beef Ribs Soup",
                price: 85000,
                description: "Traditional ribs cooked with local spice, served with sambal, emping, & Steam Rice",
                image: "/image/beef-ribs-soup.png",
                category: "Soups & Broths",
                serveTime: "15-20 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            15: {
                title: "Tom Yum Soup",
                price: 50000,
                description: "Spicy and Sour Shrimp Soup cook with Lemongrass and Coriander Flavour",
                image: "/image/tom-yum-soup.png",
                category: "Soups & Broths",
                serveTime: "10-15 menit",
                spiceLevel: "Sedang"
            },
            16: {
                title: "Soto Betawi",
                price: 50000,
                description: "Jakarta traditional beef soup, Coconut Milk Broth, Pickles, Sambal, Emping, & Steam Rice",
                image: "/image/soto-betawi.png",
                category: "Soups & Broths",
                serveTime: "10-15 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            17: {
                title: "Horison Oxtail Soup",
                price: 85000,
                description: "Traditional oxtail cooked with local spice, served with sambal, emping, & Steam Rice",
                image: "/image/oxtail-soup.png",
                category: "Soups & Broths",
                serveTime: "15-20 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            18: {
                title: "Beef Ribs Fried Rice",
                price: 60000,
                description: "Green chili paste, Beef Ribs served with Pickles, Sunny Side Up Eggs, & Emping",
                image: "/image/beef-ribs-fried-rice.png",
                category: "Signature Rice",
                serveTime: "15-20 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            19: {
                title: "Horison Fried Rice",
                price: 45000,
                description: "Indonesian Nasi Goreng served with Chicken Satay, Fried Chicken, Sunny Side Up Eggs, Pickles, & Prawn Crakers",
                image: "/image/horison-fried-rice.png",
                category: "Signature Rice",
                serveTime: "10-15 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            20: {
                title: "Rawon Fried Rice",
                price: 50000,
                description: "Javanese Rawon Paste with Beef Dice, Salted Eggs, Pickles, & Prawn Crackers",
                image: "/image/rawon-fried-rice.png",
                category: "Signature Rice",
                serveTime: "15-20 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            21: {
                title: "Basil Burger's",
                price: 50000,
                description: "Beef patties with onion rings, homemade BBQ Sauce, Coleslow served with Fries",
                image: "/image/basil-burger.png",
                category: "Burgers & Sandwiches",
                serveTime: "15-20 menit",
                spiceLevel: "Tidak pedas"
            },
            22: {
                title: "Fish And Chips",
                price: 40000,
                description: "Deep Fried Fish served with Tartar Sauce and French Fries",
                image: "/image/fish-and-chips.png",
                category: "Burgers & Sandwiches",
                serveTime: "10-15 menit",
                spiceLevel: "Tidak pedas"
            },
            23: {
                title: "Club Sandwiches",
                price: 50000,
                description: "Triple Deck Sandwiches, Grill Chicken, Eggs & Beef Ham Served with Fries",
                image: "/image/club-sandwiches.png",
                category: "Burgers & Sandwiches",
                serveTime: "10-15 menit",
                spiceLevel: "Tidak pedas"
            },
            24: {
                title: "Aromatic Fried Duck",
                price: 85000,
                description: "Braised local duck with local traditional paste spice, Traditional Madura chicken satay, Peanuts spice sauce, Pickles & Steam Rice served with Karedok & Steam Rice",
                image: "/image/aromatic-fried-duck.png",
                category: "Grilled Specialties",
                serveTime: "20-25 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            25: {
                title: "Grilled Chicken Satay",
                price: 50000,
                description: "Traditional Madura chicken satay, Peanuts spice sauce, Pickles & Steam Rice",
                image: "/image/grilled-chicken-satay.png",
                category: "Grilled Specialties",
                serveTime: "15-20 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            26: {
                title: "Colenak",
                price: 30000,
                description: "Grilled Fermented Cassava served with Brown Sugar Sauce",
                image: "/image/colenak.png",
                category: "Sweet Endings",
                serveTime: "5-10 menit",
                spiceLevel: "Tidak pedas"
            },
            27: {
                title: "Fried Banana Fritters",
                price: 30000,
                description: "Indonesian fried bananas, Condensed Milk, Cheese Shredded, Chocolate Sauce",
                image: "/image/banana-fritters.png",
                category: "Sweet Endings",
                serveTime: "5-10 menit",
                spiceLevel: "Tidak pedas"
            }
        };

        // Variabel untuk menyimpan item di keranjang
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Fungsi untuk menyimpan keranjang ke localStorage
        function saveCartToLocalStorage() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // JavaScript untuk navigasi
        const navItems = document.querySelectorAll('.nav-item');

        navItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                // Hapus class active dari semua item
                navItems.forEach(nav => nav.classList.remove('active'));
                // Tambahkan class active ke item yang diklik
                item.classList.add('active');
            });
        });

        // --- JavaScript untuk Cart Summary di index.html ---
        const cartSummary = document.getElementById('cartSummary');
        const cartItemCount = document.getElementById('cartItemCount');
        const cartTotalPrice = document.getElementById('cartTotalPrice');

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
                        title: product.title,
                        image: product.image
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
            updateFoodCardDisplay(productId); // Perbarui tampilan item di food-card
            // Trigger event storage untuk memberitahu halaman lain (misal menu.html)
            window.dispatchEvent(new Event('storage'));
        }

        // Fungsi untuk memperbarui tampilan item di food-card (tombol vs. input kuantitas)
        function updateFoodCardDisplay(productId) {
            const foodCard = document.querySelector(`.food-card[data-id="${productId}"]`);
            if (!foodCard) return;

            const addBtn = foodCard.querySelector('.add-btn');
            const quantitySelectorInline = foodCard.querySelector('.quantity-selector-inline');
            const quantityValueInline = foodCard.querySelector('.quantity-value-inline');

            const existingItem = cart.find(item => item.productId == productId);

            if (existingItem && existingItem.quantity > 0) {
                addBtn.style.display = 'none';
                quantitySelectorInline.style.display = 'flex';
                quantityValueInline.textContent = existingItem.quantity;
            } else {
                addBtn.style.display = 'block';
                quantitySelectorInline.style.display = 'none';
                addBtn.textContent = 'Tambah'; // Kembalikan teks tombol
                addBtn.style.background = 'transparent'; // Kembalikan warna tombol
                addBtn.style.color = '#2ecc71'; // Kembalikan warna teks
            }
        }

        // Event listener untuk tombol "Tambah" di food-card
        document.querySelectorAll('.food-card .add-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const productId = e.target.closest('.food-card').getAttribute('data-id');
                updateCartItem(productId, (cart.find(item => item.productId == productId)?.quantity || 0) +
                    1);

                // Feedback visual
                button.textContent = 'Ditambahkan!';
                button.style.background = '#2ecc71';
                button.style.color = '#fff';

                setTimeout(() => {
                    updateFoodCardDisplay(productId);
                }, 500);
            });
        });

        // Event listener untuk tombol kuantitas inline di food-card
        document.querySelectorAll('.food-card').forEach(foodCard => {
            const productId = foodCard.getAttribute('data-id');
            const decreaseBtnInline = foodCard.querySelector('.decrease-btn-inline');
            const increaseBtnInline = foodCard.querySelector('.increase-btn-inline');
            const quantityValueInline = foodCard.querySelector('.quantity-value-inline');

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
            window.location.href = '{{ route("checkout") }}'; // Arahkan ke halaman checkout
        });

        // Inisialisasi tampilan keranjang dan item menu saat halaman dimuat
        function initializePage() {
            updateCartSummary();
            document.querySelectorAll('.food-card').forEach(item => {
                const productId = item.getAttribute('data-id');
                updateFoodCardDisplay(productId);
            });
        }

        document.addEventListener('DOMContentLoaded', initializePage);
        // Tambahkan event listener untuk storage agar update otomatis jika ada perubahan di tab lain
        window.addEventListener('storage', updateCartSummary);
    </script>
@endpush
