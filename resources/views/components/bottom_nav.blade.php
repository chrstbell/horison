<!-- Bottom Navigation -->
@if (!request()->is("checkout"))
    <div class="bottom-nav">
        <button class="nav-item {{ request()->is("home") ? "active" : "" }}"
            onclick='window.location.href="{{ route("home") }}"'>
            <div class="nav-icon home-icon"></div>
        </button>
        <button class="nav-item {{ request()->is("menu") ? "active" : "" }}"
            onclick='window.location.href="{{ route("menu") }}"'>
            <div class="nav-icon menu-icon"></div>
        </button>
        <button class="nav-item {{ request()->is("status") ? "active" : "" }}"
            onclick='window.location.href="{{ route("status") }}"'>
            <div class="nav-icon order-icon"></div>
        </button>
        <button class="nav-item {{ request()->is("about") ? "active" : "" }}"
            onclick='window.location.href="{{ route("about") }}"'>
            <div class="nav-icon star-icon"></div>
        </button>
        @if (!request()->is("about"))
            <div class="cart-summary" id="cartSummary">
                <span id="cartItemCount">0</span>
                <span id="cartTotalPrice">IDR 0</span>
                <span>Checkout</span>
            </div>
        @endif
    </div>
@endif
