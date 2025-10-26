@extends("layouts.admin_minimal")

@section("title", "Daftar Menu Baru")

@push("styles")
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            min-height: 100vh;
            overflow-x: auto;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 40px;
            position: relative;
            min-height: 100vh;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 60px;
        }

        .back-button {
            width: 50px;
            height: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
            border-radius: 8px;
            background-color: #f5f5f5;
        }

        .back-button:hover {
            transform: scale(1.05);
            background-color: #e9e9e9;
        }

        .back-button svg {
            width: 24px;
            height: 24px;
            stroke: #000000;
            stroke-width: 2;
        }

        .header-title {
            font-size: 32px;
            font-weight: 600;
            color: #000000;
            line-height: 1.2;
        }

        /* Form Fields */
        .form-section {
            margin-bottom: 60px;
        }

        .form-field {
            background-color: #f5f5f5;
            border-radius: 8px;
            padding: 16px 20px;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            color: #000000;
            outline: none;
            margin-bottom: 25px;
            transition: all 0.2s ease;
            width: 100%;
            max-width: 800px;
        }

        .form-field:focus {
            background-color: #e9e9e9;
            box-shadow: 0 0 0 2px rgba(209, 173, 113, 0.3);
        }

        .form-field::placeholder {
            color: #888888;
            opacity: 1;
        }

        .name-field,
        .description-field {
            width: 100%;
            max-width: 800px;
        }

        .description-field {
            height: 120px;
            resize: none;
            padding-top: 16px;
        }

        .menu-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
            max-width: 800px;
        }

        .form-row {
            width: 100%;
        }

        .price-row {
            display: flex;
        }

        .price-input-container {
            width: 250px;
        }

        /* Category Section */
        .category-section {
            margin-bottom: 35px;
        }

        .category-label {
            font-size: 24px;
            font-weight: 600;
            color: #000000;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .category-buttons {
            display: flex;
            gap: 20px;
            margin-bottom: 35px;
            flex-wrap: wrap;
        }

        .category-button {
            background-color: #f5f5f5;
            border: none;
            border-radius: 25px;
            width: 180px;
            height: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-weight: 500;
            color: #000000;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-button:hover {
            background-color: #e9e9e9;
        }

        .category-button.active {
            background-color: #d1ad71;
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(209, 173, 113, 0.3);
        }

        /* Subcategory Section */
        .subcategory-section {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .subcategory-section.show {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .subcategory-label {
            font-size: 24px;
            font-weight: 600;
            color: #000000;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .subcategory-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .subcategory-button {
            background-color: #f5f5f5;
            border: none;
            border-radius: 25px;
            height: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #000000;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .subcategory-button:hover {
            background-color: #e9e9e9;
        }

        .subcategory-button.active {
            background-color: #d1ad71;
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(209, 173, 113, 0.3);
        }

        .add-subcategory-button {
            background-color: #f5f5f5;
            border: none;
            border-radius: 25px;
            height: 50px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #000000;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 20px;
            min-width: 220px;
        }

        .add-subcategory-button:hover {
            background-color: #e9e9e9;
        }

        .add-subcategory-button svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            stroke-width: 2;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 30px;
            margin-top: 50px;
        }

        .action-button {
            height: 60px;
            width: 200px;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tambah-button {
            background-color: #2ecc71;
            color: #ffffff;
        }

        .tambah-button:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
        }

        .cancel-button {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .cancel-button:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 25px;
            }

            .header-title {
                font-size: 28px;
            }

            .category-buttons {
                gap: 12px;
            }

            .category-button {
                width: 150px;
                height: 45px;
                font-size: 16px;
            }

            .action-buttons {
                gap: 20px;
            }

            .action-button {
                height: 50px;
                width: 160px;
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .header {
                margin-bottom: 40px;
            }

            .header-title {
                font-size: 24px;
            }

            .form-field {
                font-size: 16px;
                padding: 14px 16px;
            }

            .category-buttons {
                justify-content: center;
            }

            .category-button {
                width: 140px;
                height: 40px;
                font-size: 14px;
            }

            .subcategory-buttons {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }

            .action-buttons {
                justify-content: center;
                flex-wrap: wrap;
            }

            .action-button {
                flex: 1;
                min-width: 140px;
            }

            @media (max-width: 768px) {
                .price-input-container {
                    width: 100%;
                }

                .price-field {
                    max-width: 100% !important;
                }
            }
        }
    </style>
@endpush

<div class="container">
    <!-- Header -->
    <div class="header">
        <div class="back-button" onclick="goBack()">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>
        <h1 class="header-title">Daftar menu baru</h1>
    </div>

    <!-- Form Section -->
    <form id="menuForm" method="POST" action="{{ route("admin.menus.store") }}" enctype="multipart/form-data">
        @csrf

        <div class="form-section">
            <input type="text" name="name" class="form-field name-field" placeholder="Nama menu" id="menuName"
                required>

            <textarea name="description" class="form-field description-field" placeholder="Deskripsi menu" id="menuDescription"
                required></textarea>

            <input type="text" name="price" class="form-field price-field" placeholder="Harga menu" id="menuPrice"
                required>

            <input type="file" name="imageUpload" class="form-field" id="image" accept="image/*">
        </div>

        <!-- Category Section -->
        <div class="category-section">
            <h2 class="category-label">Kategori</h2>

            <div class="category-buttons">
                <button type="button" class="category-button" data-category="makanan" data-id="1"
                    onclick="selectCategory(this, 'makanan')">Makanan</button>
                <button type="button" class="category-button" data-category="minuman" data-id="2"
                    onclick="selectCategory(this, 'minuman')">Minuman</button>
                <button type="button" class="category-button" data-category="new-menu" data-id="3"
                    onclick="selectCategory(this, 'new-menu')">New Menu</button>
            </div>
        </div>

        <!-- Subcategory Sections (hidden by default until category selected) -->
        <div class="subcategory-section" id="subcategory-minuman">
            <h3 class="subcategory-label">Kategori lanjutan</h3>
            <div class="subcategory-buttons">
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'mocktail')"
                    data-id="9">Mocktail</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'milkhouse')"
                    data-id="10">Milk
                    House</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'squash')"
                    data-id="11">Squash</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'juices')"
                    data-id="12">Juices</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'softdrink')"
                    data-id="13">Soft Drink</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'coffee-tea')"
                    data-id="14">Coffee, Tradisional & Tea</button>
            </div>
        </div>

        <div class="subcategory-section" id="subcategory-makanan">
            <h3 class="subcategory-label">Kategori lanjutan</h3>
            <div class="subcategory-buttons">
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'signaturedishes')"
                    data-id="1">Signature Dishes</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'bite-start')"
                    data-id="2">Bite &
                    Start</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'pasta')"
                    data-id="3">Pasta</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'soup')"
                    data-id="4">Soup</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'rice')"
                    data-id="5">Rice</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'sandwiches')"
                    data-id="6">Sandwiches</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'grilled')"
                    data-id="7">Grilled</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'dessert')"
                    data-id="8">Dessert</button>
            </div>
        </div>

        <div class="subcategory-section" id="subcategory-new-menu">
            <h3 class="subcategory-label">Kategori lanjutan</h3>
            <div class="subcategory-buttons">
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'makanan')"
                    data-id="15">Makanan</button>
                <button type="button" class="subcategory-button" onclick="selectSubcategory(this, 'minuman')"
                    data-id="16">Minuman</button>
            </div>
        </div>

        <!-- Hidden inputs to hold selected category & subcategory -->
        <input type="hidden" name="category_id" id="selectedCategory">
        <input type="hidden" name="subcategory_id" id="selectedSubcategory">

        {{-- Hidden input to store back url --}}
        <input type="hidden" name="from" id="from" value="makanan">

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button type="submit" class="action-button tambah-button">Tambah</button>
            <button type="button" class="action-button cancel-button" onclick="cancelForm()">Cancel</button>
        </div>
    </form>

