<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::all();    
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
        $person = People::create($this->validateRequest());
        return redirect($person->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(People $person)
    {
        $person = People::find();
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
    public function update(Request $request, People $person)
    {      
        $person->update($this->validateRequest());
        return redirect($person->path());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $person)
    {
       $person->delete();
       return redirect('person');
    }

    protected function validateRequest()
    {
        return request()->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'sa_id' => 'required|digits:13',
            'mobile' => 'required|digits:10',
            'email' => 'required|email|unique:people',
            'dob' => 'required|date',
            'language' => 'required',
            'interests' => 'required',
        ]);
    }
}
