<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Repair;

class RepairController extends Controller
{
    /**
     * Show good items that can be sent for repair
     */
    public function applyIndex()
    {
        $user = auth()->user();
        
        // Get good items owned by this user that can be sent for repair
        $goodRecords = Record::with(['product'])
            ->where('id_users', $user->id)
            ->where('status', 'good')
            ->orderBy('id_records', 'desc')
            ->get();
        
        return view('user.repair.apply', compact('goodRecords'));
    }
    
    /**
     * Submit repair request
     */
    public function applyStore(Request $request)
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
        
        // Verify the record status is 'good'
        if ($record->status !== 'good') {
            return back()->with('error', 'Only items with "good" status can be sent for repair.');
        }
        
        // Create repair request
        Repair::create([
            'id_user' => auth()->id(),
            'id_record' => $validated['id_record'],
            'note' => $validated['note'],
        ]);
        
        // Update record status from good to broken (waiting for admin approval)
        $record->update(['status' => 'broken']);
        
        return redirect()->route('user.repair.apply')->with('success', 'Repair request submitted successfully! Item status changed to broken.');
    }
    
    /**
     * Show items ready for pickup
     */
    public function pickupIndex()
    {
        $user = auth()->user();
        
        // Get repairs that are ready for pickup (status: fixing or good)
        $pickupRepairs = Repair::with(['record.product'])
            ->where('id_user', $user->id)
            ->whereHas('record', function($query) {
                $query->whereIn('status', ['fixing', 'good']);
            })
            ->orderBy('id_repair', 'desc')
            ->get();
        
        return view('user.repair.pickup', compact('pickupRepairs'));
    }
}
