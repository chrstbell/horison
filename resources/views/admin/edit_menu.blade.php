@extends("layouts.admin")

@section("title", "Edit Menu")

@push("styles")
    <style>
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

        /* Edit Form Specific Styles */
        .edit-form-container {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            gap: 50px;
            flex-wrap: wrap;
            /* Allow wrapping on smaller screens */
        }

        .product-image-section {
            flex-shrink: 0;
            width: 355px;
            /* Fixed width */
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 355px;
            border-radius: 7px;
            background-color: #f1f2f6;
            /* Placeholder background */
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #95a5a6;
            font-size: 14px;
            border: 2px dashed #ddd;
        }

        .change-pic-btn {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 12px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            color: #000000;
            transition: all 0.2s ease;
            border: none;
        }

        .change-pic-btn:hover {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .edit-icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            stroke: #000000;
            stroke-width: 2;
        }

        .form-fields {
            flex: 1;
            min-width: 300px;
            /* Ensure fields don't get too narrow */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            background: #f5f5f5;
            border: none;
            border-radius: 8px;
            padding: 16px 20px;
            font-size: 18px;
            color: #000000;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            background-color: #e9e9e9;
            box-shadow: 0 0 0 2px rgba(165, 136, 87, 0.3);
        }

        .form-input::placeholder {
            color: #888888;
            opacity: 1;
        }

        .form-input.name-input {
            height: 60px;
        }

        .form-input.description-input {
            height: 120px;
            resize: vertical;
            /* Allow vertical resizing */
            padding-top: 16px;
        }

        .form-input.price-input {
            width: 200px;
            /* Adjust width for price input */
            height: 60px;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            justify-content: flex-start;
            /* Align buttons to start */
            flex-wrap: wrap;
        }

        .btn {
            height: 50px;
            padding: 0 30px;
            border-radius: 8px;
            border: none;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
        }

        .btn-cancel {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .btn-save {
            background-color: #2ecc71;
            color: #ffffff;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn:disabled {
            background-color: #bdc3c7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-cancel:hover:not(:disabled) {
            background-color: #c0392b;
        }

        .btn-save:hover:not(:disabled) {
            background-color: #27ae60;
        }

        /* Loading indicator */
        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
                padding: 30px 40px;
            }

            .edit-form-container {
                flex-direction: column;
                gap: 30px;
            }

            .product-image-section {
                width: 100%;
                max-width: 355px;
                /* Keep max-width for image */
                margin: 0 auto;
                /* Center image */
            }

            .form-input.price-input {
                width: 100%;
                /* Full width on smaller screens */
            }

            .action-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                /* Change to relative for mobile */
                border-radius: 0;
            }

            .main-content {
                margin-left: 0;
                /* Remove margin for mobile */
                padding: 20px;
            }

            .logo-section {
                position: static;
                width: auto;
                height: auto;
                padding: 10px;
                text-align: center;
            }

            .user-profile {
                position: static;
                margin: 10px auto;
            }

            .kategori-section {
                position: static;
                width: auto;
                padding: 10px;
            }

            .kategori-container {
                width: auto;
                height: auto;
                padding: 10px;
            }

            .kategori-button {
                width: 100%;
            }

            .logout-section {
                position: static;
                width: 100%;
                border-radius: 0;
            }

            .header-section h1 {
                font-size: 28px;
            }

            .breadcrumb {
                font-size: 14px;
            }

            .form-input {
                font-size: 16px;
                padding: 14px 16px;
            }

            .btn {
                font-size: 16px;
                height: 45px;
                min-width: 100px;
            }
        }
    </style>
@endpush

@section("content")
    <div class="header-section">
        <h1 id="mainCategoryTitle">{{ $menu_data->name }}</h1>
        <div class="breadcrumb">
            <a onclick="goToDashboard()">Dashboard</a><span id="breadcrumbCategory"></span> > <span
                id="breadcrumbProductName">{{ $menu_data->name }}</span>
        </div>
    </div>
    <form action="{{ route("admin.menus.update", $menu_data->id) }}" method="POST" enctype="multipart/form-data">
        <div class="edit-form-container">
            @csrf
            @method("PUT") {{-- Spoofs PUT method --}}
            <div class="product-image-section">
                <div class="product-image" id="productImage"
                    @if ($menu_data->image_path) style="background-image: url('{{ asset($menu_data->image_path) }}')" @endif>
                    @unless ($menu_data->image_path)
                        No Image Available
                    @endunless
                </div>
                <input type="file" id="imageUpload" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                    style="display: none;" name="imageUpload">
                <button type="button" class="change-pic-btn" onclick="document.getElementById('imageUpload').click()">
                    <svg class="edit-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                    </svg>
                    Change Pict
                </button>
            </div>

            <div class="form-fields">
                <div class="form-group">
                    <input type="text" name="name" class="form-input name-input" id="productName"
                        placeholder="Nama Produk" value="{{ $menu_data->name }}">
                </div>

                <div class="form-group">
                    <textarea name="description" class="form-input description-input" id="productDescription"
                        placeholder="Deskripsi Produk">{{ $menu_data->description }}</textarea>
                </div>

                <div class="form-group">
                    <input name="price" type="text" class="form-input price-input" id="productPrice"
                        placeholder="Harga" value="{{ $menu_data->price }}">
                </div>

                <input type="hidden" name="from" value="{{ $menu_data->category_type }}">

                <div class="action-buttons">
                    <button type="button" class="btn btn-cancel" onclick="cancelEdit()">Cancel</button>
                    <button type="submit" class="btn btn-save">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push("scripts")
    <script>
        function cancelEdit() {
            if (confirm('Apakah Anda yakin ingin membatalkan perubahan? Data yang belum disimpan akan hilang.')) {
                window.history.back();
            }
        }
    </script>
@endpush
