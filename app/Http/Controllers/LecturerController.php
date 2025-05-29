<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    // Tampilkan semua data lecture
    public function index()
    {
        return response()->json(Lecturer::all());
    }

    // Simpan lecturer baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:lecturers',
            'NIP' => 'required|string|max:100',
            'departement' => 'required|string|max:255',
        ]);

        $lecturer = Lecturer::create($validated);

        return response()->json(['message' => 'Lecturer created successfully']);
    }

    // Tampilkan detail lecturer
    public function show($id)
    {
        $lecturer = Lecturer::findOrFail($id);
        return response()->json($lecturer);
    }

    // Update data lecturer
    public function update(Request $request, $id)
    {
        $lecturer = Lecturer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => "sometimes|required|email|unique:lecturers,email,{$id}",
            'NIP' => "sometimes|required|string|max:100",
            'departement' => 'sometimes|required|string|max:255',
        ]);

        $lecturer->update($validated);

        return response()->json(['message' => 'Lecturer updated successfully']);
    }

    // Hapus lecturer
    public function destroy($id)
    {
        $lecturer = Lecturer::findOrFail($id);
        $lecturer->delete();

        return response()->json(['message' => 'Lecturer deleted successfully']);
    }
}
