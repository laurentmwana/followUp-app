<?php

namespace App\Search;

use App\Models\Note;
use App\Models\User;
use App\Models\Year;
use App\Models\Group;
use App\Models\Level;
use App\Models\Course;
use App\Models\Option;
use App\Enums\RoleEnum;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Assistant;
use App\Models\Professor;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class Search
{
    public function __construct(private Request $request) {}

    public function faculty(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query  === null
            ? Faculty::with(['departments'])
            ->orderByDesc('updated_at')
            ->paginate()
            : (Faculty::with(['departments']))
            ->where('name', 'like', "%$query%")
            ->orWhere('created_at', 'like', "%$query%")
            ->orWhere('updated_at', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }

    public function departments(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? Department::with(['faculty'])
            ->orderByDesc('updated_at')
            ->paginate()
            : Department::with(['faculty'])
            ->where('name', 'like', "%$query%")
            ->orWhere('alias', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }

    public function options(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? option::with(['department'])
            ->orderByDesc('updated_at')
            ->paginate()
            : option::with(['department'])
            ->where('name', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }

    public function students(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? Student::with(['levels'])
            ->orderByDesc('updated_at')
            ->paginate()
            : Student::with(['level'])
            ->where('name', 'like', "%$query%")
            ->orWhere('firstname', 'like', "%$query%")
            ->orWhere('phone', 'like', "%$query%")
            ->orWhere('happy', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }


    public function groups(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? Group::with(['category', 'semester'])
            ->orderByDesc('updated_at')
            ->paginate()
            : Group::with(['category', 'semester'])
            ->where('name', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }



    public function professors(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? Professor::with(['courses'])
            ->orderByDesc('updated_at')
            ->paginate()
            : Professor::with(['courses'])
            ->where('name', 'like', "%$query%")
            ->orWhere('firstname', 'like', "%$query%")
            ->orWhere('sex', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }



    public function courses(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? Course::with(['level', 'semester', 'group'])
            ->orderByDesc('updated_at')
            ->paginate()
            : Course::with(['level', 'semester', 'group'])
            ->where('name', 'like', "%$query%")
            ->orWhere('credits', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }


    public function notes(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? Note::with(['student', 'course', 'semester', 'year'])
            ->orderByDesc('updated_at')
            ->paginate()
            : Note::with(['student', 'course', 'semester', 'year'])
            ->where('note', 'like', "%$query%")
            ->orWhere('course_id', 'like', "%$query%")
            ->orWhere('year_id', 'like', "%$query%")
            ->orWhere('semester_id', 'like', "%$query%")
            ->orWhere('student_id', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }


    public function users(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? User::with(['student'])
            ->where('role', '!=', RoleEnum::ROLE_ADMIN->value)
            ->orderByDesc('updated_at')
            ->paginate()
            : User::with(['student'])
            ->where('role', '!=', RoleEnum::ROLE_ADMIN->value)
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }

    public function years(): LengthAwarePaginator
    {
        $query = $this->request->query->get('query');

        return $query === null
            ? Year::with(['levels'])
            ->orderByDesc('updated_at')
            ->orderByDesc('state')
            ->paginate()
            : Year::with(['levels'])
            ->orWhere('start', 'like', "%$query%")
            ->orWhere('end', 'like', "%$query%")
            ->orWhere('state', 'like', "%$query%")
            ->orderByDesc('updated_at')
            ->paginate();
    }
}
