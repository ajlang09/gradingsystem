<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\ClassesRecord;

class RankingController extends Controller
{
    public function index()
    {
        $id = auth()->id();
        $subjects = Subject::where('user_id', $id)->get();

        $classes  = ClassesRecord::whereHas('subjects', function($query) use ($id) {
            $query->where('user_id', $id);
        })->get();

        return view('modules.rank.index',compact('classes', 'subjects'));
    }

    public function ranking(Request $request)
    {
        $data = $request->all();
        $ranking = [];

        $gradeQuery = Grade::whereHas('class', function($query) use ($data) {
            $query->where('year', $data['year']);
            if ($data['semester']) {
                $query->where('semester', $data['semester']);
            }
        })->where('term', 'total');

        $type     = $data['type'];
        $semester = $data['semester'];

        if ($type) {
            $filterType = explode('-', $type);
            if ('class' == $filterType[0]) {
                $gradeQuery->where('class_id', $filterType[1]);
            }else if ('subject' == $filterType[0]) {
                $gradeQuery->where('subject_id', $filterType[1]);
            }
        }

        // $gradeQuery
        $ranking = $this->groupRanking($gradeQuery->get(), $type);

        return response()->json($ranking);
    }

    protected function groupRanking($grades)
    {
        $ranking = [];
        $group = [];
        $labels = [
            [
                'rank' => "Dean's Lister",
                'grade' => [
                    'lower' => 92,
                    'high' => 94.99,
                ],
            ],
            [
                'rank' => "Presidents's Lister",
                'grade' => [
                    'lower' => 95,
                    'high' => 100,
                ],
            ],
        ];

        foreach ($grades as $grade) {
            if (!isset($group[$grade->student_id])) {
                $group[$grade->student_id]['student'] = $grade->student()->first();
            }

            $group[$grade->student_id]['grades'][] = $grade;
        }

        foreach ($group as $key => $groupData) {
            $class = [];

            foreach ($groupData['grades'] as $grade) {
                $class[$grade->class_id][] = $grade;
            }

            $group[$key]['class'] = $class;
        }

        $studentYearGwa = [];

        foreach ($group as $groupGrades) {
            $studentModel = $groupGrades['student'];

            // term count per year
            // if (2 != sizeof($groupGrades['grades'])) {
            //     continue;
            // }

            $gwa = $this->getTotalGwa($groupGrades['grades']);

            $rank = '';

            foreach ($labels as $label) {
                $grade = $label['grade'];
                if ($rank) {
                    continue;
                }
                if ($grade['lower'] <= $gwa && $gwa <= $grade['high']) {
                    $rank = $label['rank'];
                }
            }

            if (!$rank) {
                continue;
            }

            $studentYearGwa[] = [
                'student' => $studentModel,
                'gwa' => $gwa,
                'rank' => $rank,
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

        return number_format($totalGwa / sizeof($grades), 2);
    }
}
