<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class BusinessController extends Controller
{
    private $business;
    private $user;
    public function __construct(Business $business, User $user)
    {
        $this->business = $business;
        $this->user = $user;
    }

    public function getBusinesses()
    {
        $user = Auth::user();
        $business_details = [];
        foreach($user->businessUser as $business_user){
            $business_details[] = ['id' => $business_user->business->id,
                                'name' => $business_user->business->name,
                                'plan' => $business_user->business->plan->name,
                                'business_type' => $business_user->business->businessType->name];
        }

        return response()->json($business_details);
    }

    public function getBusiness($id)
    {
        $business = $this->business->findOrFail($id);
        
        return response()->json($business);
    }
}
