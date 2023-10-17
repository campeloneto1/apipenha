<?php

namespace App\Http\Controllers;

use App\Models\SubunidadeBairro;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class SubunidadeBairroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return SubunidadeBairro::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
             return response()->json('Não Autorizado', 403);
         }
        $data = new SubunidadeBairro;

        $data->subunidade_id = $request->subunidade_id;   
        $data->bairro_id = $request->bairro_id;  

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um bairro na Subunidade';
            $log->table = 'subunidades_bairros';
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
    public function show(SubunidadeBairro $subunidades_bairro)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        return $subunidades_bairro;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubunidadeBairro $subunidades_bairro)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $subunidades_bairro;

        $subunidades_bairro->nome = $request->nome;   
        $subunidades_bairro->cidade_id = $request->cidade_id;
        
        $subunidades_bairro->updated_by = Auth::id();      

        if($subunidades_bairro->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Bairro de uma Subunidade';
            $log->table = 'subunidades_bairros';
            $log->action = 2;
            $log->fk = $subunidades_bairro->id;
            $log->object = $subunidades_bairro;
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
    public function destroy(SubunidadeBairro $subunidades_bairro)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($subunidades_bairro->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um bairro de uma subunidade';
            $log->table = 'subunidades_bairros';
            $log->action = 3;
            $log->fk = $subunidades_bairro->id;
            $log->object = $subunidades_bairro;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
