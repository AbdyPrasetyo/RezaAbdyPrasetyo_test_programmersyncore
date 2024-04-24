<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\Education;
use App\Models\JobHistory;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {

        $userId = Auth::id();

        // Mengambil data Biodata milik pengguna yang saat ini login dengan relasi education, jobHistory, dan training
        $biodata = Biodata::with('education', 'jobHistory', 'training')
            ->where('user_id', $userId)
            ->get();


            if ($biodata->isEmpty()) {
                // Jika tidak ada data biodata, Anda dapat menangani kasus ini di sini,
                // misalnya dengan menampilkan pesan atau mengarahkan ke halaman pengisian biodata.
                return redirect()->route('biodata.create')->with('warning', 'Please fill in your biodata first.');
            }

            // Jika data biodata ditemukan, lewatkan ke view 'cv'
            return view('cv', compact('biodata'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('biodata');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255',
        'posisi_dilamar' => 'required|string|max:255',
        'education.*.tingkat_pendidikan' => 'required|string|max:255',
        'education.*.nama_institusi' => 'required|string|max:255',
        'education.*.tahun_lulus' => 'required|integer',
        'job_history.*.nama_perusahaan' => 'required|string|max:255',
        'job_history.*.posisi' => 'required|string|max:255',
        'job_history.*.tahun_mulai' => 'required|integer',
        'job_history.*.tahun_selesai' => 'nullable|integer',
        'training.*.nama_pelatihan' => 'required|string|max:255',
        'training.*.penyelenggara' => 'required|string|max:255',
        'training.*.tanggal_pelatihan' => 'required|date',
    ], [
        // Custom validation messages can be added here for better user feedback
    ]);

    try {
        // Use automatic transaction handling provided by Laravel
        DB::transaction(function () use ($request) {
            $biodata = auth()->user()->biodata()->create($request->only(['nama', 'tanggal_lahir', 'tempat_lahir', 'posisi_dilamar']));

            $biodata->education()->createMany($request->education);
            $biodata->jobHistory()->createMany($request->job_history);
            $biodata->training()->createMany($request->training);
        });

        return redirect()->route('biodata.index')->with('success', 'Biodata has been created successfully.');
    } catch (\Exception $e) {
        // Log the full exception for debugging purposes
        \Log::error($e);

        // Redirect back with errors and old input
        return back()->withErrors(['error' => 'Error creating biodata. Please try again.'])->withInput();
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
