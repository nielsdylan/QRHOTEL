<?php

namespace App\Http\Controllers\Modulo\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function login(){
        return view('modulos.auth.login');
    }
    public function session(Request $request){
        $credenciales = [
            'email'=> $request->email,
            'password'=> $request->password
        ];
        if (Auth::attempt($credenciales)) {
            // return Auth::user();
            $this->sesionHotel(Auth::user()->id);
            return redirect()->intended('home');
        }
        return redirect('login')->with('status','Credenciales incorrectas');

        // return response()->json(["data"=>$request->all()],200);
    }
    public function logout(){
        $this->sesionHotel(Auth::user()->id);
        Session::flush();
        Auth::logout();
        return redirect()->intended('login');
    }
    // el proceso limpia el hotel que se selecciono a nivel de base de datos y a nivel de sesion
    public function sesionHotel($id) {
        $user = User::find($id); // Obtén el usuario autenticado
        $user->hotel_sesion = 0; // Asigna el nuevo valor al campo
        $user->save();
        Auth::user()->hotel_sesion = 0;
    }
}
