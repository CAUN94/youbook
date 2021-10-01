<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Malahierba\ChileRut\ChileRut;
use Malahierba\ChileRut\Rules\ValidChileanRut;


class PollsController extends Controller
{
    public function create()
    {
        return view('polls.create');
    }

    public function success()
    {
        return view('polls.success');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rut' => ['required',new ValidChileanRut(new ChileRut)],
            'pain' => 'required|min:1|max:10',
            'satisfaction' => 'required|min:1|max:5',
            'experience' => 'required|min:1|max:5',
            'friend' => 'required|min:1|max:5]',
        ]);
        $rut = str_replace(' ', '', $request->rut);
        $rut = str_replace('.', '', $rut);
        $rut = str_replace('-', '', $rut);
        $rut = substr($rut,0,-1)."-".substr($rut,-1);

        $poll = Poll::create([
            'rut' => $rut,
            'pain' => intval($request->pain)-1,
            'satisfaction' => $request->satisfaction,
            'experience' => $request->experience,
            'friend' => $request->friend,
            'comment' => $request->comment
        ]);

        return redirect('/success');
    }
}
