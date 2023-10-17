<?php

namespace App\Http\Controllers;

use App\Models\Agressor;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class AgressorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->agressores){
             return response()->json('Não Autorizado', 403);
         }
        return Agressor::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->agressores_cad){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Agressor;

        $data->nome = $request->nome;   
        $data->cpf = $request->cpf;        
        $data->foto = $request->foto;        
        $data->cep = $request->cep;        
        $data->rua = $request->rua;        
        $data->numero = $request->numero;        
        $data->bairro_id = $request->bairro_id;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Agressor';
            $log->table = 'agressores';
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
    public function show(Agressor $agressore)
    {
        if(!Auth::user()->perfil->agressores){
            return response()->json('Não Autorizado', 403);
        }
        return $agressore;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agressor $agressore)
    {
        if(!Auth::user()->perfil->agressores_edt){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $agressore;

        $agressore->nome = $request->nome;   
        $agressore->cpf = $request->cpf;        
        $agressore->foto = $request->foto;        
        $agressore->cep = $request->cep;        
        $agressore->rua = $request->rua;        
        $agressore->numero = $request->numero;        
        $agressore->bairro_id = $request->bairro_id;        
        
        $agressore->updated_by = Auth::id();      

        if($agressore->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Agressor';
            $log->table = 'agressores';
            $log->action = 2;
            $log->fk = $agressore->id;
            $log->object = $agressore;
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
    public function destroy(Agressor $agressore)
    {
        if(!Auth::user()->perfil->agressores_del){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($agressore->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um agressor';
            $log->table = 'agressores';
            $log->action = 3;
            $log->fk = $agressore->id;
            $log->object = $agressore;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
