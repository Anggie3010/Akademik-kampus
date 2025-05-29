<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Tampilkan semua course
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    // Simpan course baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string',
            'credit' => 'required|string|max:10',
            'semester' => 'required|string|max:20',
        ]);

        $course = Course::create($validated);

        return response()->json(['message' => 'Course created successfully']);
    }

    // Tampilkan detail course
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    // Update data course
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => "sometimes|required|string",
            'credit' => 'sometimes|required|string|max:10',
            'semester' => 'sometimes|required|string|max:20',
        ]);

        $course->update($validated);

        return response()->json(['message' => 'Course updated successfully']);
    }

    // Hapus course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }
}
