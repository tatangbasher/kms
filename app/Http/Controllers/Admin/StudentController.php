<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentClass;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Student::with('student_class');

            return DataTables::of($query)->addColumn('action', function($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/student/edit/' . $item->id . '">
                                    Sunting 
                                </a>
                                <form action="/admin/student/destroy/' . $item->id . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })->rawColumns(['action'])->make();
        }
        return view('admin.student.index',[
            'title' => 'Data Siswa'
        ]);
    }

    public function create()
    {
        return view('admin.student.create', [
            'title' => 'Tambah Data Siswa',
            'student_classes' => StudentClass::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'student_class_id' => 'required',
            'nis' => 'required|max:255',
            'name' => 'required|max:255',
            'gender' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:255'
        ]);

        Student::create($validated_data);

        return redirect('admin/student')->with('success', 'Data berhasil ditambah');
    }

    public function edit(Student $student)
    {
        return view('admin.student.edit', [
            'title' => 'Ubah Data Siswa',
            'student_classes' => StudentClass::all(),
            'student' => $student
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $validated_data = $request->validate([
            'student_class_id' => 'required',
            'nis' => 'required|max:255',
            'name' => 'required|max:255',
            'gender' => 'required|max:255',
            'address' => 'required',
            'phone' => 'required|max:255'
        ]);

        Student::where('id', $student->id)->update($validated_data);

        return redirect('admin/student')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return redirect('admin/student')->with('success', 'Data telah dihapus!');
    }
}
