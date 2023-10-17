<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estado::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Estado;

        $data->nome = $request->nome;   
        $data->abreviatura = $request->abreviatura;   
        $data->pais_id = $request->pais_id;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Estado';
            $log->table = 'estados';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Informação cadastrada com sucesso!', 201);
        }else{
            return response()->json("Não foi possivel realizar o cadastro!", 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Estado $estado)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        return $estado;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estado $estado)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $estado;

        $estado->nome = $request->nome;   
        $estado->abreviatura = $request->abreviatura;
        $estado->pais_id = $request->pais_id;
        
        $estado->updated_by = Auth::id();      

        if($estado->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Estado';
            $log->table = 'estados';
            $log->action = 2;
            $log->fk = $estado->id;
            $log->object = $estado;
            $log->object_old = $dataold;
            $log->save();
            return response()->json('Informação editada com sucesso!', 201);
        }else{           
            return response()->json("Não foi possivel realizar a edição!", 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estado $estado)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($estado->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Estado';
            $log->table = 'estados';
            $log->action = 3;
            $log->fk = $estado->id;
            $log->object = $estado;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
