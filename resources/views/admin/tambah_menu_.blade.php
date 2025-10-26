<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Menu Baru</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    </head>

    <body>
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
            <div class="form-section">
                <form id="menuForm">
                    <input type="text" class="form-field name-field" placeholder="Nama menu" id="menuName" required>

                    <textarea class="form-field description-field" placeholder="Deskripsi menu" id="menuDescription" required></textarea>

                    <input type="text" class="form-field price-field" placeholder="Harga menu" id="menuPrice"
                        required>

                    <!-- New: Image Input -->
                    <input type="file" class="form-field" id="menuImage" accept="image/*">
                </form>
            </div>

            <!-- Category Section -->
            <div class="category-section">
                <h2 class="category-label">Kategori</h2>

                <div class="category-buttons">
                    <button type="button" class="category-button"
                        onclick="selectCategory(this, 'makanan')">Makanan</button>
                    <button type="button" class="category-button"
                        onclick="selectCategory(this, 'minuman')">Minuman</button>
                    <button type="button" class="category-button" onclick="selectCategory(this, 'new-menu')">New
                        Menu</button>
                </div>
            </div>

            <!-- Subcategory Section (Minuman) -->
            <div class="subcategory-section" id="subcategory-minuman">
                <h3 class="subcategory-label">Kategori lanjutan</h3>

                <div class="subcategory-buttons">
                    <button type="button" class="subcategory-button active"
                        onclick="selectSubcategory(this, 'mocktail')">Mocktail</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'milkhouse')">Milk House</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'squash')">Squash</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'juices')">Juices</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'softdrink')">Soft Drink</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'coffee-tea')">Coffee, Tradisional & Tea</button>
                    <!-- Removed: Add new subcategory button -->
                </div>
            </div>

            <!-- Subcategory Section (Makanan) -->
            <div class="subcategory-section" id="subcategory-makanan">
                <h3 class="subcategory-label">Kategori lanjutan</h3>

                <div class="subcategory-buttons">
                    <button type="button" class="subcategory-button active"
                        onclick="selectSubcategory(this, 'signaturedishes')">Signature Dishes</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'bite-start')">Bite & Start</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'pasta')">Pasta</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'soup')">Soup</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'rice')">Rice</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'sandwiches')">Sandwiches</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'grilled')">Grilled</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'dessert')">Dessert</button>
                    <!-- Removed: Add new subcategory button -->
                </div>
            </div>

            <!-- Subcategory Section (New Menu) -->
            <div class="subcategory-section" id="subcategory-new-menu">
                <h3 class="subcategory-label">Kategori lanjutan</h3>

                <div class="subcategory-buttons">
                    <button type="button" class="subcategory-button active"
                        onclick="selectSubcategory(this, 'makanan')">Makanan</button>
                    <button type="button" class="subcategory-button"
                        onclick="selectSubcategory(this, 'minuman')">Minuman</button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="button" class="action-button tambah-button" onclick="submitForm()">Tambah</button>
                <button type="button" class="action-button cancel-button" onclick="cancelForm()">Cancel</button>
            </div>
        </div>

        <script>
            let selectedCategory = null;
            let selectedSubcategory = null;

            function goBack() {
                // Kembali ke halaman sebelumnya berdasarkan kategori yang dipilih
                const urlParams = new URLSearchParams(window.location.search);
                const from = urlParams.get('from');

                switch (from) {
                    case 'makanan':
                        window.location.href = 'makanan.php';
                        break;
                    case 'minuman':
                        window.location.href = 'minuman.php';
                        break;
                    case 'new-menu':
                        window.location.href = 'new-menu.php';
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
                // Remove active class from all category buttons
                const categoryButtons = document.querySelectorAll('.category-button');
                categoryButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to clicked button
                button.classList.add('active');
                selectedCategory = category;

                // Hide all subcategory sections
                const subcategorySections = document.querySelectorAll('.subcategory-section');
                subcategorySections.forEach(section => {
                    section.classList.remove('show');
                });

                // Show relevant subcategory section and set default subcategory
                if (category === 'minuman') {
                    document.getElementById('subcategory-minuman').classList.add('show');
                    selectedSubcategory = 'mocktail'; // Default for minuman

                    // Reset active states in minuman subcategories
                    const minumanButtons = document.querySelectorAll('#subcategory-minuman .subcategory-button');
                    minumanButtons.forEach(btn => btn.classList.remove('active'));
                    minumanButtons[0].classList.add('active'); // Set first button as active

                } else if (category === 'makanan') {
                    document.getElementById('subcategory-makanan').classList.add('show');
                    selectedSubcategory = 'signaturedishes'; // Default for makanan (changed from 'signature')

                    // Reset active states in makanan subcategories
                    const makananButtons = document.querySelectorAll('#subcategory-makanan .subcategory-button');
                    makananButtons.forEach(btn => btn.classList.remove('active'));
                    makananButtons[0].classList.add('active'); // Set first button (Signature) as active

                } else if (category === 'new-menu') {
                    document.getElementById('subcategory-new-menu').classList.add('show');
                    selectedSubcategory = 'makanan'; // Default for new-menu

                    // Reset active states in new-menu subcategories
                    const newMenuButtons = document.querySelectorAll('#subcategory-new-menu .subcategory-button');
                    newMenuButtons.forEach(btn => btn.classList.remove('active'));
                    newMenuButtons[0].classList.add('active'); // Set first button (Makanan) as active

                } else {
                    selectedSubcategory = null;
                }
            }

            function selectSubcategory(button, subcategory) {
                // Get the parent subcategory section
                const parentSection = button.closest('.subcategory-section');

                // Remove active class from all subcategory buttons in the same section
                const subcategoryButtons = parentSection.querySelectorAll('.subcategory-button');
                subcategoryButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to clicked button
                button.classList.add('active');
                selectedSubcategory = subcategory;
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
                        window.location.href = 'makanan.php';
                        break;
                    case 'minuman':
                        window.location.href = 'minuman.php';
                        break;
                    case 'new-menu':
                        window.location.href = 'new-menu.php';
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
                            window.location.href = 'makanan.php';
                            break;
                        case 'minuman':
                            window.location.href = 'minuman.php';
                            break;
                        case 'new-menu':
                            window.location.href = 'new-menu.php';
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
                    const categoryButton = Array.from(document.querySelectorAll('.category-button'))
                        .find(btn => btn.textContent.toLowerCase().includes(from.toLowerCase()) ||
                            (from === 'new-menu' && btn.textContent.includes('New Menu')));

                    if (categoryButton) {
                        selectCategory(categoryButton, from);
                    }
                }
            });
        </script>
    </body>

</html>
