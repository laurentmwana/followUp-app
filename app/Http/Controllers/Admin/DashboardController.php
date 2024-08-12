<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Level;
use App\Models\Course;
use App\Models\Option;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Deliberation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('admin.dashboard.index', [
            ...$this->getParametersView(),
            'delibe' => $this->getDelibe($request->query('level')),
        ]);
    }

    /**
     * @return array
     */
    private function getParametersView(): array
    {
        return [
            'optionCount' => Option::count('id'),
            'levelCount' => Level::count('id'),
            'studentCount' => Student::count('id'),
            'courseCount' => Course::count('id'),
            'professorCount' => Professor::count('id'),
        ];
    }

    private function getDelibe(?string $levelId): string | false
    {
        $delibe = $this->getOrderDelibe($levelId);

        return ($delibe['okStudent'] === 0 && $delibe['failStudent'] === 0)
            ? false
            : (new JsonResponse($delibe))
            ->getContent();
    }

    private function getOrderDelibe(?string $levelId): array
    {
        return [
            'okStudent' => 12,
            'failStudent' => 5
        ];
        // return (null === $levelId || empty($levelId))
        //     ? [
        //         'okStudent' => Deliberation::where('pourcent', '>', 49)->count('id'),
        //         'failStudent' => Deliberation::where('pourcent', '<=', 49)->count('id'),
        //     ]
        //     : [
        //         'okStudent' => Deliberation::whereLevelId($levelId)
        //             ->where('pourcent', '>', 49)->count('id'),
        //         'failStudent' => Deliberation::whereLevelId($levelId)
        //             ->where('pourcent', '<=', 49)->count('id'),
        //     ];
    }
}
