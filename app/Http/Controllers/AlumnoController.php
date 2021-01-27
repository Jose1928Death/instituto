<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::paginate(5);
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email' => 'required|email|unique:users,email',
            'telefono' => ['nullable', 'digits:9']
        ]);
        $alumno = new Alumno();
        $alumno->nombre = ucwords($request->nombre);
        $alumno->apellidos = ucwords($request->apellidos);
        $alumno->email = ucwords($request->email);

        if ($request->has('telefono')) $alumno->telefono = $request->telefono;

        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image']
            ]);
            $file = $request->file('foto');
            $nombre = "img/alumnos/" . uniqid() . "_" . $file->getClientOriginalName();
            Storage::Disk("public")->put($nombre, \File::get($file));

            $alumno->foto = "storage/" . $nombre;
        }
        $alumno->save();
        return redirect()->route('alumnos.index')->with('mensaje', "Alumno guardado.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email' => 'required|email|unique:users,email',
            'telefono' => ['nullable', 'digits:9']
        ]);
        $alumno->update([
            'nombre' => ucwords($request->nombre),
            'apellidos' => ucfirst($request->historia),
            'email' => ucwords($request->email),
            'telefono' => $request->telefono
        ]);

        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image']
            ]);
            $fileImagen = $request->file('foto');
            $nombre = "img/alumnos/" . uniqid() . "_" . $fileImagen->getClientOriginalName();
            if (basename($alumno->foto) != "default.png") {
                unlink($alumno->foto);
            }

            Storage::Disk("public")->put($nombre, \File::get($fileImagen));
            $alumno->update(['foto' => "storage/" . $nombre]);
        }

        return redirect()->route('alumnos.index')->with('mensaje', "Alumno actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        $fotoAlumno = basename($alumno->foto);

        if ($fotoAlumno != 'default.png') {
            unlink($alumno->foto);
        }
        $alumno->delete();
        return redirect()->route('alumnos.index')->with("mensaje", "Alumno Borrado correctamente.");
    }
}
