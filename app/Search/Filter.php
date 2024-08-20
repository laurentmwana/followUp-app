<?php

namespace App\Search;

use App\Models\Level;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Filter
{
    public function __construct(private Request $request) {}

    public function levels(): LengthAwarePaginator
    {
        $programmeId = $this->request->query->get('programme');

        if ($programmeId !== null && !empty($programmeId)) {

            $programmesIds = Programme::where('name', 'like', "%$programmeId%")
                ->orWhere('alias', 'like', "%$programmeId%")->get('id')->toArray();

            return Level::with(['option', 'programme', 'year'])
                ->whereIn('programme_id', $programmesIds)
                ->orderByDesc('updated_at')
                ->paginate();
        }

        return Level::with(['option', 'programme', 'year'])
            ->orderByDesc('updated_at')
            ->paginate();
    }
}
