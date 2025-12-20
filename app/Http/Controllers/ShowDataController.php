<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;

class ShowDataController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get all records for this user
        $records = Record::with(['product'])
            ->where('id_users', $user->id)
            ->orderBy('id_records', 'desc')
            ->get();
        
        return view('show_data.index', compact('user', 'records'));
    }
}
