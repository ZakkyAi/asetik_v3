<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\User;
use App\Models\Record;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check user role and filter repairs accordingly
        if (auth()->user()->level === 'admin') {
            // Admins can see all repairs
            $repairs = Repair::with(['user', 'record'])->orderBy('id_repair', 'desc')->get();
        } else {
            // Normal users can only see repairs for their own records
            $repairs = Repair::with(['user', 'record'])
                ->whereHas('record', function($query) {
                    $query->where('id_users', auth()->id());
                })
                ->orderBy('id_repair', 'desc')
                ->get();
        }
        
        return view('repairs.index', compact('repairs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $records = Record::with(['user', 'product'])->orderBy('id_records', 'desc')->get();
        return view('repairs.create', compact('users', 'records'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_record' => 'required|exists:records,id_records',
            'note' => 'required|string',
        ]);
        
        Repair::create($validated);

        return redirect()->route('repairs.index')->with('success', 'Repair created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $repair = Repair::with(['user', 'record.user', 'record.product'])->findOrFail($id);
        
        // Check if normal user is trying to view a repair for someone else's record
        if (auth()->user()->level !== 'admin' && $repair->record->id_users !== auth()->id()) {
            abort(403, 'Unauthorized access to this repair.');
        }
        
        return view('repairs.show', compact('repair'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $repair = Repair::findOrFail($id);
        $users = User::orderBy('name')->get();
        $records = Record::with(['user', 'product'])->orderBy('id_records', 'desc')->get();
        return view('repairs.edit', compact('repair', 'users', 'records'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $repair = Repair::findOrFail($id);

        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_record' => 'required|exists:records,id_records',
            'note' => 'required|string',
        ]);

        $repair->update($validated);

        return redirect()->route('repairs.index')->with('success', 'Repair updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $repair = Repair::findOrFail($id);
        $repair->delete();

        return redirect()->route('repairs.index')->with('success', 'Repair deleted successfully!');
    }
}
