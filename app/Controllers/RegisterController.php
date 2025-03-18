<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends Controller {

    public function register() {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nome'            => 'required|min_length[3]|max_length[100]',
                'email'           => 'required|valid_email|is_unique[users.email]',
                'piva'            => 'required|exact_length[11]|numeric',  // Validazione P.IVA
                'password'        => 'required|min_length[6]',
                'confirm_password' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                return view('register', ['validation' => $this->validator]);
            }

            $userModel = new UserModel();
            $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $userData = [
                'nome'     => $this->request->getPost('nome'),
                'email'    => $this->request->getPost('email'),
                'piva'     => $this->request->getPost('piva'),  // Salva P.IVA
                'password' => $passwordHash,
            ];

            $userModel->insert($userData);
            session()->setFlashdata('success', 'Registrazione completata con successo!');
            return redirect()->to('/login');
        }

        return view('register');
    }
}
