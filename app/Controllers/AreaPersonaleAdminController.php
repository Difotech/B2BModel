<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\CatalogoModel;

class AreaPersonaleAdminController extends Controller
{
    public function getUsers()
    {
        $userModel = new UserModel();
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
        
        $totalUsers = $userModel->countAllResults();
        $totalPages = ceil($totalUsers / $perPage);
        $users = $userModel->orderBy('id', 'ASC')->paginate($perPage, 'default', $page);

        return $this->response->setJSON([
            'status' => 'success',
            'users' => $users,
            'total_pages' => $totalPages,
        ]);
    }

    public function deleteUser()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');

            if (!$email) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email non valida']);
            }

            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();

            if (!$user) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Utente non trovato']);
            }

            $userModel->where('email', $email)->delete();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Utente eliminato con successo']);
        }

        return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Azione non consentita']);
    }

    public function addProduct()
{
    helper(['form']);

    if ($this->request->getMethod() === 'post') {
        $rules = [
            'nomeprodotto'   => 'required|min_length[3]|max_length[255]',
            'codiceprodotto' => 'required|is_unique[catalogo.codiceprodotto]',
            'immagine'       => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Dati non validi.');
        }

        $catalogoModel = new CatalogoModel();
        $newProduct = [
            'nomeprodotto'   => $this->request->getPost('nomeprodotto'),
            'codiceprodotto' => $this->request->getPost('codiceprodotto'),
            'immagine'       => $this->request->getPost('immagine') // Percorso dell'immagine
        ];

        $catalogoModel->insert($newProduct);
        return redirect()->back()->with('success', 'Prodotto caricato con successo!');
    }

    return redirect()->back()->with('error', 'Errore durante il caricamento.');
}
}
