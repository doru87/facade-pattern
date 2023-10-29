<?php
namespace App\Core\Inventory;

// InventoryCheck.php
use Illuminate\Support\Facades\DB;

class InventoryCheck {

    public function inStock($productId) {
        $product = DB::table('products')->find($productId);
        
        if ($product && $product->stock > 0) {
            return true;
        } else {
            return false;
        }
    }
}