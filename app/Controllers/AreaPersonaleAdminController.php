<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\CatalogoModel;
use App\Models\PreventivoModel;
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
        $rules = [
            'nomeprodotto'   => 'required',
            'codiceprodotto' => 'required|is_unique[catalogo.codiceprodotto]',
            'immagine'       => 'required'
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Dati non validi. Controlla i campi e riprova.');
        }
    
        $catalogoModel = new CatalogoModel();
        $newProduct = [
            'nomeprodotto'   => $this->request->getPost('nomeprodotto'),
            'codiceprodotto' => $this->request->getPost('codiceprodotto'),
            'immagine'       => $this->request->getPost('immagine') // Percorso dell'immagine
        ];
    
        if ($catalogoModel->insert($newProduct)) {
            session()->setFlashdata('success', 'Prodotto inserito con successo!');
        } else {
            session()->setFlashdata('error', 'Errore nell’inserimento del prodotto.');
        }
    
        return redirect()->back();
    }
    

public function deleteProduct()
{
    $codiceProdotto = $this->request->getPost('codiceprodotto');

    if (!$codiceProdotto) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Codice prodotto mancante.']);
    }

    $catalogoModel = new CatalogoModel();
    $prodotto = $catalogoModel->where('codiceprodotto', $codiceProdotto)->first();

    if (!$prodotto) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Prodotto non trovato.']);
    }

    $catalogoModel->where('codiceprodotto', $codiceProdotto)->delete();
    
    session()->setFlashdata('success', 'Prodotto eliminato con successo!');
    return $this->response->setJSON(['status' => 'success', 'message' => 'Prodotto eliminato con successo.']);
}

public function updatePreventivoStatus()
{
    if ($this->request->getMethod() === 'post') {
        $idPreventivo = $this->request->getPost('id_preventivo');

        if (!$idPreventivo) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID Preventivo mancante.']);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('preventivi');

        // Correzione: Uso di get() invece di first()
        $query = $builder->where('id', $idPreventivo)->get();
        $preventivo = $query->getRow();

        if (!$preventivo) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Preventivo non trovato.']);
        }

        $builder->where('id', $idPreventivo)->update(['status' => 'Completato']);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Preventivo aggiornato con successo.']);
    }

    return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Azione non consentita']);
}

public function getAllPreventivi()
{
    $preventivoModel = new \App\Models\PreventivoModel();
    $preventivi = $preventivoModel->findAll();

    return $this->response->setJSON([
        'status' => 'success',
        'preventivi' => $preventivi
    ]);
}
}
