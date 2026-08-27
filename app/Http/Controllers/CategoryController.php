<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function store(Request $request, $business_id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $this->category->name = $request->name;
        $this->category->business_id = $business_id;
        $this->category->save();

        return response()->json([
            'message' => 'Success!'
        ]);
    }

    public function getCategories($business_id)
    {
        $categories = $this->category->where('business_id', $business_id)->get();

        return response()->json($categories);
    }

   
}
