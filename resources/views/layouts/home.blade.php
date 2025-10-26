<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield("title", "Horison Hotels")</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

        @stack("styles")
        <style>
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

            .no-orders {
                text-align: center;
                padding: 40px 20px;
                color: #757575;
                font-size: 14px;
            }

            /* Cart Summary */
            .cart-summary {
                position: absolute;
                bottom: 75px;
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

            /* Responsive untuk layar besar/tablet */
            @media (min-width: 768px) {
                .container {
                    max-width: 480px;
                    margin: 0 auto;
                    box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            @yield("content")
        </div>
        @include("components.bottom_nav")

        @stack("scripts")
    </body>

</html>
