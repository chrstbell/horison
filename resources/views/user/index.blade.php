@extends("layouts.home")

@section("title", "HORISON Hotels")

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

        /* Hero Section */
        .hero-section {
            background: url('{{ asset("images/cover.png") }}');
            background-size: 100% auto;
            /* Lebar 80%, tinggi menyesuaikan */
            background-position: center;
            background-repeat: no-repeat;
            height: 260px;
            position: relative;
            border-radius: 0 0 25px 25px;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        /* Search Section */
        .search-section {
            padding: 0 20px;
            display: flex;
            gap: 12px;
            margin-top: 30px;
            position: relative;
            z-index: 2;
        }

        .search-bar {
            flex: 1;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: none;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .search-bar:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .search-icon {
            width: 22px;
            height: 22px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="%23666"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>') no-repeat center;
            background-size: contain;
        }

        .search-input {
            border: none;
            background: transparent;
            flex: 1;
            font-size: 15px;
            outline: none;
            color: #333;
        }

        .filter-btn {
            background: linear-gradient(135deg, #D1AD71 0%, #D1AD71 100%);
            border: none;
            border-radius: 15px;
            padding: 12px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
        }

        .filter-icon {
            width: 20px;
            height: 20px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"><path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0 2c-6.627 0-12 5.373-12 12h24c0-6.627-5.373-12-12-12z"/></svg>') no-repeat center;
            background-size: contain;
        }

        /* New Menu Section */
        .new-menu-section {
            padding: 25px 20px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            position: relative;
            z-index: 2;
        }

        .new-menu-scroll {
            display: flex;
            gap: 16px;
            width: max-content;
        }

        .new-menu-label {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 25px 20px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.1;
            text-align: center;
            min-width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: perspective(1000px) rotateY(-5deg);
        }

        .menu-card {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid #FFD93D;
            border-radius: 12px;
            padding: 16px;
            min-width: 180px;
            display: flex;
            gap: 14px;
            align-items: center;
            box-shadow: 0 10px 30px rgba(255, 217, 61, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 40px rgba(255, 217, 61, 0.4);
        }

        .menu-card-img {
            width: 70px;
            height: 70px;
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
        }

        .menu-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 4px;
        }

        .menu-card-text {
            font-weight: 700;
            font-size: 14px;
            line-height: 1.3;
            color: #2c3e50;
        }

        /* Category Section */
        .category-section {
            padding: 20px 20px 30px;
            margin-top: 15px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 780;
            color: #2c3e50;
            line-height: 1.3;
            flex: 1;
        }

        .view-all-btn {
            background: linear-gradient(135deg, #F9D291 0%, #F9D291 100%);
            border: none;
            border-radius: 25px;
            padding: 8px 18px;
            font-size: 12px;
            font-weight: 700;
            color: #766241;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.3);
            transition: all 0.3s ease;
        }

        .view-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .category-card {
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-img {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 12px;
            background: #f0f0f0;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: #999;
            text-align: center;
            line-height: 1.2;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            /* Tambahkan ini */
        }

        .category-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .category-card:hover .category-img {
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .category-name {
            font-size: 14px;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Chef's Choice Section */
        .chefs-choice {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            padding: 10px 20px;
            margin-top: 30px;
            position: relative;
        }

        .chefs-choice::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="g" cx="20" cy="20" r="20"><stop stop-color="white" stop-opacity=".1"/><stop offset="1" stop-color="white" stop-opacity="0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23g)"/></svg>') repeat;
            opacity: 0.1;
        }

        .chefs-title {
            color: white;
            font-size: 26px;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }

        .food-scroll {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .food-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            height: 300px;
            min-width: 100px;
            max-width: 230px;
            flex-shrink: 0;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .food-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .food-img {
            width: 100%;
            height: 150px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            color: #999;
            text-align: center;
            line-height: 1.2;
            overflow: hidden;
            /* Tambahkan ini */
        }

        .food-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .food-info {
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .food-name {
            font-size: 24px;
            font-weight: 700;
            margin-top: 1.5px;
            margin-bottom: 2px;
            color: #2c3e50;
        }

        .food-desc {
            font-size: 10px;
            color: #666;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .food-price {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #e74c3c;
        }

        .add-btn {
            background: transparent;
            border: 1.5px solid #2ecc71;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 12px;
            font-weight: 600;
            color: #2ecc71;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 7px;
            height: 28px;
            width: 100%;
            max-width: 200%;
        }

        .add-btn:hover {
            background: #2ecc71;
            color: white;
            transform: scale(1.05);
        }

        /* Quantity Selector for Food Card */
        .food-card .quantity-selector-inline {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 7px;
            width: 100%;
            max-width: 100%;
            /* Sesuaikan lebar agar pas di food-card */
            border: 1.5px solid #2ecc71;
            border-radius: 6px;
            /* Sesuaikan border-radius dengan add-btn */
            overflow: hidden;
            gap: 70px;
            /* Hapus gap agar tombol dan nilai menyatu */
        }

        .food-card .quantity-selector-inline .quantity-btn {
            width: 30px;
            height: 28px;
            /* Sesuaikan tinggi dengan add-btn */
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

        .food-card .quantity-selector-inline .quantity-btn:hover {
            background: #27ae60;
        }

        .food-card .quantity-selector-inline .quantity-value {
            flex-grow: 1;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            padding: 0 2px;
            min-width: 25px;
        }

        /* Make the whole card a column layout */
        .food-card {
            display: flex;
            flex-direction: column;
            height: 300px;
            /* keep your fixed height */
        }

        /* Keep image fixed, let info take the rest */
        .food-img {
            flex: 0 0 150px;
        }

        .food-info {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            min-height: 0;
            /* allow children to shrink */
        }

        /* Clamp texts so they don't grow the card */
        .food-name {
            font-size: 20px;
            /* a bit smaller for consistency */
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* up to 2 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .food-desc {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* up to 2 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Pin the Add button at the bottom */
        .add-btn {
            margin-top: auto;
            /* pushes it to bottom of .food-info */
            width: 100%;
            max-width: 100%;
            /* prevent overflow that caused wrapping */
            height: 32px;
        }

        /* Make quantity selector match the button space when shown */
        .food-card .quantity-selector-inline {
            display: none;
            /* default hidden as you had */
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
            width: 100%;
            border: 1.5px solid #2ecc71;
            border-radius: 6px;
            overflow: hidden;
            gap: 0;
            /* remove big gap that could force wrapping */
        }

        .food-card .quantity-selector-inline .quantity-btn {
            width: 32px;
            height: 32px;
        }

        .food-card .quantity-selector-inline .quantity-value-inline {
            flex: 1 1 auto;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            padding: 0 6px;
            min-width: 24px;
        }

        /* Optional: ensure cards don’t shrink too narrow in the scroller */
        .food-card {
            min-width: 200px;
            max-width: 230px;
        }

        /* Promotion Cards */
        .promotions {
            padding: 30px 20px;
        }

        .promo-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            margin-bottom: 25px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .promo-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .promo-img {
            width: 100%;
            height: 160px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #999;
            text-align: center;
            line-height: 1.2;
            overflow: hidden;
            /* Tambahkan ini */
        }

        .promo-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .promo-content {
            padding: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .promo-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .promo-subtitle {
            font-size: 13px;
            font-weight: 600;
            color: #7f8c8d;
            margin-bottom: 15px;
            flex: 1;
        }

        .terms-btn {
            background: linear-gradient(135deg, #F9D291 0%, #F9D291 100%);
            border: none;
            border-radius: 20px;
            padding: 8px 14px;
            font-size: 11px;
            font-weight: 600;
            color: #766241;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            transition: all 0.3s ease;
            align-self: flex-start;
            margin-top: auto;
        }

        .terms-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #D1AD71;
            border-radius: 30px;
            width: 90%;
            max-width: 390px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 0 25px;
            box-shadow: 0 15px 50px rgba(209, 173, 113, 0.4);
            backdrop-filter: blur(20px);
            z-index: 1000;
            /* Pastikan di atas elemen lain */
        }

        .nav-item {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 12px;
            border-radius: 50%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .nav-item.active {
            background: #766241;
        }

        .nav-item:hover {
            background: rgba(118, 98, 65, 0.7);
            transform: translateY(-3px) scale(1.1);
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .home-icon {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>');
        }

        .menu-icon {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"><path d="M8.1 13.34l2.83-2.83L3.91 3.5a4.008 4.008 0 0 0 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.2-1.1-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41L13.41 13l1.47-1.47z"/></svg>');
        }

        .order-icon {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>');
        }

        .star-icon {
            background-image: url('{{ asset("images/logo-h1.png") }}');
        }

        /* Desktop Responsive */
        @media (min-width: 768px) {
            .container {
                max-width: 480px;
                margin: 0 auto;
                box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
            }
        }

        /* Scrollbar styling */
        .food-scroll::-webkit-scrollbar,
        .new-menu-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .food-scroll::-webkit-scrollbar-track,
        .new-menu-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .food-scroll::-webkit-scrollbar-thumb,
        .new-menu-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        /* Animations */
        .category-card,
        .menu-card,
        .food-card,
        .promo-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cart Summary */
        .cart-summary {
            position: absolute;
            bottom: 75px;
            /* Sesuaikan dengan tinggi bottom-nav */
            left: 50%;
            transform: translateX(-50%);
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: flex;
            gap: 10px;
            /* Menambahkan gap antara elemen di cart summary */
            align-items: center;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-in-out;
            z-index: 999;
            cursor: pointer;
            /* Menambahkan cursor pointer untuk menunjukkan bisa diklik */
        }

        .cart-summary.active {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-10px);
        }

        .cart-summary span {
            white-space: nowrap;
        }

        /* Modal (Pop-up) Styles - MODIFIED */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1001;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.7);
            /* Black w/ opacity */
            backdrop-filter: blur(5px);
            /* Blur background */
            -webkit-backdrop-filter: blur(5px);
            /* Safari support */
            justify-content: center;
            align-items: flex-end;
            /* Align to bottom */
            padding: 0;
            /* Remove padding from modal container */
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: #fefefe;
            border-radius: 20px 20px 0 0;
            /* Rounded top corners */
            width: 100%;
            max-width: 430px;
            /* Match container max-width */
            padding: 25px;
            position: relative;
            transform: translateY(100%);
            /* Start from bottom */
            opacity: 0;
            transition: all 0.4s ease;
            /* Smooth transition */
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.15);
            /* Shadow at top */
            max-height: 85vh;
            /* Max height for scrollable content */
            overflow-y: auto;
            /* Enable scroll if content overflows */
        }

        .modal.active .modal-content {
            transform: translateY(0);
            /* Slide up to position */
            opacity: 1;
        }

        .modal-content h2 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 22px;
            text-align: center;
        }

        .modal-content p {
            font-size: 14px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 10px;
        }

        .modal-content ul {
            margin-left: 20px;
            margin-bottom: 10px;
            color: #555;
            font-size: 14px;
        }

        .modal-content ul li {
            margin-bottom: 5px;
        }

        .close-button {
            color: #aaa;
            position: absolute;
            top: 15px;
            /* Adjusted position */
            right: 15px;
            /* Adjusted position */
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
            z-index: 10;
            /* Ensure it's above content */
        }

        .close-button:hover,
        .close-button:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }

        /* Removed @keyframes zoomIn as it's replaced by translateY transition */
    </style>
@endpush

@section("content")
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay"></div>

        <!-- Search Section -->
        <div class="search-section">
            <div class="search-bar">
                <div class="search-icon"></div>
                <input type="text" class="search-input" id="searchInput" placeholder="Search">
            </div>
            <button class="filter-btn">
                <div class="filter-icon"></div>
            </button>
        </div>

        <!-- New Menu Section -->
        <div class="new-menu-section">
            <div class="new-menu-scroll">
                <div class="new-menu-label">NEW<br>MENU</div>

                <div class="menu-card">
                    <div class="menu-card-img">
                        <img src="{{ asset("images/soto-ramen-fusion.png") }}" alt="Soto Ramen">
                    </div>
                    <div class="menu-card-text">Soto<br>Ramen<br>Fusion</div>
                </div>
                </a>

                <div class="menu-card">
                    <div class="menu-card-img">
                        <img src="{{ asset("images/tom-yum-hotpot.png") }}" alt="Tom Yum Hotpot">
                    </div>
                    <div class="menu-card-text">Tom Yum<br>Seafood<br>Hotpot</div>
                </div>
                </a>

                <div class="menu-card">
                    <div class="menu-card-img">
                        <img src="{{ asset("images/horison-sampler.png") }}" alt="Horison Sampler">
                    </div>
                    <div class="menu-card-text">Horison<br>Sampler<br>Platter</div>
                </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Category Section -->
    <div class="category-section">
        <div class="section-header">
            <div class="section-title">Aneka Kuliner Nusantara &<br>Internasional yang Menggugah Selera</div>
            <a style="text-decoration: none" class="view-all-btn" href="{{ route("kategori") }}">Lihat semua</a>
        </div>

        <div class="category-grid">

            <a href="{{ route("kategori_item", ["category" => "bite-start"]) }}" class="category-card">
                <div class="category-card">
                    <div class="category-img">
                        <img src="{{ asset("images/cheese-fries.png") }}">
                    </div>
                    <div class="category-name">Bite & Start</div>
                </div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "pasta"]) }}" class="category-card">
                <div class="category-card">
                    <div class="category-img">
                        <img src="{{ asset("images/duck-aglio-olio.png") }}">
                    </div>
                    <div class="category-name">Pasta & Noodles</div>
                </div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "rice"]) }}" class="category-card">
                <div class="category-card">
                    <div class="category-img">
                        <img src="{{ asset("images/beef-ribs-fried-rice.png") }}">
                    </div>
                    <div class="category-name">Signature Rice</div>
                </div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "sandwiches"]) }}" class="category-card">
                <div class="category-card">
                    <div class="category-img">
                        <img src="{{ asset("images/club-sandwiches.png") }}">
                    </div>
                    <div class="category-name">Burgers &<br>Sandwiches</div>
                </div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "sweet"]) }}" class="category-card">
                <div class="category-card">
                    <div class="category-img">
                        <img src="{{ asset("images/banana-fritters.png") }}">
                    </div>
                    <div class="category-name">Sweet Endings</div>
                </div>
            </a>

            <a href="{{ route("kategori_item", ["category" => "minuman"]) }}" class="category-card">
                <div class="category-card">
                    <div class="category-img">
                        <img src="{{ asset("images/minuman.png") }}">
                    </div>
                    <div class="category-name">Drinks</div>
                </div>
            </a>
        </div>
    </div>

    <!-- Chef's Choice Section -->
    <div class="chefs-choice">
        <div class="chefs-title">Chef's Choice</div>

        <div class="food-scroll">
            <div class="food-card" data-id="6">
                <div class="food-img">
                    <img src="{{ asset("images/chicken-steak.png") }}">
                </div>
                <div class="food-info">
                    <div class="food-name">Chicken Steak</div>
                    <div class="food-desc">Grilled chicken breast served with vegetables, french fries, and
                        barbeque sauce</div>
                    <div class="food-price">IDR 45.000</div>
                    <button class="add-btn">Tambah</button>
                    <div class="quantity-selector-inline" style="display: none;">
                        <button class="quantity-btn decrease-btn-inline">-</button>
                        <span class="quantity-value-inline">1</span>
                        <button class="quantity-btn increase-btn-inline">+</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-id="4">
                <div class="food-img">
                    <img src="{{ asset("images/tenderloin-steak.png") }}">
                </div>
                <div class="food-info">
                    <div class="food-name">Tenderloin Steak</div>
                    <div class="food-desc">Grilled tenderloin served with vegetables, french fries, and
                        barbeque sauce</div>
                    <div class="food-price">IDR 125.000</div>
                    <button class="add-btn">Tambah</button>
                    <div class="quantity-selector-inline" style="display: none;">
                        <button class="quantity-btn decrease-btn-inline">-</button>
                        <span class="quantity-value-inline">1</span>
                        <button class="quantity-btn increase-btn-inline">+</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-id="3">
                <div class="food-img">
                    <img src="{{ asset("images/timbel-rice.png") }}">
                </div>
                <div class="food-info">
                    <div class="food-name">Timbel Rice</div>
                    <div class="food-desc">Steamed rice wrapped up with banana leaves served with chicken and
                        fresh vegetables</div>
                    <div class="food-price">IDR 45.000</div>
                    <button class="add-btn">Tambah</button>
                    <div class="quantity-selector-inline" style="display: none;">
                        <button class="quantity-btn decrease-btn-inline">-</button>
                        <span class="quantity-value-inline">1</span>
                        <button class="quantity-btn increase-btn-inline">+</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-id="2">
                <div class="food-img">
                    <img src="{{ asset("images/soto-santan.png") }}">
                </div>
                <div class="food-info">
                    <div class="food-name">Soto Santan</div>
                    <div class="food-desc">Tasikmalaya chicken soup that are slowly simmered in a coconut milk
                        broth</div>
                    <div class="food-price">IDR 45.000</div>
                    <button class="add-btn">Tambah</button>
                    <div class="quantity-selector-inline" style="display: none;">
                        <button class="quantity-btn decrease-btn-inline">-</button>
                        <span class="quantity-value-inline">1</span>
                        <button class="quantity-btn increase-btn-inline">+</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-id="7">
                <div class="food-img">
                    <img src="{{ asset("images/cikur-rice.png") }}">
                </div>
                <div class="food-info">
                    <div class="food-name">Cikur Rice</div>
                    <div class="food-desc">Steamed Marinated Galangal Rice served with Chicken and Fresh Vegetables</div>
                    <div class="food-price">IDR 45.000</div>
                    <button class="add-btn">Tambah</button>
                    <div class="quantity-selector-inline" style="display: none;">
                        <button class="quantity-btn decrease-btn-inline">-</button>
                        <span class="quantity-value-inline">1</span>
                        <button class="quantity-btn increase-btn-inline">+</button>
                    </div>
                </div>
            </div>

            <div class="food-card" data-id="1">
                <div class="food-img">
                    <img src="{{ asset("images/sate-maranggi.png") }}">
                </div>
                <div class="food-info">
                    <div class="food-name">Sate Maranggi</div>
                    <div class="food-desc">One of traditional dish from West Java, Sweet & Savoury grill beef skewers served
                        with Sambal Gowang, Peanut Spicy Sauce, & Steam Rice  </div>
                    <div class="food-price">IDR 75.000</div>
                    <button class="add-btn">Tambah</button>
                    <div class="quantity-selector-inline" style="display: none;">
                        <button class="quantity-btn decrease-btn-inline">-</button>
                        <span class="quantity-value-inline">1</span>
                        <button class="quantity-btn increase-btn-inline">+</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Promotion Section -->
    <div class="promotions">
        @forelse($promo_data as $promo)
            <div class="promo-card">
                <div class="promo-img">
                    @if ($promo->image_path)
                        <img src="{{ asset($promo->image_path) }}" alt="{{ $promo->name }}">
                    @else
                        <div
                            style="background: #f0f0f0; height: 100%; display: flex; align-items: center; justify-content: center; color: #999;">
                            No Image</div>
                    @endif
                </div>
                <div class="promo-content">
                    <div class="promo-title">{{ strtoupper($promo->name) }}</div>
                    <div class="promo-subtitle">{{ $promo->description }}</div>
                    @if ($promo->tnc)
                        <button class="terms-btn" data-promo-id="{{ $promo->id }}"
                            data-promo-name="{{ $promo->name }}" data-promo-tnc="{{ $promo->tnc }}">Lihat syarat &
                            ketentuan</button>
                    @endif
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 40px; color: #999;">
                Belum ada promo tersedia saat ini.
            </div>
        @endforelse
    </div>

    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 id="modalTitle">Syarat & Ketentuan Promo</h2>
            <div id="modalContent">
                <!-- Content will be loaded here by JavaScript -->
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.min.js"></script>
    <script>
        const productRaw = {
            1: {
                title: "Soto Santan",
                price: 45000,
                description: "Tasikmalaya chicken soup that is slowly simmered in a coconut milk broth.",
                image: "{{ asset("images/soto-santan.png") }}",
                category: "Signature Dishes",
                categorySynonyms: ["soto santan", "soto ayam", "soto tasikmalaya", "soto", "hidangan utama", "kuah",
                    "soup", "santan"
                ],
                serveTime: "10-15 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            2: {
                title: "Timbel Rice",
                price: 45000,
                description: "Steamed rice wrapped in banana leaves, served with chicken and fresh vegetables.",
                image: "/image/timbel-rice.png",
                category: "Signature Dishes",
                categorySynonyms: ["timbel rice", "nasi timbel", "nasi", "rice", "hidangan utama", "nasi khas"],
                serveTime: "5-10 menit",
                spiceLevel: "Bisa disesuaikan"
            }
        }
        // Data produk (sama seperti di menu.html, pastikan konsisten)
        const products = {
            2: {
                title: "Soto Santan",
                price: 45000,
                description: "Tasikmalaya chicken soup that is slowly simmered in a coconut milk broth.",
                image: "{{ asset("images/soto-santan.png") }}",
                category: "Signature Dishes",
                categorySynonyms: ["soto santan", "soto ayam", "soto tasikmalaya", "soto", "hidangan utama", "kuah",
                    "soup", "santan"
                ],
                serveTime: "10-15 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            3: {
                title: "Timbel Rice",
                price: 45000,
                description: "Steamed rice wrapped in banana leaves, served with chicken and fresh vegetables.",
                image: "{{ asset("images/timbel-rice.png") }}",
                category: "Signature Dishes",
                categorySynonyms: ["timbel rice", "nasi timbel", "nasi", "rice", "hidangan utama", "nasi khas"],
                serveTime: "5-10 menit",
                spiceLevel: "Bisa disesuaikan"
            },
            4: {
                title: "Tenderloin Steak",
                price: 125000,
                description: "Grilled tenderloin served with vegetables, french fries, and barbeque sauce.",
                image: "{{ asset("images/tenderloin-steak.png") }}",
                category: "Signature Dishes",
                categorySynonyms: ["tenderloin steak", "steak", "hidangan utama", "tenderloin", "beef", "sapi",
                    "daging"
                ],
                serveTime: "20-25 menit",
                spiceLevel: "Tidak pedas"
            },
            6: {
                title: "Chicken Steak",
                price: 45000,
                description: "Grilled chicken served with vegetables, french fries, and barbeque sauce.",
                image: "{{ asset("images/chicken-steak.png") }}",
                category: "Signature Dishes",
                categorySynonyms: ["chicken steak", "steak", "hidangan utama", "ayam", "chicken"],
                serveTime: "15-20 menit",
                spiceLevel: "Tidak pedas"
            },

            7: {
                title: "Cikur Rice",
                price: 45000,
                description: "Steamed Marinated Galangal Rice served with Chicken and Fresh Vegetables",
                image: "{{ asset("images/cikur-rice.png") }}",
                category: "Signature Dishes",
                categorySynonyms: ["chicken steak", "steak", "hidangan utama", "ayam", "chicken"],
                serveTime: "15-20 menit",
                spiceLevel: "Tidak pedas"
            },
            1: {
                title: "Sate Maranggi",
                price: 75000,
                description: " One of traditional dish from West Java, Sweet & Savoury grill beef skewers served with Sambal Gowang, Peanut Spicy Sauce, & Steam Rice  ",
                image: "{{ asset("images/sate-maranggi.png") }}",
                category: "Signature Dishes",
                categorySynonyms: ["chicken steak", "steak", "hidangan utama", "ayam", "chicken"],
                serveTime: "15-20 menit",
                spiceLevel: "Tidak pedas"
            }
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
                console.log(cart);
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

        // --- Modal (Pop-up) Logic ---
        const termsModal = document.getElementById('termsModal');
        const closeButton = document.querySelector('.close-button');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
        const termsButtons = document.querySelectorAll('.terms-btn');

        termsButtons.forEach(button => {
            button.addEventListener('click', () => {
                const promoName = button.dataset.promoName;
                const promoTnc = button.dataset.promoTnc;

                if (promoName && promoTnc) {
                    modalTitle.textContent = `Syarat & Ketentuan ${promoName}`;
                    // Convert line breaks to paragraphs for better display
                    const formattedTnc = promoTnc.split('\n').filter(line => line.trim()).map(line =>
                        `<p>${line.trim()}</p>`).join('');
                    modalContent.innerHTML = formattedTnc;
                    termsModal.style.display = 'flex'; // Use flex to center content
                    termsModal.classList.add('active'); // Add active class for transition
                    document.body.style.overflow = 'hidden'; // Prevent body scroll
                }
            });
        });

        closeButton.addEventListener('click', () => {
            termsModal.classList.remove('active'); // Remove active class for transition
            // Delay hiding display until transition is complete
            termsModal.addEventListener('transitionend', function handler() {
                termsModal.style.display = 'none';
                termsModal.removeEventListener('transitionend', handler);
                document.body.style.overflow = ''; // Restore body scroll
            });
        });

        // Close the modal if user clicks outside of it
        window.addEventListener('click', (event) => {
            if (event.target == termsModal) {
                termsModal.classList.remove('active');
                termsModal.addEventListener('transitionend', function handler() {
                    termsModal.style.display = 'none';
                    termsModal.removeEventListener('transitionend', handler);
                    document.body.style.overflow = '';
                });
            }
        });

        // --- Search Logic - Redirect to Menu Page ---
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                const searchTerm = searchInput.value.trim();
                if (searchTerm) {
                    // Redirect to menu page with search query parameter
                    window.location.href = '{{ route("menu") }}?search=' + encodeURIComponent(searchTerm);
                }
            }
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
