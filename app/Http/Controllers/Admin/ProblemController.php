<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Problem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProblemController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Problem::query();

            return DataTables::of($query)->addColumn('action', function($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/problem/edit/' . $item->id . '">
                                    Sunting 
                                </a>
                                <form action="/admin/problem/destroy/' . $item->id . '" method="POST">
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
        return view('admin.problem.index', [
            'title' => 'Permasalahan'
        ]);
    }

    public function create()
    {
        return view('admin.problem.create', [
            'title' => 'Tambah Permasalahan'
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name'      => 'required|max:255',
            'priority'  => 'required'
        ]);

        Problem::create($validated_data);

        return redirect('admin/problem')->with('success', 'Data berhasil ditambah');
    }

    public function edit(Problem $problem)
    {
        return view('admin.problem.edit', [
            'title'   => 'Ubah Data Permasalahan',
            'problem'   => $problem
        ]);
    }

    public function update(Request $request, Problem $problem)
    {
        $validated_data = $request->validate([
            'name'      => 'required|max:255',
            'priority'   => 'required'
        ]);

        Problem::where('id', $problem->id)->update($validated_data);

        return redirect('admin/problem')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Problem $problem)
    {
        Problem::destroy($problem->id);
        return redirect('admin/problem')->with('success', 'Data telah dihapus!');
    }
}
