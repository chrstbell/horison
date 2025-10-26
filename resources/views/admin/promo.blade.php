@extends("layouts.admin")

@section("title", "Dashboard")

@push("styles")
    <style>
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

        .add-promo-btn {
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
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.2);
            margin-top: 20px;
        }

        .add-promo-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.3);
            background: linear-gradient(135deg, #229954, #27ae60);
        }

        .add-icon {
            width: 20px;
            height: 20px;
        }

        .divider-line {
            width: 100%;
            height: 1px;
            background-color: #cccccc;
            margin: 30px 0;
        }

        /* Promo List */
        .promo-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            padding-bottom: 50px;
        }

        .promo-card {
            background-color: #f8f9fa;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
        }

        .promo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .promo-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .promo-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .promo-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .promo-name {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .promo-description {
            font-size: 15px;
            color: #555;
            line-height: 1.5;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .promo-terms {
            font-size: 14px;
            color: #777;
            line-height: 1.4;
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        .promo-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: flex-end;
        }

        .edit-btn,
        .delete-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .edit-btn {
            background-color: #3498db;
            color: white;
        }

        .edit-btn:hover {
            background-color: #2980b9;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.2);
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(231, 76, 60, 0.2);
        }

        /* Add/Edit Promo Form Styles */
        .promo-form-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .promo-form-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .form-container {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(-30px);
            transition: transform 0.3s ease;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .promo-form-overlay.active .form-container {
            transform: translateY(0);
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }

        .form-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }

        .close-form-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #7f8c8d;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .close-form-btn:hover {
            background-color: #f8f9fa;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            background-color: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 12px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            color: #2c3e50;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus,
        .form-textarea:focus {
            background-color: #ffffff;
            border-color: #a58857;
            box-shadow: 0 0 0 3px rgba(165, 136, 87, 0.1);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #95a5a6;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .image-upload-preview {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .image-preview {
            width: 100px;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 8px;
            object-fit: cover;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 14px;
            text-align: center;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .form-btn {
            flex: 1;
            height: 50px;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn {
            background-color: #27ae60;
            color: white;
        }

        .submit-btn:hover {
            background-color: #229954;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.2);
        }

        .cancel-form-btn {
            background-color: #e74c3c;
            color: white;
        }

        .cancel-form-btn:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.2);
        }

        /* Alert Styles */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            z-index: 3000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .alert.success {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
        }

        .alert.error {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }

        .alert.show {
            opacity: 1;
            transform: translateX(0);
        }

        @keyframes slideInFromRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutToRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
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
        }

        @media (max-width: 1200px) {
            .main-content {
                padding: 30px 40px;
            }

            .promo-list {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .add-promo-btn {
                width: 100%;
                justify-content: center;
            }

            .form-container {
                padding: 30px 25px;
                margin: 20px;
                width: calc(100% - 40px);
            }

            .form-actions {
                flex-direction: column;
            }

            .promo-list {
                grid-template-columns: 1fr;
                /* Single column on small screens */
            }
        }
    </style>
@endpush

@section("content")
    <div class="header-section">
        <h1>Manajemen Promo</h1>
        <div class="breadcrumb">
            <a onclick="goToDashboard()">Dashboard</a> > Promo
        </div>
        <button class="add-promo-btn" onclick="showPromoForm()">
            <svg class="add-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Promo Baru
        </button>
    </div>

    <div class="divider-line"></div>

    <!-- Promo List Section -->
    <div class="promo-list" id="promoList">
        @forelse($promo_data as $promo)
            <div class="promo-card" data-promo-id="{{ $promo->id }}">
                <div class="promo-image-container">
                    @if($promo->image_path)
                        <img src="{{ asset($promo->image_path) }}" alt="{{ $promo->name }}" class="promo-image">
                    @else
                        <div style="color: #999; font-size: 14px;">No Image</div>
                    @endif
                </div>
                <div class="promo-content">
                    <div class="promo-name">{{ $promo->name }}</div>
                    <div class="promo-description">{{ $promo->description }}</div>
                    @if($promo->tnc)
                        <div class="promo-terms">
                            <strong>Syarat & Ketentuan:</strong><br>
                            {{ $promo->tnc }}
                        </div>
                    @endif
                    <div class="promo-actions">
                        <button class="edit-btn" onclick="editPromo({{ $promo->id }})">Edit</button>
                        <button class="delete-btn" onclick="deletePromo({{ $promo->id }})">Hapus</button>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; color: #999; padding: 40px;">
                Belum ada promo. Klik "Tambah Promo Baru" untuk menambahkan.
            </div>
        @endforelse
    </div>
    <!-- Add/Edit Promo Form -->
    <div id="promoFormOverlay" class="promo-form-overlay">
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title" id="promoFormTitle">Tambah Promo Baru</h2>
                <button class="close-form-btn" onclick="closePromoForm()">×</button>
            </div>

            <form id="promoForm" onsubmit="submitPromoForm(event)">
                <input type="hidden" id="promoId">

                <div class="form-group">
                    <label class="form-label" for="promoImage">Foto Promo</label>
                    <input type="file" class="form-input" id="promoImage" accept="image/*"
                        onchange="previewImage(event)">
                    <div class="image-upload-preview">
                        <img id="imagePreview" class="image-preview" src="#" alt="Preview Gambar"
                            style="display: none;">
                        <span id="imagePlaceholder" class="image-preview">Pilih Gambar</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="promoName">Nama Promo</label>
                    <input type="text" class="form-input" id="promoName" placeholder="Contoh: Diskon 20% Makanan"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="promoDescription">Deskripsi Promo</label>
                    <textarea class="form-textarea" id="promoDescription" placeholder="Jelaskan detail promo ini..." required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="promoTerms">Syarat & Ketentuan</label>
                    <textarea class="form-textarea" id="promoTerms" placeholder="Contoh: Berlaku untuk pembelian di atas Rp 50.000"></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="form-btn submit-btn">Simpan</button>
                    <button type="button" class="form-btn cancel-form-btn" onclick="closePromoForm()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alert notification -->
    <div id="alert" class="alert"></div>

@endsection

@push("scripts")
    <script>
        // Store promo data from backend
        let promosData = @json($promo_data);
        let isEditMode = false;
        let currentEditId = null;

        // Navigation function
        function goToDashboard() {
            window.location.href = "{{ route('admin.dashboard') }}";
        }

        // Show promo form
        function showPromoForm() {
            isEditMode = false;
            currentEditId = null;
            document.getElementById('promoFormTitle').textContent = 'Tambah Promo Baru';
            document.getElementById('promoForm').reset();
            document.getElementById('promoId').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('imagePlaceholder').style.display = 'flex';
            document.getElementById('promoFormOverlay').classList.add('active');
        }

        // Close promo form
        function closePromoForm() {
            document.getElementById('promoFormOverlay').classList.remove('active');
            setTimeout(() => {
                document.getElementById('promoForm').reset();
                document.getElementById('imagePreview').style.display = 'none';
                document.getElementById('imagePlaceholder').style.display = 'flex';
            }, 300);
        }

        // Preview image
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    const placeholder = document.getElementById('imagePlaceholder');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }

        // Submit promo form
        function submitPromoForm(event) {
            event.preventDefault();

            const formData = new FormData();
            const imageFile = document.getElementById('promoImage').files[0];

            if (imageFile) {
                formData.append('imageUpload', imageFile);
            }

            formData.append('name', document.getElementById('promoName').value);
            formData.append('description', document.getElementById('promoDescription').value);
            formData.append('tnc', document.getElementById('promoTerms').value);
            formData.append('from', 'promo');

            let url, method;
            if (isEditMode && currentEditId) {
                url = `/admin/promos/${currentEditId}`;
                method = 'POST';
                formData.append('_method', 'PUT');
            } else {
                url = "{{ route('admin.promos.store') }}";
                method = 'POST';
            }

            formData.append('_token', '{{ csrf_token() }}');

            fetch(url, {
                method: method,
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response;
                }
                throw new Error('Network response was not ok');
            })
            .then(() => {
                showAlert(isEditMode ? 'Promo berhasil diperbarui!' : 'Promo berhasil ditambahkan!', 'success');
                closePromoForm();
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
            });
        }

        // Edit promo
        function editPromo(id) {
            const promo = promosData.find(p => p.id === id);
            if (!promo) {
                showAlert('Promo tidak ditemukan', 'error');
                return;
            }

            isEditMode = true;
            currentEditId = id;

            document.getElementById('promoFormTitle').textContent = 'Edit Promo';
            document.getElementById('promoId').value = id;
            document.getElementById('promoName').value = promo.name;
            document.getElementById('promoDescription').value = promo.description;
            document.getElementById('promoTerms').value = promo.tnc || '';

            // Show existing image if available
            if (promo.image_path) {
                const preview = document.getElementById('imagePreview');
                const placeholder = document.getElementById('imagePlaceholder');
                preview.src = '/' + promo.image_path;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }

            document.getElementById('promoFormOverlay').classList.add('active');
        }

        // Delete promo
        function deletePromo(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus promo ini?')) {
                return;
            }

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'DELETE');
            formData.append('from', 'promo');

            fetch(`/admin/promos/${id}`, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response;
                }
                throw new Error('Network response was not ok');
            })
            .then(() => {
                showAlert('Promo berhasil dihapus!', 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan saat menghapus promo.', 'error');
            });
        }

        // Show alert
        function showAlert(message, type) {
            const alert = document.getElementById('alert');
            alert.textContent = message;
            alert.className = 'alert ' + type;
            alert.classList.add('show');

            setTimeout(() => {
                alert.classList.remove('show');
            }, 3000);
        }

        // Close overlay when clicking outside
        document.getElementById('promoFormOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closePromoForm();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Promo page loaded with', promosData.length, 'promos');
        });
    </script>
@endpush
