<?php

namespace App\Http\Controllers;

use App\files;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = DB::table("files")->get();

        return view("files",[
            "files" => $files
        ]);
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
        $file = $request->file("file");

        $nombre = $file->getClientOriginalName();

        $file->move("storage",$nombre);
        $ruta = $nombre;

        DB::table("files")->insert([
            "titulo" => $request["titulo"],
            "descripcion" => $request["descripcion"],
            "file_url" => $ruta
        ]);

        return redirect("/files");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\files  $files
     * @return \Illuminate\Http\Response
     */
    public function show(files $files)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\files  $files
     * @return \Illuminate\Http\Response
     */
    public function edit(files $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\files  $files
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, files $files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          DB::table("files")->where("id_files",$request["id"])->delete();

          return "200";
    }
}
