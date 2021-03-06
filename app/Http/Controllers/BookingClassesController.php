<?php

namespace App\Http\Controllers;


use App\Models\BookingTrain;
use App\Models\TrainAppointments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BookingClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainAppointments = TrainAppointments::orderBy('date', 'DESC')->get();
        return view('admin.bookingtrain.index',compact('trainAppointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan' => 'required',
            'class' => "required|not_in:'null'",
            'date' => 'required|not_in:null',
            'time' => 'required|not_in:null',
            'train' => "required|not_in:'null'"
        ])->validate();

        $trainAppointment = new TrainAppointments([
            'training_id' => $request->plan,
            'name' => $request->class,
            'places' => 20,
            'status' => 0,
            'date' => $request->date,
            'time' => $request->time,
            'trainer_id' => $request->train
        ]);
        $trainAppointment->save();
        return redirect()->back();
    }

    public function multistore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan' => 'required',
            'class' => "required|not_in:'null'",
            'iteration' => "required|not_in:null",
            'date' => 'required|not_in:null',
            'time' => 'required|not_in:null',
            'train' => "required|not_in:'null'"
        ])->validate();

        $date = Carbon::createFromFormat('Y-m-d', $request->date);
        for ($i=0; $i < $request->iteration; $i++) {

            $trainAppointment = new TrainAppointments([
                'training_id' => $request->plan,
                'name' => $request->class,
                'places' => 20,
                'status' => 0,
                'date' => $date->format('Y-m-d'),
                'time' => $request->time,
                'trainer_id' => $request->train
            ]);

            $trainAppointment->save();
            $date = $date->addWeeks(1);
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainAppointment = TrainAppointments::find($id);
        $trainAppointment->delete();
        BookingTrain::where('train_appointment_id',$id)->delete();
        return redirect()->back();
    }
}
