<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use App\Models\Annual;
use App\Models\Course;
use App\Models\Option;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Deliberated;
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

        if ($levelId === null) {
            return [
                'okStudent' => Deliberated::where('annual_id', '!=', null)
                    ->where('decision', '=', 'Admis')->count('id'),
                'failStudent' => Deliberated::where('annual_id', '!=', null)
                    ->where('decision', '=', 'Reprend')->count('id'),
            ];
        }
        $annualIds = Annual::whereLevelId($levelId)
            ->pluck('id')->toArray();

        $deliberated = Deliberated::whereIn(
            'annual_id',
            $annualIds
        );

        return [
            'okStudent' => $deliberated !== null ? $deliberated->where('decision', '=', 'Admis')->count('id') : 0,
            'failStudent' => $deliberated !== null ? $deliberated->where('decision', '=', 'Reprend')->count('id') : 0,
        ];
    }
}
