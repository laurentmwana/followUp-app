<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dean;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\DeanRequest;

class AdminCategoryController extends Controller
{
    /**
     * Permet d'afficher toutes les categories
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request): View
    {
        $id = $request->query->get('id');

        if (null !== $id && !empty($id)) {
            return view('admin.category.show', [
                'category' => Category::findOrFail($id),
            ]);
        }

        return view('admin.category.index', [
            'categories' => Category::orderByDesc('updated_at')->get(),
        ]);
    }
}
