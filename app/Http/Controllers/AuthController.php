<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function authentication() {
        return view('auth.login_form');
    }

    public function logout() {
        Session::flush();

        return Redirect::to(route('home'));
    }

    public function login(Request $req) {
        Session::start();
        $dl = new DataLayer();
        $user_name = $dl->getUserName($req->input('email'));

        if ($user_name != null) {
            if ($dl->validUser($req->input('email'), $req->input('password'))) {
                Session::put('logged', true);
                Session::put('loggedName', $user_name);
                Session::put('loggedEmail', $req->input('email'));


                if($dl->isAdmin($req->input(('email')))) {
                    Session::put('admin', true);
                    return Redirect::to(route('admin.index'));
                } else {
                    Session::put('admin', false);
                    return Redirect::to(route('client.index'));
                }
            }
        }

        return view('auth.authErrorPage');
    }

    public function registerUser(Request $req) {
        $dl = new DataLayer();

        // verifica che l'email non sia già presente
        $userExist = $dl -> checkUserAlreadyExist($req->input('email'));
        // verifica che psw e confirm_psw siano uguali
        $passwordsEqual = $req->input('password') == $req->input('password_confirmation');

        if($userExist) {
            $error = 'Email già presente.';
            $view = view('auth.registration_form', compact('error'))->render();
            //return view('auth.registration_form')->with('error', 'Email già presente.');
        } else if(!$passwordsEqual) {
            $error = 'Le password non corrispondono.';
            $view = view('auth.registration_form', compact('error'))->render();
            //return view('auth.registration_form')->with('error', 'Le password non corrispondono');
        } else {
            $dl->addUser($req->input('firstname'), $req->input('lastname'), $req->input('phone'), $req->input('email'), $req->input('password'));

            $success = 'Registrazione avvenuta con successo.';
            $view = view('auth.registration_form', compact('success'))->render();
            //return view('auth.registration_form')->with('success', 'Registrazione avvenuta con successo.');
        }

        return response()->json(['corpo' => $view]);
    }

    public function registration() {
        $view = view('auth.registration_form')->render();

        return response()->json(['corpo' => $view]);
    }
}
