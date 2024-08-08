<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Search\Search;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\CourseRequest;

class AdminCourseController extends Controller
{

    /**
     * Permet d'afficher toutes les cours
     * @param \App\Search\Search $search
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Search $search): View
    {
        return view('admin.course.index', [
            'courses' => $search->courses(),
        ]);
    }

    /**
     * Permet d'afficher un formulaire de création d'un cours
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.course.create', [
            'course' => new Course(),
        ]);
    }


    /**
     * Permet de créer un cours
     *
     * @param \App\Http\Requests\Admin\CourseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CourseRequest $request): RedirectResponse
    {
        Course::create($request->validated());

        return redirect()->route('~course.index')
            ->with('success', 'cours ajouté');
    }


    /**
     * Permet d'afficher plus d'information sur un cours
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Course $course): View
    {
        return view('admin.course.show', [
            'course' => $course,
        ]);
    }



    /**
     *Permet d'afficher un formulaire d'edition d'un cours
     * @param \App\Models\Course $course
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Course $course): View
    {
        return view('admin.course.edit', [
            'course' => $course,
        ]);
    }

    /**
     * Permet de modifier un cours
     * @param \App\Http\Requests\Admin\CourseRequest $request
     * @param \App\Models\Course $course
     * @return RedirectResponse
     */
    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());

        return redirect()->route('~course.index')
            ->with('success', 'cours modifiée');
    }

    /**
     * Permte de supprimer un cours
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('~course.index')
            ->with('success', 'cours supprimé');
    }
}
