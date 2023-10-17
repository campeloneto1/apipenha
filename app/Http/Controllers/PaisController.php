<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pais::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Pais;

        $data->nome = $request->nome;   
        $data->abreviatura = $request->abreviatura;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um País';
            $log->table = 'paises';
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
    public function show(Pais $paise)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        return $paise;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pais $paise)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $paise;

        $paise->nome = $request->nome;   
        $paise->abreviatura = $request->abreviatura;
        
        $paise->updated_by = Auth::id();      

        if($paise->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um País';
            $log->table = 'paises';
            $log->action = 2;
            $log->fk = $paise->id;
            $log->object = $paise;
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
    public function destroy(Pais $paise)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($paise->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um País';
            $log->table = 'paises';
            $log->action = 3;
            $log->fk = $paise->id;
            $log->object = $paise;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
