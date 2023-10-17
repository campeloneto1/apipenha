<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class DenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->denuncias){
             return response()->json('Não Autorizado', 403);
         }
        return Denuncia::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->denuncias_cad){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Denuncia;

        $data->tipo = $request->tipo;   
        $data->vitima = $request->vitima;        
        $data->user_id = $request->user_id;        
        $data->agressor = $request->agressor;        
        $data->agressor_id = $request->agressor_id;        
        $data->cep = $request->cep;        
        $data->rua = $request->rua;  
        $data->numero = $request->numero;  
        $data->bairro_id = $request->bairro_id;  
        $data->narrativa = $request->narrativa;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou uma Denuncia';
            $log->table = 'denuncias';
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
    public function show(Denuncia $denuncia)
    {
        if(!Auth::user()->perfil->denuncias){
            return response()->json('Não Autorizado', 403);
        }
        return $denuncia;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Denuncia $denuncia)
    {
        if(!Auth::user()->perfil->denuncias_edt){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $denuncia;

        $denuncia->tipo = $request->tipo;   
        $denuncia->vitima = $request->vitima;        
        $denuncia->user_id = $request->user_id;        
        $denuncia->agressor = $request->agressor;        
        $denuncia->agressor_id = $request->agressor_id;        
        $denuncia->cep = $request->cep;        
        $denuncia->rua = $request->rua;  
        $denuncia->numero = $request->numero;  
        $denuncia->bairro_id = $request->bairro_id;  
        $denuncia->narrativa = $request->narrativa;        
        
        $denuncia->updated_by = Auth::id();      

        if($denuncia->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou uma Denuncia';
            $log->table = 'denuncias';
            $log->action = 2;
            $log->fk = $denuncia->id;
            $log->object = $denuncia;
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
    public function destroy(Denuncia $denuncia)
    {
        if(!Auth::user()->perfil->denuncias_del){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($denuncia->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu uma denuncia';
            $log->table = 'denuncias';
            $log->action = 3;
            $log->fk = $denuncia->id;
            $log->object = $denuncia;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
