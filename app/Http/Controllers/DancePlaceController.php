<?php

namespace App\Http\Controllers;

use App\Models\DancePlace;
use Illuminate\Http\Request;

class DancePlaceController extends Controller
{
    // Menampilkan daftar studio
    public function index()
    {
        $dancePlaces = DancePlace::latest()->get();

        return view('admin-studios', compact('dancePlaces'));
    }

    // Menampilkan form tambah studio
    public function create()
    {
        return view('create-studio');
    }

    // Menyimpan studio baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        DancePlace::create($validated);

        return redirect()
            ->route('admin.studios.index')
            ->with('success', 'Studio berhasil ditambahkan!');
    }

    // Menampilkan form edit studio
    public function edit($id)
    {
        $dancePlace = DancePlace::findOrFail($id);

        return view('edit-studio', compact('dancePlace'));
    }

    // Memperbarui data studio
    public function update(Request $request, $id)
    {
        $dancePlace = DancePlace::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        $dancePlace->update($validated);

        return redirect()
            ->route('admin.studios.index')
            ->with('success', 'Studio berhasil diperbarui!');
    }

    // Menghapus studio
    public function destroy($id)
    {
        $dancePlace = DancePlace::findOrFail($id);

        $dancePlace->delete();

        return redirect()
            ->route('admin.studios.index')
            ->with('success', 'Studio berhasil dihapus!');
    }
}