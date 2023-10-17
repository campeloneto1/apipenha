<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class BairroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Bairro::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Bairro;

        $data->nome = $request->nome;   
        $data->cidade_id = $request->cidade_id;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Bairro';
            $log->table = 'bairros';
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
    public function show(Bairro $bairro)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        return $bairro;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bairro $bairro)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $bairro;

        $bairro->nome = $request->nome;   
        $bairro->cidade_id = $request->cidade_id;
        
        $bairro->updated_by = Auth::id();      

        if($bairro->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Bairro';
            $log->table = 'bairros';
            $log->action = 2;
            $log->fk = $bairro->id;
            $log->object = $bairro;
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
    public function destroy(Bairro $bairro)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($bairro->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um Bairro';
            $log->table = 'bairros';
            $log->action = 3;
            $log->fk = $bairro->id;
            $log->object = $bairro;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
