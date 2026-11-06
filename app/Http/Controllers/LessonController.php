<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LessonController extends Controller
{
    public function index()
    {
        $query = Lesson::with('begeleider')
            ->withCount('enrollments');

        if (auth()->user()->role === 'begeleider') {
            $query->where('begeleider_id', auth()->id());
        }

        $lessen = $query
            ->orderBy('datum')
            ->orderBy('begintijd')
            ->get();

        return view('lessen.index', compact('lessen'));
    }

    public function create()
    {
        $this->onlyAllowAdmin();

        $begeleiders = User::where('role', 'begeleider')
            ->orderBy('name')
            ->get();

        return view('lessen.aanmaken', compact('begeleiders'));
    }

    public function store(Request $request)
    {
        $this->onlyAllowAdmin();

        $data = $request->validate([
            'naam' => ['required', 'string', 'max:255'],
            'datum' => ['required', 'date'],
            'begintijd' => ['required'],
            'eindtijd' => ['required'],
            'locatie' => ['required', 'string', 'max:255'],
            'max_deelnemers' => ['required', 'integer', 'min:1'],
            'begeleider_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where(fn ($query) => $query->where('role', 'begeleider')),
            ],
        ]);

        Lesson::create($data);

        return redirect()
            ->route('lessen.index')
            ->with('success', 'De les is aangemaakt.');
    }

    public function destroy(Lesson $lesson)
    {
        $this->onlyAllowAdmin();

        $lesson->delete();

        return redirect()
            ->route('lessen.index')
            ->with('success', 'De les en bijbehorende inschrijvingen zijn verwijderd.');
    }

    private function onlyAllowAdmin(): void
    {
        $user = auth()->user();

        abort_unless(
            $user && ($user->role === 'admin' || $user->rol === 'beheerder'),
            403
        );
    }
}