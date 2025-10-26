<style>
    .sidebar {
        width: 350px;
        height: 100vh;
        background-color: #2c3e50;
        position: fixed;
        border-radius: 0 18px 18px 0;
        z-index: 1;
    }

    .sidebar-overlay {
        width: 40px;
        height: 100vh;
        background-color: #2c3e50;
        position: absolute;
        left: 0;
        top: 0;
        z-index: -1;
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
        display: block;
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

    .user-icon {
        width: 24px;
        height: 24px;
        color: #2c3e50;
    }

    .kategori-title,
    .pengguna-title {
        font-size: 20px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 20px;
    }

    .kategori-container,
    .pengguna-container {
        background-color: #ededed;
        border-radius: 8px;
        padding: 20px 15px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .kategori-link,
    .pengguna-link {
        display: block;
        width: 280px;
        height: 40px;
        line-height: 40px;
        background-color: #a58857;
        border-radius: 6px;
        color: #ededed;
        font-size: 16px;
        font-weight: bold;
        font-family: 'Inter', Arial, sans-serif;
        text-decoration: none;
        transition: all 0.2s;
        text-align: left;
        padding-left: 16px;
    }

    .kategori-link:hover,
    .pengguna-link:hover {
        background-color: #96794d;
        transform: translateX(3px);
    }

    .kategori-link.active,
    .pengguna-link.active {
        background-color: #96794d;
        transform: translateX(5px);
    }

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
        z-index: 3;
    }

    .logout-submit {
        width: 100%;
        height: 100%;
        background: transparent;
        border: 0;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s;
        padding: 0;
    }

    .logout-submit:hover {
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
</style>

<div class="sidebar">
    <div class="sidebar-overlay"></div>

    <div class="logo-section">
        <a href="{{ route("admin.dashboard") }}">
            <img src="{{ asset("images/logo.png") }}" alt="HORISON Logo" class="logo-image" />
        </a>
    </div>

    <div class="user-profile" onclick="showUserMenu()">
        <svg class="user-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
        </svg>
    </div>

    <div class="kategori-section" style="position: absolute; left: 20px; top: 140px; width: 310px; z-index: 3;">
        <h2 class="kategori-title">Kategori</h2>
        <div class="kategori-container">
            <a href="{{ route("admin.makanan") }}"
                class="kategori-link {{ request()->routeIs("admin.makanan") ? "active" : "" }}">Makanan</a>
            <a href="{{ route("admin.minuman") }}"
                class="kategori-link {{ request()->routeIs("admin.minuman") ? "active" : "" }}">Minuman</a>
            <a href="{{ route("admin.new-menu") }}"
                class="kategori-link {{ request()->routeIs("admin.new-menu") ? "active" : "" }}">New Menu</a>
        </div>
    </div>

    <div class="pengguna-section" style="position: absolute; left: 20px; top: 416px; width: 310px; z-index: 3;">
        <h2 class="pengguna-title">Dan Lain-lain</h2>
        <div class="pengguna-container">
            <a href="{{ route("admin.pengguna") }}"
                class="pengguna-link {{ request()->routeIs("admin.pengguna") ? "active" : "" }}">Pengguna</a>
            <a href="{{ route("admin.promo") }}"
                class="pengguna-link {{ request()->routeIs("admin.promo") ? "active" : "" }}">Promo</a>
        </div>
    </div>

    <form action="{{ route("logout_page") }}" method="GET" class="logout-section">
        @csrf
        <button type="submit" class="logout-submit">
            <svg class="logout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16,17 21,12 16,7" />
                <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
            <span class="logout-text">Log Out</span>
        </button>
    </form>
</div>
