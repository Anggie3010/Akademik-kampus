<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Tampilkan semua enrollment
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])->get();
        return response()->json($enrollments);
    }

    // Simpan enrollment baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'grade' => 'required|string|max:10',
            'attendance' => 'required|string|max:50',
            'status' => 'required|string|max:50',
        ]);

        $enrollment = Enrollment::create($validated);

        return response()->json([
            'message' => 'Enrollment created successfully',
            'data' => $enrollment
        ], 201);
    }

    // Tampilkan detail enrollment
    public function show($id)
    {
        $enrollment = Enrollment::with(['student', 'course'])->findOrFail($id);
        return response()->json($enrollment);
    }

    // Update enrollment
    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'sometimes|required|exists:students,id',
            'course_id' => 'sometimes|required|exists:courses,id',
            'grade' => 'sometimes|required|string|max:10',
            'attendance' => 'sometimes|required|string|max:50',
            'status' => 'sometimes|required|string|max:50',
        ]);

        $enrollment->update($validated);

        return response()->json(['message' => 'Enrollment updated successfully']);
    }

    // Hapus enrollment
    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return response()->json(['message' => 'Enrollment deleted successfully']);
    }
}
