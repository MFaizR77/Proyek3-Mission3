<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function courses()
    {
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }

    public function coursesCreate()
    {
        return view('admin.courses_create');
    }

    public function coursesStore(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:100',
            'credits' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
            'semester' => 'nullable|string|max:50',
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function students()
    {
        $students = Student::with('user')->get();
        return view('admin.students', compact('students'));
    }

    // Tampilkan form tambah mahasiswa
    public function studentsCreate()
    {
        return view('admin.students_create');
    }

    //  Simpan mahasiswa baru
    public function studentsStore(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|unique:users,username|max:50',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|string|min:8|confirmed',
            'entry_year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        $validated['role'] = 'mahasiswa';

        $user = User::create([
            'full_name' => $validated['full_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_active' => 1,
        ]);

        Student::create([
            'user_id' => $user->user_id,
            'entry_year' => $validated['entry_year'],
        ]);

        return redirect()->route('admin.students')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function studentsEdit(Student $student)
    {
        return view('admin.students_edit', compact('student'));
    }

    //  Simpan perubahan
    public function studentsUpdate(Request $request, Student $student)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $student->user->user_id . ',user_id',
            'email' => 'required|email|max:100|unique:users,email,' . $student->user->user_id . ',user_id',
            'entry_year' => 'required|integer|min:2000|max:' . date('Y'),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = $student->user;
        $user->update([
            'full_name' => $validated['full_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        $student->update(['entry_year' => $validated['entry_year']]);

        return redirect()->route('admin.students')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // delete student and related user
    public function studentsDelete(Student $student)
    {
        // Hapus relasi user dulu 
        $user = $student->user;
        $student->delete();
        $user->delete(); // Hapus user juga

        return back()->with('success', value: 'Mahasiswa dan akun terkait berhasil dihapus.');
    }
}