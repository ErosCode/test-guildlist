<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Char;

class CharController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Char::select('*', \DB::raw("chars.id as charId"))
        ->join('classes', 'chars.classe', '=', 'classes.name')
        ->get();
        //orderBy('char_pseudo', 'DESC')
        
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
        $newChar = new Char;
        $newChar->char_pseudo = $request->char["char_pseudo"];
        $newChar->race = $request->char["race"];
        $newChar->classe = $request->char["classe"];
        $newChar->spec = $request->char["spec"];
        $newChar->armor = $request->char["armor"];
        $newChar->proprietaire = $request->char["proprietaire"];
        $newChar->detail = $request->char["detail"];
        $newChar->save();
        return $newChar;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Char::find($id);
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
        $existingChar = Char::find( $id );

        if( $existingChar ) {
            $existingChar->char_pseudo = $request->char["char_pseudo"];
            $existingChar->race = $request->char["race"];
            $existingChar->classe = $request->char["classe"];
            $existingChar->spec = $request->char["spec"];
            $existingChar->armor = $request->char["armor"];
            $existingChar->proprietaire = $request->char["proprietaire"];
            $existingChar->detail = $request->char["detail"];
            $existingChar->save();
            return $existingChar;
        }

        return "Personnage non trouvé!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingChar = Char::find( $id );
        if( $existingChar ) {
            $existingChar->delete();
            return 'Personnage supprimé';
        }

        return "Personnage non trouvé";
    }
}
