<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;   
class InventoryController extends Controller
{
    private $inventory;

    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    public function store(Request $request){
        $request->validate([
            'product_id' => 'required',
            'stock' => 'required',  
            'reorder_at' => 'required',
            'reorder_qty' => 'required',
            'last_restocked_at' => 'required'
        ]);

        $this->inventory->product_id = $request->product_id;

        $inventory = $this->inventory->where('product_id', $request->product_id)->first();

        if($inventory) {
            $inventory->stock = $inventory->stock + $request->stock;
        } else {
            $inventory = $this->inventory;
            $inventory->product_id = $request->product_id;
            $inventory->stock = $request->stock;
        }
        $inventory->reorder_at = $request->reorder_at;
        $inventory->reorder_qty = $request->reorder_qty;
        $inventory->last_restocked_at = $request->last_restocked_at;
        $inventory->save();


        

        return response()->json([
            'message' => 'Inserted Successfully!'
        ]);
    }

    public function getInventories($business_id)
    {
        $all_inventories = $this->inventory->with('product.category')
        // whereHas('product', ...) - filter inventories based on their related product
        // function ($query) - defines the condition/query to apply to the related product
        // use ($business_id) -  makes the $business_id parameter available inside the function
        // $query->where() - the actual condition applied to the product
                            ->whereHas('product', function ($query) use ($business_id) {
                                $query->where('business_id', $business_id);
                            })->get();

        return response()->json($all_inventories);
    }
}
