<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Malahierba\ChileRut\ChileRut;
use Malahierba\ChileRut\Rules\ValidChileanRut;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::where('name','!=','paciente')->get('id');
        $professionals = User::whereIn('role_id',$role)->get();
        return view('admin.professional.index',compact('professionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.professional.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        $chilerut = new ChileRut;
        if (!$chilerut->check($request->rut))
            return redirect()->back();

        $data = $request->all();
        $name = (new User)->userAvatar($request);
        $data['image'] = $name;
        $data['password'] = bcrypt($request->password);
        $data['rut'] = str_replace('.', '', $data['rut']);

        User::create($data);

        return redirect()->back()->with('message','Profesional Creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professional = User::findorfail($id);
        return view('admin.professional.destroy',compact('professional'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professional = User::find($id);
        return view('admin.professional.edit',compact('professional'));
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
        $this->validateUpdate($request,$id);
        $data = $request->all();
        $professional = User::find($id);
        $imageName = $professional->image;
        $professionalPassword = $professional->password;
        if($request->hasFile('image')){
            $imageName =(new User)->userAvatar($request);
            // unlink(public_path('img/professionals/'.$professional->image));
        }
        $data['image'] = $imageName;
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }else{
            $data['password'] = $professionalPassword;
        }
        $professional->update($data);
        return redirect()->route('professionals.index')->with('message','Profesional Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->id == $id){
            abort(401);
       }
       $professional = User::find($id);
       $professionalDelete = $professional->delete();
       if($professionalDelete){
        unlink(public_path('img/professionals/'.$professional->image));
       }
        return redirect()->route('professionals.index')->with('message','Doctor deleted successfully');
    }

    public function validateStore($request)
    {
        return $this->validate($request,[
            'name' => 'required',
            'lastnames' => 'required',
            'rut' => ['required|unique:users', new ValidChileanRut(new ChileRut)],
            'email' => 'required',
            'password' => 'required|min:6|max:45',
            'gender' => 'required',
            'rut' => 'required',
            'gender' => 'required',
            'role_id' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'department' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
            'education' => 'required',
            'description' => 'required',
        ]);
    }

    public function validateUpdate($request)
    {
        return $this->validate($request,[
            'name' => 'required',
            'lastnames' => 'required',
            'rut' => ['required|unique:users', new ValidChileanRut(new ChileRut)],
            'email' => 'required',
            'gender' => 'required',
            'rut' => 'required',
            'gender' => 'required',
            'role_id' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'department' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'education' => 'required',
            'description' => 'required',
        ]);
    }
}
