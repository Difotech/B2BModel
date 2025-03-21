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
                // ✅ Imposta la sessione con il ruolo dell'utente
                $sessionData = [
                    'isLoggedIn' => true,
                    'id'         => $user['id'],
                    'nome'       => $user['nome'],
                    'ruolo'       => $user['ruolo'] ?? 'user' // ✅ Se NULL, assegna "user"
                ];
                session()->set($sessionData);
    
                // ✅ Reindirizza in base al ruolo
                if ($sessionData['ruolo'] === 'admin') {
                    return redirect()->to('/area-personale-admin'); // ✅ Area per admin
                } else {
                    return redirect()->to('/area-personale'); // ✅ Area per utenti normali
                }
            } else {
                return redirect()->to('/login')->with('error', 'Credenziali errate!');
            }
        }
    
        return view('login');
    }

    public function logout() {
        // Rimuove le variabili specifiche della sessione
        session()->remove('isLoggedIn');
        session()->remove('userId');
        session()->remove('userName');
    
        // Distrugge completamente la sessione
        session()->destroy();
    
        return redirect()->to('/login')->with('message', 'Sei stato disconnesso con successo.');
    }
    
  public function areaPersonale()
{
    $session = session();

    if (!$session->get('isLoggedIn')) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Utente non autenticato'
        ]);
    }

    // ✅ Controlla il ruolo
    if ($session->get('ruolo') === 'admin') {
        return redirect()->to('/area-personale-admin'); // ✅ Reindirizza all'area admin
    }

    // Recupera i preventivi solo per utenti normali
    $userId = $session->get('id');
    $preventivoModel = new PreventivoModel();
    $richieste = $preventivoModel->where('user_id', $userId)->findAll();

    return $this->response->setJSON([
        'status' => 'success',
        'data' => $richieste
    ]);
}

    
    

    
}
    
