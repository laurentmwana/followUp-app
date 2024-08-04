<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('admin.dashboard.index', [
            ...$this->getParametersView(),
            'delibe' => (new JsonResponse([
                'okStudent' => 120,
                'failStudent' => 100,
            ]))->getContent()
        ]);
    }

    /**
     * @return array
     */
    private function getParametersView(): array
    {
        return [
            'facultiesCount' => 12,
            'departmentsCount' => 1000232,
            'optionsCount' => 2547,
            'levelsCount' => 74596,
        ];
    }
}
