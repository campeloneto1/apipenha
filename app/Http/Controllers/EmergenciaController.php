<?php

namespace App\Http\Controllers;

use App\Models\Emergencia;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class EmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Emergencia::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->emergencias_cad){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Emergencia;

        $data->user_id = $request->user_id;   
        $data->data_hora = $request->data_hora;  
        $data->lat = $request->lat;  
        $data->lng = $request->lng;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Emergencia';
            $log->table = 'emergencias';
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
    public function show(Emergencia $emergencia)
    {
        if(!Auth::user()->perfil->emergencias){
            return response()->json('Não Autorizado', 403);
        }
        return $emergencia;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Emergencia $emergencia)
    {
        if(!Auth::user()->perfil->emergencias_edt){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $emergencia;

        $emergencia->nome = $request->nome;   
        $emergencia->cidade_id = $request->cidade_id;
        
        $emergencia->updated_by = Auth::id();      

        if($emergencia->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um emergencia';
            $log->table = 'emergencias';
            $log->action = 2;
            $log->fk = $emergencia->id;
            $log->object = $emergencia;
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
    public function destroy(Emergencia $emergencia)
    {
        if(!Auth::user()->perfil->emergencias_del){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($emergencia->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um emergencia';
            $log->table = 'emergencias';
            $log->action = 3;
            $log->fk = $emergencia->id;
            $log->object = $emergencia;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
