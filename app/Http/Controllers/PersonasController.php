<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreatePersonaRequest;

class PersonasController extends Controller
{
    public function index()
    {
        $personas = Personas::get();

        return view('personas', compact('personas'));
    }

    public function show($nPerCodigo){
        return view('show',[
            'persona' => Personas::find($nPerCodigo)
        ]);
    }

    
    public function create(){
        return view('create',[
            'persona' => new Personas
        ]);
    }
    
    public function store(CreatePersonaRequest $request){
        
        #Personas::create($request->validated());
        $persona = new Personas($request->validated());
        $persona->image = $request->file('image')->store('images');
        $persona->save();
        return redirect()->route('personas.index')->with('estado','La persona fue creada correctamente');
    }

    public function edit(Personas $persona){
        return view('edit',[
            'persona' => $persona,
        ]);
    }

    public function update(Personas $persona, CreatePersonaRequest $request){
        #$persona->update($request->validated());
        if($request->hasFile('image') ){
            Storage::delete($persona->image); //LE PASAMOS LA UBICACIÓN DE LA IMAGEN
            $persona->fill($request->validated() ); //Rellena todos los datos sin guardarlos
            $persona->image = $request->file('image')->store('images'); //Le asignamos la imagen que sube
            $persona->save(); //Finalmente guardamos en la Base de datos
        } else{
            $persona->update( array_filter($request->validated()) );
        }
        
	    return redirect()->route('personas.show',$persona)->with('estado', 'La persona fue actualizada correctamente');
    }


    public function destroy(Personas $persona){
        
        Storage::delete($persona->image); //LE PASAMOS LA UBICACIÓN DE LA IMAGEN

        $persona->delete();
        
	    return redirect()->route('personas.index')->with('estado','La persona fue eliminada correctamente');
    }

    public function __construct(){
        //$this->middleware('auth')->only('create','edit');
        $this->middleware('auth')->except('index','show');

    }
}
