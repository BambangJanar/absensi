<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Nampilin daftar semua hari libur
     */
    public function index()
    {
        $holidays = Holiday::latest()->paginate(10);
        return view('admin.holidays.index', compact('holidays'));
    }

    /**
     * Nampilin form tambah hari libur baru
     */
    public function create()
    {
        return view('admin.holidays.create');
    }

    /**
     * Nyimpen data hari libur baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input dengan aturan ketat
        $request->validate([
            'date' => 'required|date|unique:holidays,date',
            'description' => 'required|string|max:255',
        ]);

        Holiday::create($request->all());

        return redirect()->route('holidays.index')
                         ->with('success', '🎉 Hari libur berhasil ditambahkan!');
    }

    /**
     * Nampilin form edit hari libur
     */
    public function edit(Holiday $holiday)
    {
        return view('admin.holidays.edit', compact('holiday'));
    }

    /**
     * Update data hari libur yang udah ada
     */
    public function update(Request $request, Holiday $holiday)
    {
        $request->validate([
            'date' => 'required|date|unique:holidays,date,' . $holiday->id,
            'description' => 'required|string|max:255',
        ]);

        $holiday->update($request->all());

        return redirect()->route('holidays.index')
                         ->with('success', 'Hari libur berhasil diperbarui!');
    }

    /**
     * Hapus data hari libur
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return redirect()->route('holidays.index')
                         ->with('success', 'Hari libur berhasil dihapus!');
    }
}