<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PreventivoModel; 
use CodeIgniter\Controller;

class LoginController extends Controller
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
                return view('login', ['validation' => $this->validator]);
            }

            $userModel = new UserModel();
            $user = $userModel->where('email', $this->request->getPost('email'))->first();

            // Verifica credenziali
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                // Imposta la sessione con i dati dell'utente
                $sessionData = [
                    'isLoggedIn' => true,
                    'id'         => $user['id'],
                    'nome'       => $user['nome'] // Supponendo che la colonna nel DB sia 'nome'
                ];
                session()->set($sessionData);

                return redirect()->to('/area-personale');
            } else {
                return redirect()->to('/login')->with('error', 'Credenziali errate!');
            }
        }

        return view('login');
    }

    public function logout() {
        session()->remove('isLoggedIn');
        session()->remove('userId');
        session()->remove('userName');
        return redirect()->to('/login');
    }
    
        public function areaPersonale()
        {
            $session = session();
    
            // Controlla se l'utente è loggato
            if (!$session->get('isLoggedIn')) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Utente non autenticato'
                ]);
            }
    
            // Recupera l'ID dell'utente loggato
            $userId = $session->get('id');
    
            // Istanzia il modello PreventivoModel
            $preventivoModel = new PreventivoModel();
    
            // Recupera i preventivi associati all'utente loggato
            $richieste = $preventivoModel->where('user_id', $userId)->findAll();
    
            // Restituisce i dati in formato JSON
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $richieste
            ]);
        }
    
    

    
}
    