</div>

@push("scripts")
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const from = urlParams.get('from');

        const fromField = document.getElementById('from')
        fromField.value = from

        const form = document.getElementById('menuForm');
        const hiddenCategory = document.getElementById('selectedCategory');
        const hiddenSubcategory = document.getElementById('selectedSubcategory');


        form.addEventListener('submit', (e) => {
            console.log('Before submit values:', {
                category_id: hiddenCategory.value,
                subcategory_id: hiddenSubcategory.value
            });
        });

        function goBack() {

            switch (from) {
                case 'makanan':
                    window.location.href = 'makanan';
                    break;
                case 'minuman':
                    window.location.href = 'minuman';
                    break;
                case 'new-menu':
                    window.location.href = 'new-menu';
                    break;
                default:
                    if (window.history.length > 1) {
                        window.history.back();
                    } else {
                        alert('Kembali ke halaman utama');
                    }
            }
        }

        function selectCategory(button, category) {
            // Remove active class from all
            document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Set hidden input
            hiddenCategory.value = button.dataset.id || category;

            // clear previous subcategory when switching category
            hiddenSubcategory.value = '';

            // Hide all subcategory sections
            document.querySelectorAll('.subcategory-section').forEach(sec => sec.style.display = 'none');

            // Show related subcategory section
            const section = document.getElementById('subcategory-' + category);
            if (section) section.style.display = 'block';
        }

        function selectSubcategory(button, subcategory) {
            // Remove active class from all subcategories in same section
            button.closest('.subcategory-buttons').querySelectorAll('.subcategory-button').forEach(btn => btn.classList
                .remove('active'));
            button.classList.add('active');

            // Set hidden input
            hiddenSubcategory.value = button.dataset.id || subcategory;
        }

        function submitForm() {
            const menuName = document.getElementById('menuName').value;
            const menuDescription = document.getElementById('menuDescription').value;
            const menuPrice = document.getElementById('menuPrice').value;
            const menuImageInput = document.getElementById('menuImage');
            const menuImageFile = menuImageInput.files[0]; // Get the selected file

            if (!menuName.trim() || !menuDescription.trim() || !menuPrice.trim()) {
                alert('Mohon lengkapi semua field!');
                return;
            }

            if (!selectedCategory) {
                alert('Silakan pilih kategori menu');
                return;
            }

            if (!selectedSubcategory) { // Tambahkan validasi subkategori
                alert('Silakan pilih subkategori menu');
                return;
            }

            // Read image file as Data URL
            let menuImageUrl = '';
            if (menuImageFile) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    menuImageUrl = e.target.result; // Data URL of the image
                    saveAndRedirect(menuName, menuDescription, menuPrice, menuImageUrl);
                };
                reader.readAsDataURL(menuImageFile);
            } else {
                saveAndRedirect(menuName, menuDescription, menuPrice, menuImageUrl);
            }
        }

        function saveAndRedirect(name, description, price, imageUrl) {
            const menuData = {
                name: name,
                description: description,
                price: price,
                category: selectedCategory,
                subcategory: selectedSubcategory,
                image: imageUrl, // Store the Data URL
                soldOut: false, // Default to not sold out
                isNew: true // Tandai sebagai menu baru
            };

            // Get existing data from localStorage or initialize empty array
            let storedData = JSON.parse(localStorage.getItem('newMenuItems')) || [];
            storedData.push(menuData);
            localStorage.setItem('newMenuItems', JSON.stringify(storedData));

            console.log('Menu data:', menuData);
            alert('Menu berhasil ditambahkan!\n\n' +
                `Nama: ${name}\n` +
                `Deskripsi: ${description}\n` +
                `Harga: ${price}\n` +
                `Kategori: ${selectedCategory}` +
                (selectedSubcategory ? `\nSubkategori: ${selectedSubcategory}` : ''));

            // Redirect back to appropriate page
            const urlParams = new URLSearchParams(window.location.search);
            const from = urlParams.get('from');

            switch (from) {
                case 'makanan':
                    window.location.href = 'makanan';
                    break;
                case 'minuman':
                    window.location.href = 'minuman';
                    break;
                case 'new-menu':
                    window.location.href = 'new-menu';
                    break;
                default:
                    // Reset form if staying on page
                    resetForm();
            }
        }

        function cancelForm() {
            if (confirm('Yakin ingin membatalkan? Data yang telah diisi akan hilang.')) {
                // Redirect back to appropriate page
                const urlParams = new URLSearchParams(window.location.search);
                const from = urlParams.get('from');

                switch (from) {
                    case 'makanan':
                        window.location.href = 'makanan';
                        break;
                    case 'minuman':
                        window.location.href = 'minuman';
                        break;
                    case 'new-menu':
                        window.location.href = 'new-menu';
                        break;
                    default:
                        resetForm();
                }
            }
        }

        function resetForm() {
            document.getElementById('menuForm').reset();
            selectedCategory = null;
            selectedSubcategory = null;

            // Remove all active classes
            document.querySelectorAll('.category-button, .subcategory-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Hide subcategory sections
            document.querySelectorAll('.subcategory-section').forEach(section => {
                section.classList.remove('show');
            });
        }

        // Price input formatting
        document.getElementById('menuPrice').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            if (value) {
                value = 'Rp ' + parseInt(value).toLocaleString('id-ID');
            }
            e.target.value = value;
        });

        // Auto-resize textarea
        const textarea = document.getElementById('menuDescription');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.max(120, this.scrollHeight) + 'px';
        });

        // Initialize page based on URL parameter
        window.addEventListener('load', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const from = urlParams.get('from');

            // Auto-select category based on 'from' parameter
            if (from) {
                const categoryButton = document.querySelector(`.category-button[data-category="${from}"]`);
                if (categoryButton) {
                    selectCategory(categoryButton, from);
                }
            }
        });
    </script>
@endpush
