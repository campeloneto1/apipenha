<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->perfil->usuarios){
             return response()->json('Não Autorizado', 403);
         }
        return User::orderBy('nome', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::user()->perfil->usuarios_cad){
             return response()->json('Não Autorizado', 403);
         }
        $data = new User;

        $data->nome = $request->nome;   
        $data->cpf = $request->cpf;    
        $data->email = $request->email;    
        $data->telefone1 = $request->telefone1;    
        $data->telefone2 = $request->telefone2;    

        $data->password = bcrypt($request->cpf);

        $data->foto = $request->foto;  

        $data->cep = $request->cep;        
        $data->rua = $request->rua;        
        $data->numero = $request->numero;        
        $data->bairro_id = $request->bairro_id;     

        $data->perfil_id = $request->perfil_id;        

        $data->created_by = Auth::id();      

        if($data->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Cadastrou um usuário';
            $log->table = 'users';
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
    public function show(User $user)
    {
        if(!Auth::user()->perfil->usuarios){
            return response()->json('Não Autorizado', 403);
        }
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(!Auth::user()->perfil->usuarios_edt){
            return response()->json('Não Autorizado', 403);
        }
        $dataold = $user;

        $user->nome = $request->nome;   
        $user->cpf = $request->cpf;    
        $user->email = $request->email;    
        $user->telefone1 = $request->telefone1;    
        $user->telefone2 = $request->telefone2;    

        $user->foto = $request->foto;  

        $user->cep = $request->cep;        
        $user->rua = $request->rua;        
        $user->numero = $request->numero;        
        $user->bairro_id = $request->bairro_id;     

        $user->perfil_id = $request->perfil_id;        
        
        $user->updated_by = Auth::id();      

        if($user->save()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Editou um Usuário';
            $log->table = 'agressores';
            $log->action = 2;
            $log->fk = $user->id;
            $log->object = $user;
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
    public function destroy(User $user)
    {
        if(!Auth::user()->perfil->users_del){
            return response()->json('Não Autorizado', 403);
        }
                 
         if($user->delete()){
            $log = new Log;
            $log->user_id = Auth::id();
            $log->mensagem = 'Excluiu um usurário';
            $log->table = 'users';
            $log->action = 3;
            $log->fk = $user->id;
            $log->object = $user;
            $log->save();
            return response()->json('Informação excluída com sucesso!', 201);
          }else{
            return response()->json("Não foi possivel realizar a exclusão!", 400);
          }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cadastrese(Request $request)
    {
        
        $data = new User;

        $data->nome = $request->nome;   
        $data->cpf = $request->cpf;    
        $data->telefone1 = $request->telefone;   
        $data->password = bcrypt($request->cpf);   

        if($data->save()){
            $log = new Log;
            $log->user_id = $data->id;
            $log->mensagem = 'Usuário se cadastrou pelo app';
            $log->table = 'users';
            $log->action = 1;
            $log->fk = $data->id;
            $log->object = $data;
            $log->save();
            return response()->json('Informação cadastrada com sucesso!', 201);
        }else{
            return response()->json("Não foi possivel realizar o cadastro!", 400);
        }
    }
}
