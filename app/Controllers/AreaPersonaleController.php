<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AreaPersonaleAdminController extends Controller
{
    public function getUsers($page = 1)
    {
        $perPage = 10; // Numero di utenti per pagina
        $userModel = new UserModel();
        
        $totalUsers = $userModel->countAll(); // Conta tutti gli utenti
        $users = $userModel->orderBy('id', 'ASC')
                           ->paginate($perPage, 'default', $page); // Prendi 10 utenti alla volta

        return $this->response->setJSON([
            'status' => 'success',
            'users' => $users,
            'pager' => $userModel->pager->getDetails() // Dettagli per la paginazione
        ]);
    }
}
