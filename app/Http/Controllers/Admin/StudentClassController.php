<?php

namespace App\Http\Controllers\Admin;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class StudentClassController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = StudentClass::with('user');

            return Datatables::of($query)->addColumn('action', function($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/student-class/edit/' . $item->id . '">
                                    Sunting 
                                </a>
                                <form action="/admin/student-class/destroy/' . $item->id . '" method="POST">
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
        return view('admin.student_class.index',[
            'title' => 'Data Kelas'
        ]);
    }

    public function create()
    {
        return view('admin.student_class.create', [
            'title'   => 'Tambah Data Kelas',
            'users'   => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name'      => 'required|max:255',
            'user_id'   => 'required'
        ]);

        StudentClass::create($validated_data);

        return redirect('admin/student-class')->with('success', 'Data berhasil ditambah');
    }

    public function edit(StudentClass $studentClass)
    {
        return view('admin.student_class.edit', [
            'title'   => 'Tambah Data Kelas',
            'users'   => User::all(),
            'class'   => $studentClass
        ]);
    }

    public function update(Request $request, StudentClass $studentClass)
    {
        $validated_data = $request->validate([
            'name'      => 'required|max:255',
            'user_id'   => 'required'
        ]);

        StudentClass::where('id', $studentClass->id)->update($validated_data);

        return redirect('admin/student-class')->with('success', 'Data berhasil diubah');
    }

    public function destroy(StudentClass $studentClass)
    {
        StudentClass::destroy($studentClass->id);
        return redirect('admin/student-class')->with('success', 'Data telah dihapus!');
    }
}
