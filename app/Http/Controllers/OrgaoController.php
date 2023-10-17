<?php

namespace App\Http\Controllers;

use App\Models\Orgao;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class OrgaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Orgao::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if(!Auth::user()->perfil->administrador){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Orgao;

        $data->nome = $request->nome;   
        $data->abreviatura = $request->abreviatura;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Orgão';
            $log->table = 'orgaos';
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
    public function show(Orgao $orgao)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        return $orgao;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orgao $orgao)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $orgao;

        $orgao->nome = $request->nome;   
        $orgao->abreviatura = $request->abreviatura;
        
        $orgao->updated_by = Auth::id();      

        if($orgao->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Orgão';
            $log->table = 'orgaos';
            $log->action = 2;
            $log->fk = $orgao->id;
            $log->object = $orgao;
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
    public function destroy(Orgao $orgao)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($orgao->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Orgão';
            $log->table = 'orgaos';
            $log->action = 3;
            $log->fk = $orgao->id;
            $log->object = $orgao;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
