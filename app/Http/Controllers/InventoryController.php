<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;   
class InventoryController extends Controller
{
    private $inventory;

    public function __construct(Inventory $inventory)
    {
        throw new \Exception('Not implemented');
    }
}
