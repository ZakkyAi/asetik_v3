<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check user role and filter records accordingly
        if (auth()->user()->level === 'admin') {
            // Admins can see all records
            $records = Record::with(['user', 'product'])->orderBy('id_records', 'desc')->get();
        } else {
            // Normal users can only see their own records
            $records = Record::with(['user', 'product'])
                ->where('id_users', auth()->id())
                ->orderBy('id_records', 'desc')
                ->get();
        }
        
        return view('records.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        return view('records.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_users' => 'required|exists:users,id',
            'id_products' => 'required|exists:products,id',
            'status' => 'required|in:good,broken,not taken,pending,fixing,decline',
            'no_serial' => 'required|string|max:255',
            'no_inventaris' => 'required|string|max:255',
            'note_record' => 'nullable|string',
        ]);
        
        Record::create($validated);

        return redirect()->route('records.index')->with('success', 'Record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = Record::with(['user', 'product'])->findOrFail($id);
        
        // Check if normal user is trying to view someone else's record
        if (auth()->user()->level !== 'admin' && $record->id_users !== auth()->id()) {
            abort(403, 'Unauthorized access to this record.');
        }
        
        return view('records.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Record::findOrFail($id);
        
        // Check if normal user is trying to edit someone else's record
        if (auth()->user()->level !== 'admin' && $record->id_users !== auth()->id()) {
            abort(403, 'Unauthorized access to this record.');
        }
        
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        return view('records.edit', compact('record', 'users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Record::findOrFail($id);
        
        // Check if normal user is trying to update someone else's record
        if (auth()->user()->level !== 'admin' && $record->id_users !== auth()->id()) {
            abort(403, 'Unauthorized access to this record.');
        }

        $validated = $request->validate([
            'id_users' => 'required|exists:users,id',
            'id_products' => 'required|exists:products,id',
            'status' => 'required|in:good,broken,not taken,pending,fixing,decline',
            'no_serial' => 'required|string|max:255',
            'no_inventaris' => 'required|string|max:255',
            'note_record' => 'nullable|string',
        ]);

        $record->update($validated);

        return redirect()->route('records.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Record::findOrFail($id);
        
        // Check if normal user is trying to delete someone else's record
        if (auth()->user()->level !== 'admin' && $record->id_users !== auth()->id()) {
            abort(403, 'Unauthorized access to this record.');
        }

        // Check if record has any repairs
        if ($record->repairs()->count() > 0) {
            return redirect()->route('records.index')
                ->with('error', 'Cannot delete record #' . $record->id_records . ' because it has ' . $record->repairs()->count() . ' repair(s). Please delete the repairs first.');
        }

        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully!');
    }
}
