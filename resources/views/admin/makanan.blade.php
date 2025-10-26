@extends("layouts.admin")

@section("title", "Dashboard")

@push("styles")
    <style>
        /* Main Content */
        .header-section {
            margin-bottom: 40px;
        }

        .header-section h1 {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .header-section .breadcrumb {
            font-size: 16px;
            color: #7f8c8d;
            font-weight: 500;
        }

        .breadcrumb a {
            color: #a58857;
            text-decoration: none;
            cursor: pointer;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .add-menu-btn {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Inter', Arial, sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.2);
        }

        .add-menu-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.3);
            background: linear-gradient(135deg, #229954, #27ae60);
        }

        .add-icon {
            width: 20px;
            height: 20px;
        }

        /* Category Navigation */
        .category-nav {
            background-color: #f8f9fa;
            border-radius: 50px;
            padding: 8px;
            margin-bottom: 40px;
            position: relative;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: fit-content;
            min-width: 600px;
        }

        .nav-indicator {
            position: absolute;
            background: linear-gradient(135deg, #a58857, #c9a876);
            border-radius: 50px;
            height: 44px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(165, 136, 87, 0.3);
            z-index: 1;
        }

        .nav-item {
            padding: 12px 28px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Inter', Arial, sans-serif;
            border: none;
            background: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            color: #2c3e50;
            border-radius: 50px;
            min-width: 120px;
            text-align: center;
        }

        .nav-item:hover {
            transform: translateY(-1px);
        }

        .nav-item.active {
            color: #ffffff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Content Grid */
        .content-section {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            min-height: 500px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Responsive adjustments for modal */
        @media (max-width: 500px) {
            .modal-content {
                padding: 20px;
                max-width: 320px;
            }

            .modal-header h3 {
                font-size: 20px;
            }

            .modal-body p {
                font-size: 14px;
            }

            .modal-button {
                padding: 8px 15px;
                font-size: 14px;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 1400px) {
            .sidebar {
                width: 350px;
            }

            .sidebar-overlay {
                width: 40px;
            }

            .kategori-section,
            .pengguna-section {
                width: 310px;
            }

            .kategori-container {
                width: 310px;
            }

            .pengguna-container {
                width: 310px;
            }

            .kategori-button,
            .pengguna-button {
                width: 280px;
            }

            .logout-section {
                width: 350px;
            }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
                padding: 30px 40px;
            }

            .category-nav {
                min-width: 500px;
            }

            .menu-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .category-nav {
                min-width: 400px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-item {
                min-width: 100px;
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
@endpush

@section("content")
    <div class="header-section">
        <h1>Kategori Makanan</h1>
        <div class="breadcrumb">
            <a onclick="goToDashboard()">Dashboard</a> > Makanan
        </div>
        <button class="add-menu-btn" type="button">
            <svg class="add-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <a style="text-decoration: none; color: inherit;" href="{{ route("admin.tambah_menu") }}?from=makanan">Tambah
                Daftar Menu</a>
        </button>
    </div>

    <!-- Category Navigation -->
    <div class="category-nav">
        <div class="nav-indicator" id="navIndicator"></div>
        <button class="nav-item active" onclick="switchMenuCategory('signaturedishes', this)"
            data-category="signaturedishes">
            Signature Dishes
        </button>
        <button class="nav-item" onclick="switchMenuCategory('bite-start', this)" data-category="bite-start">
            Bite & Start
        </button>
        <button class="nav-item" onclick="switchMenuCategory('pasta', this)" data-category="pasta">
            Pasta
        </button>
        <button class="nav-item" onclick="switchMenuCategory('soup', this)" data-category="soup">
            Soup
        </button>
        <button class="nav-item" onclick="switchMenuCategory('rice', this)" data-category="rice">
            Rice
        </button>
        <button class="nav-item" onclick="switchMenuCategory('sandwiches', this)" data-category="sandwiches">
            Sandwiches
        </button>
        <button class="nav-item" onclick="switchMenuCategory('grilled', this)" data-category="grilled">
            Grilled
        </button>
        <button class="nav-item" onclick="switchMenuCategory('dessert', this)" data-category="dessert">
            Dessert
        </button>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <h2 class="section-title" id="sectionTitle">Signature Dishes</h2>
        <div id="menuGrid" class="menu-grid">
            @include("admin.partials.menu_cards", ["menu_data" => $menu_data])
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        function switchMenuCategory(category, element) {
            // Remove active class from all nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Add active class to clicked item
            element.classList.add('active');

            // Move indicator
            const indicator = document.getElementById('navIndicator');
            const rect = element.getBoundingClientRect();
            const parentRect = element.parentElement.getBoundingClientRect();

            indicator.style.width = rect.width + 'px';
            indicator.style.left = (rect.left - parentRect.left) + 'px';

            // Update section title
            const titles = {
                'signaturedishes': 'Signature Dishes',
                'bite-start': 'Bite & Start',
                'pasta': 'Pasta & Noodles',
                'soup': 'Soups & Broths',
                'rice': 'Signature Rice',
                'sandwiches': 'Burgers & Sandwiches',
                'grilled': 'Grilled Specialties',
                'dessert': 'Sweet Endings',
            };

            document.getElementById('sectionTitle').textContent = titles[category];

            // Load menu data via AJAX
            loadMenuData(titles[category]);
        }

        function loadMenuData(category) {
            const container = document.getElementById('menuGrid');

            // Show loading indicator
            container.innerHTML = '<p class="text-center text-muted">Loading...</p>';

            fetch(`/admin/menu/filter/makanan/${category}`)
                .then(response => response.text())
                .then(html => {
                    container.innerHTML = html;
                })
                .catch(error => {
                    console.error(error);
                    container.innerHTML = '<p class="text-danger text-center">Failed to load menu data.</p>';
                });
        }

        function initializeNavIndicator() {
            const activeNav = document.querySelector('.nav-item.active');
            const indicator = document.getElementById('navIndicator');

            if (activeNav && indicator) {
                const rect = activeNav.getBoundingClientRect();
                const parentRect = activeNav.parentElement.getBoundingClientRect();

                indicator.style.width = rect.width + 'px';
                indicator.style.left = (rect.left - parentRect.left) + 'px';
            }
        }

        function showUserMenu() {
            const userMenuOptions = confirm('Menu User:\n\nKlik OK untuk Profile & Pengaturan\nKlik Cancel untuk kembali');
            if (userMenuOptions) {
                alert('Fitur Profile & Pengaturan akan dibuat selanjutnya...');
            }
        }

        // Initialize page - PERBAIKAN UTAMA ADA DI SINI
        window.addEventListener('load', function() {
            // Initialize UI components
            initializeNavIndicator();

            // Add entrance animation
            const mainContent = document.querySelector('.main-content');
            if (mainContent) {
                mainContent.style.opacity = '0';
                mainContent.style.transform = 'translateY(20px)';
                mainContent.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    mainContent.style.opacity = '1';
                    mainContent.style.transform = 'translateY(0)';
                }, 200);
            }

            console.log('Page initialization complete');
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            initializeNavIndicator();
        });

        // Smooth hover effects for buttons
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.kategori-button, .pengguna-button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = '#96794d';
                        this.style.transform = 'translateX(3px)';
                    }
                });

                button.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = '#a58857';
                        this.style.transform = 'translateX(0)';
                    }
                });
            });
        });
    </script>
@endpush
