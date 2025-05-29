<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    // Tampilkan detail student
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    // Simpan data student baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'NIM' => 'required|string|max:50',
            'major' => 'required|string',
            'enrollment_year' => 'required|date',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $student = Student::create($validated);

        return response()->json(['message' => 'Student created successfully']);
    }

    // Update student
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => "sometimes|required|email|unique:students,email,{$id}",
            'NIM' => 'sometimes|required|string|max:50',
            'major' => 'sometimes|required|string',
            'enrollment_year' => 'sometimes|required|date',
            'password' => 'nullable|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $student->update($validated);

        return response()->json(['message' => 'Student updated successfully']);
    }

    // Hapus student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
