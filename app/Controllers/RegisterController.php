<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends Controller {

    public function register() {
        helper(['form']);  // Attiva gli helper per i form

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nome'            => 'required|min_length[3]|max_length[100]',
                'email'           => 'required|valid_email|is_unique[users.email]',
                'password'        => 'required|min_length[6]',
                'confirm_password' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                return view('register', ['validation' => $this->validator]);
            }

            // Collegamento al database e preparazione dei dati
            $userModel = new UserModel();
            $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $userData = [
                'nome'     => $this->request->getPost('nome'),
                'email'    => $this->request->getPost('email'),
                'password' => $passwordHash,
            ];

            $userModel->registerUser($userData);

            return redirect()->to('/accesso')->with('success', 'Registrazione completata!');
        }

        return view('register');
    }
}
