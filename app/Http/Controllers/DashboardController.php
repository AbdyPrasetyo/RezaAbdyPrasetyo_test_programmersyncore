<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Training;
use App\Models\Education;
use App\Models\JobHistory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
               // Memuat data biodata dengan relasi education, jobHistory, dan training
    $biodata = Biodata::with('education', 'jobHistory', 'training')->get();

    // Memastikan urutan ID tidak tertukar
    $biodata = $biodata->sortBy('user_id');
        return view('dashboard', compact('biodata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $biodata = Biodata::with('education', 'jobHistory', 'training')->findOrFail($id);

        return view('show', compact('biodata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
