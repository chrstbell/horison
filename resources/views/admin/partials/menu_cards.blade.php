   <style>
       .menu-grid {
           display: grid;
           grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
           gap: 25px;
           margin-top: 20px;
       }

       .menu-card {
           position: relative;
           background: linear-gradient(145deg, #ffffff, #f8f9fa);
           border-radius: 16px;
           padding: 0;
           box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
           transition: all 0.3s ease;
           cursor: pointer;
           border: 2px solid transparent;
           overflow: hidden;
       }

       .menu-card:hover {
           transform: translateY(-8px);
           box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
           border-color: #a58857;
       }

       .menu-image {
           width: 100%;
           height: 180px;
           background: linear-gradient(135deg, #f1f2f6, #ddd);
           display: flex;
           align-items: center;
           justify-content: center;
           color: #95a5a6;
           font-size: 14px;
           position: relative;
           overflow: hidden;
       }

       .menu-image img {
           width: 100%;
           height: 100%;
           object-fit: cover;
       }

       .menu-content {
           padding: 20px;
       }

       .menu-card h3 {
           font-size: 18px;
           font-weight: 700;
           color: #2c3e50;
           margin-bottom: 8px;
       }

       .menu-card p {
           font-size: 13px;
           color: #7f8c8d;
           line-height: 1.5;
           margin-bottom: 15px;
           height: 40px;
           overflow: hidden;
       }

       .menu-price {
           font-size: 16px;
           font-weight: bold;
           color: #a58857;
           margin-bottom: 15px;
       }

       .menu-actions {
           display: flex;
           gap: 8px;
           flex-wrap: wrap;
       }

       .new-badge {
           position: absolute;
           top: 15px;
           right: 15px;
           background: linear-gradient(135deg, #e74c3c, #c0392b);
           color: white;
           padding: 4px 12px;
           border-radius: 20px;
           font-size: 12px;
           font-weight: 700;
           text-transform: uppercase;
           letter-spacing: 0.5px;
           z-index: 3;
           box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
       }

       .action-btn {
           text-decoration: none;
           color: inherit;
           text-align: center;
           padding: 6px 12px;
           border: none;
           border-radius: 6px;
           font-size: 12px;
           font-weight: 600;
           font-family: 'Inter', Arial, sans-serif;
           cursor: pointer;
           transition: all 0.2s ease;
           flex: 1;
           min-width: 60px;
       }

       .sold-out-btn {
           background-color: #e74c3c;
           color: white;
       }

       .sold-out-btn:hover {
           background-color: #c0392b;
       }

       .sold-out-btn.active {
           background-color: #95a5a6;
       }

       .edit-btn {
           background-color: #3498db;
           color: white;
       }

       .edit-btn:hover {
           background-color: #2980b9;
       }

       .delete-btn {
           background-color: #95a5a6;
           color: white;
       }

       .delete-btn:hover {
           background-color: #7f8c8d;
       }
   </style>

   @forelse ($menu_data as $index => $item)
       <div class="menu-card">
           @if ($item->category_type === "new_menu")
               <div class="new-badge">New</div>
           @endif
           <div class="menu-image">
               @if ($item->image_path)
                   <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}">
               @else
                   {{ $item->name }}
               @endif
           </div>
           <div class="menu-content">
               <h3>{{ $item->name }}</h3>
               <p>{{ $item->description }}</p>
               <div class="menu-price">Rp {{ number_format($item->price, 0, ",", ".") }}</div>
               <div class="menu-actions">
                   <button class="action-btn sold-out-btn {{ $item->is_available ? "active" : "" }}"
                       onclick="showConfirmationModal('{{ $item->id }}', '{{ $item->name }}', {{ $item->is_available }})">
                       {{ $item->is_available ? "Available" : "Sold Out" }}
                   </button>
                   <a href="{{ route("admin.edit_menu", $item->id) }}" class="action-btn edit-btn">
                       Edit
                   </a>

                   <form action="{{ route("admin.menus.delete", $item->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method("DELETE")
                       <button type="submit" class="action-btn delete-btn"
                           onclick="return confirm('Apakah anda yakin ingin menghapus {{ $item->name }}')">
                           Hapus
                       </button>
                       <input type="hidden" name="from"
                           value="{{ $item->category_type === "new_menu" ? "new-menu" : $item->category_type }}">
                   </form>
               </div>
           </div>
       </div>
   @empty
       <p class="text-muted">No menu available in this category.</p>
   @endforelse
