<?php

namespace App\Controllers;

use App\Models\CatalogoModel;
use CodeIgniter\Controller;
use Config\Database;

class CatalogoController extends Controller
{
    // Metodo per il login
    public function login()
    {
        helper(['form', 'url']);
        
        if ($this->request->getMethod() === 'post') {
            // Validazione dei dati del form
            if (! $this->validate([
                'email'    => 'required|valid_email',
                'password' => 'required',
            ])) {
                return view('accesso', ['validation' => $this->validator]);
            }

            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getPost('email'))->first();

            // Verifica credenziali
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                // Imposta la sessione con i dati dell'utente
                $sessionData = [
                    'isLoggedIn' => true,
                    'nome'       => $user['nome'] // Supponendo che la colonna nel DB sia 'nome'
                ];
                session()->set($sessionData);

                return redirect()->to('/area-personale');
            } else {
                return redirect()->to('/login')->with('error', 'Credenziali errate!');
            }
        }

        return view('accesso');
    }
    
    // Metodo per la pagina dell'area personale
    public function areaPersonale()
    {
        // Verifica se l'utente è loggato
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Mostra la pagina dell'area personale con il nome utente
        return view('area_personale', ['nome' => session()->get('nome')]);
    }
}
