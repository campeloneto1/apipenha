<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Perfil::orderBy('nome')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->administrador){
             return response()->json('Não Autorizado', 403);
         }
        $data = new Perfil;

        $data->nome = $request->nome;   
        $data->administrador = $request->administrador;        
        $data->gestor = $request->gestor;        
        $data->relatorios = $request->relatorios; 

        $data->agressores = $request->agressores; 
        $data->agressores_cad = $request->agressores_cad;        
        $data->agressores_edt = $request->agressores_edt; 
        $data->agressores_del = $request->agressores_del; 

        $data->denuncias = $request->denuncias; 
        $data->denuncias_cad = $request->denuncias_cad;        
        $data->denuncias_edt = $request->denuncias_edt; 
        $data->denuncias_del = $request->denuncias_del; 

        $data->emergencias = $request->emergencias; 
        $data->emergencias_cad = $request->emergencias_cad;        
        $data->emergencias_edt = $request->emergencias_edt; 
        $data->emergencias_del = $request->emergencias_del; 

        $data->usuarios = $request->usuarios; 
        $data->usuarios_cad = $request->usuarios_cad;        
        $data->usuarios_edt = $request->usuarios_edt; 
        $data->usuarios_del = $request->usuarios_del; 

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um Perfil';
            $log->table = 'perfis';
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
    public function show(Perfil $perfi)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        return $perfi;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perfil $perfi)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $perfi;

        $perfi->nome = $request->nome;   
        $perfi->administrador = $request->administrador;
        $perfi->gestor = $request->gestor;
        $perfi->relatorios = $request->relatorios;

        $perfi->agressores = $request->agressores; 
        $perfi->agressores_cad = $request->agressores_cad;        
        $perfi->agressores_edt = $request->agressores_edt; 
        $perfi->agressores_del = $request->agressores_del; 

        $perfi->denuncias = $request->denuncias; 
        $perfi->denuncias_cad = $request->denuncias_cad;        
        $perfi->denuncias_edt = $request->denuncias_edt; 
        $perfi->denuncias_del = $request->denuncias_del; 

        $perfi->emergencias = $request->emergencias; 
        $perfi->emergencias_cad = $request->emergencias_cad;        
        $perfi->emergencias_edt = $request->emergencias_edt; 
        $perfi->emergencias_del = $request->emergencias_del; 

        $perfi->usuarios = $request->usuarios; 
        $perfi->usuarios_cad = $request->usuarios_cad;        
        $perfi->usuarios_edt = $request->usuarios_edt; 
        $perfi->usuarios_del = $request->usuarios_del; 
        
        $perfi->updated_by = Auth::id();      

        if($perfi->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Perfil';
            $log->table = 'perfis';
            $log->action = 2;
            $log->fk = $perfi->id;
            $log->object = $perfi;
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
    public function destroy(Perfil $perfi)
    {
        if(!Auth::user()->perfil->administrador){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($perfi->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um perfil';
            $log->table = 'perfis';
            $log->action = 3;
            $log->fk = $perfi->id;
            $log->object = $perfi;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }
}
