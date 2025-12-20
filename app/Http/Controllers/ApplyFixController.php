<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Repair;

class ApplyFixController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get broken products owned by this user that can be repaired
        $brokenRecords = Record::with(['product'])
            ->where('id_users', $user->id)
            ->where('status', 'broken')
            ->orderBy('id_records', 'desc')
            ->get();
        
        return view('apply_repair.index', compact('brokenRecords'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_record' => 'required|exists:records,id_records',
            'note' => 'required|string',
        ]);
        
        // Verify the record belongs to the current user
        $record = Record::findOrFail($validated['id_record']);
        if ($record->id_users !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        // Create repair request
        Repair::create([
            'id_user' => auth()->id(),
            'id_record' => $validated['id_record'],
            'note' => $validated['note'],
        ]);
        
        // Update record status to pending
        $record->update(['status' => 'pending']);
        
        return redirect()->route('apply-fix.index')->with('success', 'Repair request submitted successfully!');
    }
}
