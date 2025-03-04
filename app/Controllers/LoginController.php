<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends Controller {

    public function login() {
        helper(['form', 'url']);
        
        if ($this->request->getMethod() === 'post') {
            // Validazione dei dati del form
            if (! $this->validate([
                'email'    => 'required|valid_email',
                'password' => 'required',
            ])) {
                // Passa la variabile di validazione alla vista in caso di errori
                return view('pages/accesso', ['validation' => $this->validator]);
            }

            // Recupera l'utente dal database
            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getPost('email'))->first();

            // Verifica credenziali
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                // Imposta la sessione di login
                session()->set('isLoggedIn', true);
                session()->set('userId', $user['id']);
                session()->set('userName', $user['nome']);
                return redirect()->to('/area-personale');
            } else {
                // Messaggio di errore per credenziali sbagliate
                return redirect()->to('/login')->with('error', 'Credenziali errate!');
            }
        }

        // Mostra la vista del login senza errori
        return view('pages/accesso');
    }

    // Logout: Rimuove la sessione e reindirizza alla pagina di login
    public function logout() {
        session()->remove('isLoggedIn');
        session()->remove('userId');
        session()->remove('userName');
        return redirect()->to('/login');
    }
}
