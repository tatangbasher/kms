<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counseling;
use App\Models\Problem;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CounselingController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Counseling::with('problems', 'student', 'student.student_class');

            return DataTables::of($query)->addColumn('action', function($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/counseling/show/' . $item->id . '">
                                    Lihat 
                                </a>
                                <a class="dropdown-item" href="/admin/counseling/edit/' . $item->id . '">
                                    Sunting 
                                </a>
                                <form action="/admin/counseling/destroy/' . $item->id . '" method="POST">
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
        return view('admin.counseling.index', [
            'title' => 'Bimbingan dan Konseling'
        ]);
    }

    public function create()
    {
        return view('admin.counseling.create', [
            'title' => 'Tambah Bimbingan dan Konseling',
            'students' => Student::all(),
            'problems' => Problem::all()
        ]);
    }

    public function find_nis(Request $request)
    {
        $student = Student::with('student_class', 'counselings')->findOrFail($request->id);
        return response()->json($student);
    }

    public function store(Request $request)
    {
        $counseling = new Counseling();
        $counseling->student_id = $request->student_id;
        $counseling->user_id = Auth::user()->id;     
        $counseling->save(); 

        if ($request->has('problem_id')) { 
            $counseling->problems()->attach($request->problem_id);
        }

        return redirect('admin/counseling')->with('success', 'Data berhasil ditambah');
    }

    public function show(Counseling $counseling)
    {
        $counseling = Counseling::with('student', 'problems')->findOrFail($counseling->id);
        return view('admin.counseling.show', [
            'title' => 'Detail Bimbingan Konseling',
            'counseling' => $counseling
        ]);
    }

    public function edit(Counseling $counseling)
    {
        return view('admin.counseling.edit', [
            'title' => 'Ubah Bimbingan dan Konseling',
            'students' => Student::all(),
            'problems' => Problem::all(),
            'counseling' => $counseling
        ]);
    }

    public function update(Request $request, Counseling $counseling)
    {
        //
    }

    public function destroy(Counseling $counseling)
    {
        Counseling::destroy($counseling->id);
        return redirect('admin/counseling')->with('success', 'Data telah dihapus!');
    }
}
