<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
  public function index()
{
    $lessen = Lesson::with('begeleider')
        ->withCount('enrollments')
        ->get();

    return view('lessen.index', compact('lessen'));
}
    

    public function create()
    {
        return view('lessen.aanmaken');
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'datum' => 'required|date',
            'begintijd' => 'required',
            'eindtijd' => 'required',
            'locatie' => 'required|string|max:255',
            'max_deelnemers' => 'required|integer|min:1',
        ]);

        Lesson::create([
            'naam' => $request->naam,
            'datum' => $request->datum,
            'begintijd' => $request->begintijd,
            'eindtijd' => $request->eindtijd,
            'locatie' => $request->locatie,
            'max_deelnemers' => $request->max_deelnemers,
            'begeleider_id' => auth()->id(),
        ]);

        return redirect()->route('lessen.index');
    }
}