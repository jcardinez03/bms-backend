<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessType;
class BusinessTypeController extends Controller
{
    private $business_type;

    public function __construct(BusinessType $business_type)
    {
        $this->business_type = $business_type;
    }

    public function getBusinessTypes()
    {
        $allBusinessTypes = $this->business_type->all();

        return response()->json($allBusinessTypes);
    }
}
