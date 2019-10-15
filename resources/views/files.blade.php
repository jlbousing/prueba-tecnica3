@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Archivos</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <table class="table-responsive-lg" style="border: #1d2124 solid 3px">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Operaciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr style="border: #1d2124 solid 3px">
                                        <th scope="row">{{$file->id_files}}</th>
                                        <td style="border: #1d2124 solid 3px">{{$file->titulo}}</td>
                                        <td style="border: #1d2124 solid 3px">{{$file->descripcion}}</td>

                                        <td style="border: #1d2124 solid 3px">
                                            <a href="{{'/storage/'. $file->file_url}}"><button class="btn btn-warning">Acceder</button></a>
                                            <button class="btn btn-danger" @click="deleteFile({{$file->id_files}})">Eliminar</button>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>



                            <br>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-lg-12">
                                    @if(Auth::user()->fk_rol == 1)
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#registarUsuario">Agregar Archivo</button>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="registarUsuario" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar Archivo</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-group" method="post" action="guardarArchivo" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf

                            <label>Titulo</label>
                            <input class="form-control" name="titulo" required="">
                            <br>
                            <label>Descripcion</label>
                            <input class="form-control" name="descripcion" required="">
                            <br>
                            <label>Archivo</label>
                            <input type="file" class="form-control" name="file">
                            <br>
                            <input  type="submit" class="btn btn-primary" value="Enviar">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
