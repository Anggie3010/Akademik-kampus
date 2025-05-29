<?php

namespace App\Http\Controllers;

use App\Models\CourseLecture;
use Illuminate\Http\Request;

class CourseLectureController extends Controller
{
    // Tampilkan semua course_lectures
    public function index()
    {
        return response()->json(CourseLecture::with(['course', 'lecturer'])->get());
    }

    // Simpan course_lecture baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lecturer_id' => 'required|exists:lecturers,id',
            'course_id' => 'required|exists:courses,id',
            'role' => 'required|string|max:100',
        ]);

        $courseLecture = CourseLecture::create($validated);

        return response()->json(['message' => 'Course-lecturer relation created successfully']);
    }

    // Detail course_lecture
    public function show($id)
    {
        $courseLecture = CourseLecture::with(['course', 'lecturer'])->findOrFail($id);
        return response()->json($courseLecture);
    }

    // Update course_lecture
    public function update(Request $request, $id)
    {
        $courseLecture = CourseLecture::findOrFail($id);

        $validated = $request->validate([
            'lecturer_id' => 'sometimes|required|exists:lecturers,id',
            'course_id' => 'sometimes|required|exists:courses,id',
            'role' => 'sometimes|required|string|max:100',
        ]);

        $courseLecture->update($validated);

        return response()->json(['message' => 'Course-lecturer relation updated successfully']);
    }

    // Hapus course_lecture
    public function destroy($id)
    {
        $courseLecture = CourseLecture::findOrFail($id);
        $courseLecture->delete();

        return response()->json(['message' => 'Course-lecturer relation deleted successfully']);
    }
}
