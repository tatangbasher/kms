<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counseling;
use App\Models\Problem;
use Illuminate\Http\Request;
use stdClass;

class SolutionController extends Controller
{
    public function index()
    {
        return view('admin.solution.index', [
            'title' => 'Pencarian Solusi Masalah',
            'problems' => Problem::all()
        ]);
    }

    private function calculate_total_weight()
    {
        $total_weight = 0;

        $problems = Problem::get('priority');

        foreach ($problems as $problem) {
            $total_weight += $problem->priority;
        }

        return $total_weight;
    }

    private function calculate_weight()
    {
        $weight = 0;
        
        $validated_data = request()->validate([
            'problem' => 'required'
        ]);

        //$selected_problem = Problem::whereIn('id', [request()->problem])->get('priority');
        
        //foreach ($problems as $problem) {
            //$weight += $problem->priority;
        //}

        for ($i = 0; $i < count($validated_data); $i++) { dd(count($validated_data));
            while ($data_gejala_kasus = mysqli_fetch_array($result_gejala_kasus)) {
                if ($pilihan[$i] == $data_gejala_kasus['id_gejala']) {
                    $id_gejala = $data_gejala_kasus['id_gejala'];

                    $pembilang += (1 * $bobot[$id_penyakit][$id_gejala]);
                    // $penyebut += $bobot[$id_penyakit][$id_gejala];
                }
            }

            mysqli_data_seek($result_gejala_kasus, 0);
        }

        return $weight;
    }

    public function show_solution() 
    {

        $this->calculate_weight();
        //dd($this->case_based_reasoning());
        //$problems =Problem::whereIn('id', [request()->get('problem')])->get('priority');
        //dd(Problem::whereIn('id', [request()->get('problem')])->get('priority'));
        return view('admin.solution.result', [
            'title' => 'Hasil Pencarian Masalah'
            //'problems' => Problem::whereIn('id', [request()->get('problem')])->get()
        ]);
    }

    private function case_based_reasoning()
    {
        $weight = $this->calculate_weight();
        $total_weight = $this->calculate_total_weight();

        return number_format($weight / $total_weight, 2) * 100;
    }
}
