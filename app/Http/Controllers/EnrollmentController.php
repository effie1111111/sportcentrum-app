<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Lesson;

class EnrollmentController extends Controller
{
    public function store(Lesson $lesson)
    {
        if ($lesson->enrollments()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'Je bent al ingeschreven voor deze les.');
        }

        $aantalInschrijvingen = $lesson->enrollments()->count();

        if ($aantalInschrijvingen >= $lesson->max_deelnemers) {
            return back()->with('error', 'Deze les zit helaas vol.');
        }

        Enrollment::create([
            'lesson_id' => $lesson->id,
            'user_id' => auth()->id(),
            'status' => 'ingeschreven',
        ]);

        return back()->with('success', 'Je bent succesvol ingeschreven!');
    }

    public function mijnInschrijvingen()
    {
        $inschrijvingen = Enrollment::with('lesson')
            ->where('user_id', auth()->id())
            ->get();

        return view('lessen.mijn-inschrijvingen', compact('inschrijvingen'));
    
    }
    public function annuleren(Enrollment $enrollment)
{
    if ($enrollment->user_id !== auth()->id()) {
        abort(403);
    }

    $enrollment->delete();

    return back()->with('success', 'Je inschrijving is geannuleerd.');
}
}