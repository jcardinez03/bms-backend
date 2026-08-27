<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function store(Request $request, $business_id)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required',
            'selling_price' => 'required',
            'category_id' => 'required',
        ]);

        $user = Auth::user();
        $category = Category::findOrFail($request->category_id);

        $prefix = strtoupper(substr($category->name, 0 , 4));
        

        $count = $this->product->where('sku' , 'like' , $prefix .'%')->count();
        $SKU = $prefix . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        $this->product->name = $request->name;
        if($request->SKU){
            $this->product->SKU = $request->SKU;
        } else {
            $this->product->SKU = $SKU;
        }
        $this->product->cost = $request->cost;
        $this->product->selling_price = $request->selling_price;
        $this->product->business_id = $business_id;
        $this->product->category_id = $request->category_id;
        $this->product->competitor_price = $request->competitor_price;

        $this->product->save();

        return response()->json([
            'message' => 'Product saved!'
        ]);
    }

    public function getProducts($business_id)
    {
        $all_products = $this->product->where('business_id', $business_id)->get();

        $category_name = [];
        foreach($all_products as $product){
            $category_name[] = $product->category->name;
        }

        return response()->json([
            'all_products' => $all_products, 
            'category_name' => $category_name]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cost' => 'required',
            'selling_price' => 'required',
            'competitor_price' => 'required'
        ]);

        $product = $this->product->findOrFail($id);
        $product->cost = $request->cost;
        $product->selling_price = $request->selling_price;
        $product->competitor_price = $request->competitor_price;

        $product->save();

        return response()->json([
            'message' => 'Updated successfully!'
        ]);
    }

    public function destroy($product_id)
    {
        $product = $this->product->findOrFail($product_id);

        $product->delete();

        return response()->json([
            'message' => 'Deleted Successfully!'
        ]);
    }

    public function status($product_id, Request $request)
    {
        $product = $this->product->findOrFail($product_id);

        $product->is_active = $request->is_active;

        $product->save();

        return response()->json([
            'message' => 'Updated successfully!'
        ]);
    }
}
