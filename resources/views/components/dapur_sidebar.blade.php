<style>
    /* Layout: put Clear at the far right */
    .history-filters {
        display: flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        margin: 12px 0;
        /* (2) vertical margin */
    }

    /* Push Clear to the end (right) */
    .clear-btn {
        margin-left: auto;
    }

    /* Bootstrap-like control (from earlier) + extra margin for the input */
    .form-control-date {
        display: inline-block;
        width: 220px;
        padding: 8px 12px;
        font-size: 14px;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 6px;
        transition: border-color .2s ease, box-shadow .2s ease;
        outline: none;
    }

    /* Focus */
    .form-control-date:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .25);
    }

    /* Optional: make the picker icon clickable & slightly toned */
    .form-control-date::-webkit-calendar-picker-indicator {
        cursor: pointer;
        filter: invert(.5);
    }

    /* Clear button look */
    .clear-btn {
        padding: 8px 14px;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color .2s ease, border-color .2s ease;
    }

    .clear-btn:hover {
        background-color: #e9ecef;
        border-color: #adb5bd;
    }
</style>

<div class="sidebar">
    <!-- Logo -->
    <div class="logo-section"><img src="{{ asset("images/logo.png") }}" alt="HORISON Logo" class="logo-image"
            onclick="window.location.href='{{ route("dapur.dashboard") }}'" /></div>
    <!-- User Profile -->
    <div class="user-profile" onclick="showUserMenu()"><span style="font-size: 20px;">👨‍🍳</span></div>
    <!-- Pesanan Section -->
    <div class="pesanan-section">
        <div class="pesanan-header">
            <h2 class="pesanan-title">Pesanan Masuk</h2>
            <div class="notification-badge">
                <div class="badge-circle" id="orderCount">{{ $activeOrderCount }}</div>
            </div>
        </div>
        <div class="pesanan-container" id="pesananContainer">
            <!-- Pesanan items will be loaded here by JavaScript -->
            @if (isset($activeOrdersData))
                @foreach ($activeOrdersData as $order)
                    <div class="pesanan-item" onclick="goToOrderDetailById({{ $order["id"] }})"
                        data-room="{{ $order["room"] }}" data-id="{{ $order["id"] }}">
                        <div class="room-name">Kamar {{ $order["room"] }}</div>
                        <div class="order-time">{{ $order["datetime"] }}</div>
                        <div class="status-indicator"></div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- History Section -->
    <div class="history-section">
        <div class="history-header">
            <h2 class="history-title">History Pesanan</h2>
        </div>
        <div class="history-filters">
            <input type="date" id="historyDate" max="{{ \Carbon\Carbon::now()->format("Y-m-d") }}"
                value="{{ request("date") ?? "" }}" class="form-control-date" />
            {{-- <button id="clearHistoryDate" class="clear-btn">Clear</button> --}}
        </div>

        <div class="history-container" id="historyContainer">
            <!-- History items will be loaded here by JavaScript -->
            @if (isset($completedOrdersData))
                @foreach ($completedOrdersData as $order)
                    <div class="history-item" onclick="goToOrderDetailById({{ $order["id"] }})"
                        data-room="{{ $order["room"] }}" data-id="{{ $order["id"] }}">
                        <div class="room-name">Kamar {{ $order["room"] }}</div>
                        <div class="order-time">{{ $order["datetime"] }}</div>
                        {{-- <button class="delete-history-btn"
                            onclick="deleteHistoryOrder(event, {{ $order["id"] }}, '{{ $order["room"] }}')"><svg
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-trash-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2 2v2">
                                </path>
                                <line x1="10" y1="11" x2="10" y2="17">
                                </line>
                                <line x1="14" y1="11" x2="14" y2="17">
                                </line>
                            </svg></button> --}}
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- Logout Section -->
    <div class="logout-section" onclick="handleLogout()"><svg class="logout-icon" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16,17 21,12 16,7" />
            <line x1="21" y1="12" x2="9" y2="12" />
        </svg><span class="logout-text">Log Out</span></div>
</div>
<audio id="notifySound" src="{{ asset('sounds/new-order.wav') }}" preload="auto" loop></audio>


