<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Repair - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; min-height: 100vh; }
        
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); position: sticky; top: 0; z-index: 100; }
        .navbar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; height: 70px; }
        .navbar-brand { font-size: 24px; font-weight: 700; display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; }
        .navbar-menu { display: flex; gap: 30px; align-items: center; }
        .navbar-menu a { color: white; text-decoration: none; font-weight: 500; transition: opacity 0.3s; padding: 8px 16px;  }
        .navbar-menu a:hover, .navbar-menu a.active { background: rgba(255, 255, 255, 0.2); }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-avatar { width: 40px; height: 40px;  background: rgba(255, 255, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 18px; overflow: hidden; }
        .logout-btn { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 8px 20px;  cursor: pointer; font-weight: 600; transition: all 0.3s; }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }
        .container { max-width: 1400px; margin: 0 auto; padding: 30px; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 32px; color: #333; margin-bottom: 10px; }
        .page-header p { color: #666; font-size: 16px; }
        .alert { padding: 15px;  margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .product-card { background: white;  padding: 25px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); transition: all 0.3s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); }
        .product-image { width: 100%; height: 180px; object-fit: cover;  margin-bottom: 15px; background: #f0f0f0; }
        .product-name { font-size: 18px; font-weight: 600; margin-bottom: 15px; color: #333; }
        .product-info { font-size: 14px; color: #666; margin-bottom: 8px; }
        .product-info strong { color: #333; }
        .btn-repair { display: block; width: 100%; padding: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center; text-decoration: none;  margin-top: 15px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; }
        .btn-repair:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); }
        .empty-state { text-align: center; padding: 80px 20px; color: #999; background: white;  }
        .empty-state h3 { font-size: 24px; margin-bottom: 10px; color: #666; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
        .modal-content { background: white; margin: 10% auto; padding: 40px;  width: 90%; max-width: 500px; box-shadow: 0 5px 30px rgba(0,0,0,0.3); }
        .close { float: right; font-size: 28px; font-weight: bold; cursor: pointer; color: #999; line-height: 20px; }
        .close:hover { color: #333; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        .form-control { width: 100%; padding: 12px; border: 2px solid #e0e0e0;  font-size: 14px; transition: all 0.3s; }
        .form-control:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        textarea.form-control { min-height: 120px; resize: vertical; font-family: inherit; }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <div class="container">
        <div class="page-header">
            <h1>Apply for Repair</h1>
            <p>Select an item to send for repair</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error" style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
                {{ session('error') }}
            </div>
        @endif
        
        @if($goodRecords->count() > 0)
            <div class="products-grid">
                @foreach($goodRecords as $record)
                <div class="product-card">
                    @if($record->product && $record->product->photo)
                        <img src="{{ asset($record->product->photo) }}" alt="{{ $record->product->name }}" class="product-image">
                    @else
                        <div class="product-image" style="display: flex; align-items: center; justify-content: center; font-size: 48px; color: #ccc;">
                            📦
                        </div>
                    @endif
                    
                    <div class="product-name">{{ $record->product ? $record->product->name : 'N/A' }}</div>
                    <div class="product-info"><strong>Serial:</strong> {{ $record->no_serial }}</div>
                    <div class="product-info"><strong>Inventory:</strong> {{ $record->no_inventaris }}</div>
                    <div class="product-info"><strong>Note:</strong> {{ $record->note_record }}</div>
                    
                    <button class="btn-repair" onclick="openRepairModal({{ $record->id_records }}, '{{ $record->product ? $record->product->name : 'N/A' }}')">
                        Send for Repair
                    </button>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h3>No items available</h3>
                <p>You don't have any items in good condition to send for repair.</p>
            </div>
        @endif
    </div>
    
    <!-- Repair Modal -->
    <div id="repairModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeRepairModal()">&times;</span>
            <h2 style="margin-bottom: 20px; color: #333;">Send Item for Repair</h2>
            <form method="POST" action="{{ route('user.repair.apply.store') }}">
                @csrf
                <input type="hidden" name="id_record" id="recordId">
                
                <div class="form-group">
                    <label>Product:</label>
                    <input type="text" id="productName" class="form-control" readonly style="background: #f8f9fa;">
                </div>
                
                <div class="form-group">
                    <label for="note">Reason for Repair: *</label>
                    <textarea name="note" id="note" class="form-control" required placeholder="Describe why this item needs repair..."></textarea>
                </div>
                
                <button type="submit" class="btn-repair" style="margin-top: 20px;">Send for Repair</button>
            </form>
        </div>
    </div>
    
    <script>
        function openRepairModal(recordId, productName) {
            document.getElementById('recordId').value = recordId;
            document.getElementById('productName').value = productName;
            document.getElementById('repairModal').style.display = 'block';
        }
        
        function closeRepairModal() {
            document.getElementById('repairModal').style.display = 'none';
            document.getElementById('note').value = '';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('repairModal');
            if (event.target == modal) {
                closeRepairModal();
            }
        }
    </script>
</body>
</html>
