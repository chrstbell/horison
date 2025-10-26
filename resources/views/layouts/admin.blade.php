<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield("title", "HORISON Admin")</title>

        {{-- Fonts, styles, etc --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        {{-- Optional extra CSS --}}
        @stack("styles")
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', Arial, sans-serif;
                background-color: #ffffff;
                overflow-x: hidden;
            }

            .main-content {
                margin-left: 350px;
                padding: 40px 50px;
                background-color: #ffffff;
                min-height: 100vh;
                flex: 1;
            }

            .dashboard-container {
                width: 100vw;
                min-height: 100vh;
                background-color: #ffffff;
                position: relative;
                display: flex;
            }

            .edit-btn {
                background-color: #3498db;
                color: white;
            }

            .edit-btn:hover {
                background-color: #2980b9;
            }

            .delete-btn {
                /* background-color: #95a5a6; */
                color: white;
            }

            .delete-btn:hover {
                /* background-color: #7f8c8d; */
            }

            /* Confirmation Modal Styles */
            .modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.6);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            .modal-overlay.active {
                opacity: 1;
                visibility: visible;
            }

            .modal-content {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
                width: 90%;
                max-width: 450px;
                transform: translateY(-30px);
                transition: transform 0.3s ease;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .modal-overlay.active .modal-content {
                transform: translateY(0);
            }

            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e0e0e0;
                padding-bottom: 15px;
                margin-bottom: 15px;
            }

            .modal-header h3 {
                font-size: 22px;
                color: #2c3e50;
                font-weight: 700;
            }

            .close-button {
                font-size: 28px;
                color: #7f8c8d;
                cursor: pointer;
                transition: color 0.2s ease;
            }

            .close-button:hover {
                color: #34495e;
            }

            .modal-body p {
                font-size: 16px;
                color: #34495e;
                line-height: 1.6;
                text-align: center;
            }

            .modal-footer {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                padding-top: 15px;
                border-top: 1px solid #e0e0e0;
                margin-top: 15px;
            }

            .modal-button {
                padding: 10px 20px;
                border: none;
                border-radius: 8px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
            }
        </style>
    </head>

    <body>
        <div class="dashboard-container">
            {{-- Sidebar --}}
            @include("components.sidebar")

            {{-- Main Content --}}
            <div class="main-content">
                @yield("content")
            </div>

            <div id="confirmationModal" class="modal-overlay">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 id="modalTitle">Konfirmasi Status Produk</h3>
                        <span class="close-button" onclick="closeConfirmationModal()">&times;</span>
                    </div>
                    <div class="modal-body">
                        <p id="modalMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-button cancel-button"
                            onclick="closeConfirmationModal()">Batal</button>
                        <button class="modal-button confirm-button" id="confirmActionBtn">Ya</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Optional scripts --}}
        <script>
            function showConfirmationModal(id, name, isAvailable) {
                const modal = document.getElementById('confirmationModal');
                const modalMessage = document.getElementById('modalMessage');
                const confirmButton = document.getElementById('confirmActionBtn');
                const modalTitle = document.getElementById('modalTitle');

                if (isAvailable) {
                    modalTitle.textContent = 'Konfirmasi Produk Habis';
                    modalMessage.innerHTML =
                        `Apakah Anda yakin ingin mengubah status <strong>"${name}"</strong> menjadi <strong>Habis</strong>?`;
                    confirmButton.textContent = 'Ya, Habis';
                    confirmButton.className = 'modal-button confirm-button';
                    confirmButton.style.backgroundColor = '#e74c3c';
                    confirmButton.style.boxShadow = '0 4px 10px rgba(231, 76, 60, 0.2)';
                    confirmButton.onmouseover = () => confirmButton.style.backgroundColor = '#c0392b';
                    confirmButton.onmouseout = () => confirmButton.style.backgroundColor = '#e74c3c';
                    confirmButton.onclick = () => toggleAvailability(id)
                } else {
                    modalTitle.textContent = 'Konfirmasi Ketersediaan Produk';
                    modalMessage.innerHTML =
                        `Apakah Anda yakin ingin mengubah status <strong>"${name}"</strong> menjadi <strong>Tersedia</strong>?`;
                    confirmButton.textContent = 'Ya, Tersedia';
                    confirmButton.className = 'modal-button confirm-button';
                    confirmButton.style.backgroundColor = '#2ecc71';
                    confirmButton.style.boxShadow = '0 4px 10px rgba(46, 204, 113, 0.2)';
                    confirmButton.onmouseover = () => confirmButton.style.backgroundColor = '#27ae60';
                    confirmButton.onmouseout = () => confirmButton.style.backgroundColor = '#2ecc71';
                    confirmButton.onclick = () => toggleAvailability(id)
                }
                modal.classList.add('active');

            }

            function closeConfirmationModal() {
                const modal = document.getElementById('confirmationModal');
                modal.classList.remove('active');
                pendingToggleItem = null; // Hapus data item yang tertunda
            }

            function toggleAvailability(id) {
                fetch(`/admin/menus/update_available/${id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // important for Laravel
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to update availability');
                        }
                        return response.data;
                    })
                    .then(data => {
                        console.log(data);
                        // Optionally reload or update UI without reload
                        location.reload();
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Error updating availability');
                    });
            }
        </script>
        @stack("scripts")
    </body>

</html>
