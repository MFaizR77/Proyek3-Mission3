<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\Takes;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        // Jika user adalah mahasiswa, ambil data student-nya
        if (session('role') == 'mahasiswa') {
            $student = Student::where('user_id', session('user_id'))->first();
            $enrolledCourses = $student ? $student->courses : collect();
            return view('dashboard.student', compact('courses', 'enrolledCourses'));
        }

        // Jika admin
        return view('dashboard.admin', compact('courses'));
    }

    // Enroll course (hanya untuk mahasiswa)
    public function enroll(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer|exists:courses,course_id',
        ]);

        $student = Student::where('user_id', session('user_id'))->first();
        if (!$student) {
            return back()->withErrors(['error' => 'Data mahasiswa tidak ditemukan.']);
        }

        $courseId = $request->course_id;
        $course = Course::find($courseId);
        if (!$course) {
            return back()->withErrors(['error' => 'Mata kuliah tidak ditemukan.']);
        }

        if (Takes::where('student_id', $student->student_id)->where('course_id', $courseId)->exists()) {
            return back()->withErrors(['error' => 'Anda sudah terdaftar di mata kuliah ini.']);
        }

        try {
            Takes::create([
                'student_id' => $student->student_id,
                'course_id' => $courseId,
                'enroll_date' => now(),
            ]);
            \Log::info('Enrollment created successfully.');
        } catch (\Exception $e) {
            \Log::error('Enrollment failed:', [
                'error' => $e->getMessage(),
                'student_id' => $student->student_id,
                'course_id' => $courseId,
            ]);
            return back()->withErrors(['error' => 'Gagal mendaftar. Silakan coba lagi.']);
        }

        return back()->with('success', 'Berhasil mendaftar mata kuliah!');
    }

    public function enrollView()
    {
        $student = Student::where('user_id', session('user_id'))->first();
        $courses = Course::all();
        $enrolledCourses = $student ? $student->courses : collect();

        return view('mahasiswa.enroll', compact('courses', 'enrolledCourses'));
    }

    public function viewCourses()
    {
        $student = Student::where('user_id', session('user_id'))->first();
        $enrolledCourses = $student ? $student->courses : collect();

        return view('mahasiswa.view_courses', compact('enrolledCourses'));
    }
}