<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccesoRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AutenticarController extends Controller
{
    //REGISTAR EL USUARIO
    public function registro(RegistroRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();


        return response()->json([
            'res' => true,
            'msg' => 'User resgistrad'
        ], 200);
    }

    //LOGIN ACCESO

    public function login(AccesoRequest $request){

        $user = User::where('email', $request->email)->first();
        //BUSCA EL USUARIO POR MEDIO DEL EMAIL INGRESADO Y TOMA EL PRIMER CAMPO Y LO GUARDA EN $USER

        if (! $user || ! Hash::check($request->password, $user->password)) {
            //SI NO EXISTE EL USUARIO O LA CONTRASEÑA NO ES IGUAL
        throw ValidationException::withMessages([ //EXCEPT DE VALID
            'email' => ['Las credenciales son incorrectas.'],
        ]);
    }

    $token = $user->createToken($request->email)->plainTextToken;

    return response()->json([
        'res' => true,
        'token' => $token
    ],200);

    }

    //SALIR DEL SISTEMA LOGOUT --ELIMINAR TOKEN

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        //ELIMINAR EL TOKEN DEL USUARIO
        return response()->json([
            'res' => true,
            'msg' => 'Sesion cerrada'
        ]);

    }

}
