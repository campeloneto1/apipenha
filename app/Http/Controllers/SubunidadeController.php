<?php

namespace App\Http\Controllers;

use App\Models\Subunidade;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class SubunidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Subunidade::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Subunidade;

        $data->nome = $request->nome;   
        $data->abreviatura = $request->abreviatura;  
        $data->unidade_id = $request->unidade_id;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Subunidade';
            $log->table = 'subunidades';
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
    public function show(Subunidade $subunidade)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        return $subunidade;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subunidade $subunidade)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $subunidade;

        $subunidade->nome = $request->nome;   
        $subunidade->abreviatura = $request->abreviatura;
        $subunidade->unidade_id = $request->unidade_id;
        
        $subunidade->updated_by = Auth::id();      

        if($subunidade->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Subunidade';
            $log->table = 'unidades';
            $log->action = 2;
            $log->fk = $subunidade->id;
            $log->object = $subunidade;
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
    public function destroy(Subunidade $subunidade)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($subunidade->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma Subunidade';
            $log->table = 'subunidades';
            $log->action = 3;
            $log->fk = $subunidade->id;
            $log->object = $subunidade;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
