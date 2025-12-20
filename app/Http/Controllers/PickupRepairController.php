<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repair;

class PickupRepairController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get repairs that are ready for pickup (status: fixing or completed)
        $pickupRepairs = Repair::with(['record.product'])
            ->where('id_user', $user->id)
            ->whereHas('record', function($query) {
                $query->whereIn('status', ['fixing', 'good']);
            })
            ->orderBy('id_repair', 'desc')
            ->get();
        
        return view('pickup_repairs.index', compact('pickupRepairs'));
    }
}