<script>
    document.addEventListener('DOMContentLoaded', () => {

        // --- DOM hooks
        const historyDateInput = document.getElementById('historyDate');
        // const clearBtn = document.getElementById('clearHistoryDate');
        const historyContainer = document.getElementById('historyContainer');
        const pesananContainer = document.getElementById('pesananContainer');
        const orderCountEl = document.getElementById('orderCount');
        const notifySound = document.getElementById('notifySound');

        // --- State for "new data" detection
        let lastHistoryIds = new Set(
            Array.from(historyContainer.querySelectorAll('[data-id]')).map(el => +el.getAttribute(
                'data-id'))
        );
        let lastActiveIds = new Set(
            Array.from(pesananContainer.querySelectorAll('[data-id]')).map(el => +el.getAttribute(
                'data-id'))
        );

        // --- Helpers
        function playNotify(times = 5) {
            if (!notifySound) return;

            let count = 0;

            const playOnce = () => {
                // restart sound from beginning
                notifySound.currentTime = 0;
                notifySound.play()
                    .catch(() => {
                        /* ignore autoplay restriction until user interacts */
                    });

                count++;

                if (count < times) {
                    // wait for sound to finish before replaying
                    // fallback: 1 second delay if duration not yet loaded
                    const delay = notifySound.duration > 0 ? notifySound.duration * 1000 + 200 : 1200;
                    setTimeout(playOnce, delay);
                }
            };

            playOnce();
        }

        function idsFrom(items) {
            return new Set((items || []).map(it => +it.id));
        }

        function hasNewData(prevIds, nextIds) {
            for (const id of nextIds) {
                if (!prevIds.has(id)) return true;
            }
            return false;
        }

        // --- API calls
        async function fetchHistory(dateStr) {
            const url = new URL('{{ route("dapur.orders.history_by_date") }}', window.location.origin);
            if (dateStr) url.searchParams.set('date', dateStr);
            const res = await fetch(url.toString(), {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error('Failed to fetch history: ' + res.statusText);
            return res.json(); // expects { data: [...] }
        }

        async function fetchActive() {
            const url = new URL('{{ route("dapur.orders.active") }}', window.location.origin);
            const res = await fetch(url.toString(), {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error('Failed to fetch active: ' + res.statusText);
            return res.json(); // expects { data: [...], count: n }
        }

        // --- Renderers
        function renderHistory(items) {
            historyContainer.innerHTML = '';
            if (!items || items.length === 0) {
                historyContainer.innerHTML =
                    `<div class="empty-history" style="padding:12px;color:#777">Tidak ada pesanan pada tanggal ini.</div>`;
                return;
            }

            const frag = document.createDocumentFragment();
            items.forEach(order => {
                const el = document.createElement('div');
                el.className = 'history-item';
                el.setAttribute('data-room', order.room);
                el.setAttribute('data-id', order.id);
                el.onclick = () => goToOrderDetailById(order.id);
                el.innerHTML = `
                <div class="room-name">Kamar ${order.room}</div>
                <div class="order-time">${order.datetime}</div>
            `;

                //     el.innerHTML = `
                //     <div class="room-name">Kamar ${order.room}</div>
                //     <div class="order-time">${order.datetime}</div>
                //     <button class="delete-history-btn"
                //         onclick="deleteHistoryOrder(event, ${order.id}, '${order.room}')">
                //         <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                //             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                //             stroke-linejoin="round" class="feather feather-trash-2">
                //             <polyline points="3 6 5 6 21 6"></polyline>
                //             <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2 2v2"></path>
                //             <line x1="10" y1="11" x2="10" y2="17"></line>
                //             <line x1="14" y1="11" x2="14" y2="17"></line>
                //         </svg>
                //     </button>
                // `;
                frag.appendChild(el);
            });
            historyContainer.appendChild(frag);
        }

        function renderActive(items) {
            pesananContainer.innerHTML = '';
            if (!items || items.length === 0) {
                pesananContainer.innerHTML =
                    `<div class="empty-active" style="padding:12px;color:#777">Belum ada pesanan masuk.</div>`;
                return;
            }

            const frag = document.createDocumentFragment();
            items.forEach(order => {
                const el = document.createElement('div');
                el.className = 'pesanan-item';
                el.setAttribute('data-room', order.room);
                el.setAttribute('data-id', order.id);
                el.onclick = () => goToOrderDetailById(order.id);

                el.innerHTML = `
                <div class="room-name">Kamar ${order.room}</div>
                <div class="order-time">${order.datetime}</div>
                <div class="status-indicator"></div>
            `;
                frag.appendChild(el);
            });
            pesananContainer.appendChild(frag);
        }

        // --- Updaters with "new data" check
        async function updateHistory() {
            const dateStr = historyDateInput.value || '';
            try {
                const {
                    data
                } = await fetchHistory(dateStr);
                const nextIds = idsFrom(data);
                const isNew = hasNewData(lastHistoryIds, nextIds);
                renderHistory(data);
                lastHistoryIds = nextIds;
            } catch (e) {
                console.error(e);
                historyContainer.innerHTML =
                    `<div class="empty-history" style="padding:12px;color:#c00">Gagal memuat data.</div>`;
            }
        }

        async function updateActive() {
            try {
                const {
                    data,
                    count
                } = await fetchActive();
                const nextIds = idsFrom(data);
                const isNew = hasNewData(lastActiveIds, nextIds);
                renderActive(data);
                if (typeof count === 'number' && orderCountEl) orderCountEl.textContent = count;
                if (isNew) playNotify();
                lastActiveIds = nextIds;
            } catch (e) {
                console.error(e);
                // Keep previous UI; optionally show a toast if you have one
            }
        }

        // --- Events (History filter)
        async function applyFilter() {
            await updateHistory();
        }

        historyDateInput.addEventListener('change', applyFilter);
        // clearBtn.addEventListener('click', () => {
        //     historyDateInput.value = '';
        //     applyFilter();
        // });

        // --- Initial load
        updateActive();

        // --- Poll every 5 seconds
        const POLL_MS = 5000;
        setInterval(() => {
            updateActive();
        }, POLL_MS);
    });
</script>
