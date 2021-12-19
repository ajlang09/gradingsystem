<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class RankingController extends Controller
{
    public function index()
    {
        return view('modules.rank.index');
    }

    public function ranking(Request $request)
    {
        $data = $request->all();
        $ranking = [];
        $grades = Grade::whereHas('class', function($query) use ($data) {
            $query->where('year', $data['year']);
        })->where('type','gwa')->get();

        $ranking = $this->groupRanking($grades);

        return response()->json($ranking);
    }

    protected function groupRanking($grades)
    {
        $ranking = [];
        $group = [];

        foreach ($grades as $grade) {

            if (!isset($group[$grade->student_id])) {
                $group[$grade->student_id]['student'] = $grade->student()->first();
            }            

            $group[$grade->student_id]['grades'][] = $grade;
        }

        $studentYearGwa = [];

        foreach ($group as $groupGrades) {
            $studentModel = $groupGrades['student'];
            
            // term count per year
            if (2 != sizeof($groupGrades['grades'])) {
                continue;
            }

            $gwa = $this->getTotalGwa($groupGrades['grades']);

            $studentYearGwa[] = [
                'student' => $studentModel, 
                'gwa' => $gwa, 
            ];
        }
        
        usort($studentYearGwa, function($a, $b) {
            return $b['gwa'] <=> $a['gwa'];
        });
        
        return response()->json($studentYearGwa);
    }

    protected function getTotalGwa($grades)
    {
        $totalGwa = 0;

        foreach ($grades as $grade) {
            $totalGwa += $grade->grade;
        }

        return $totalGwa / sizeof($grades);
    }
}
