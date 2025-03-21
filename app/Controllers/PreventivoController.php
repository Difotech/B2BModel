<?php

namespace App\Controllers;

use App\Models\PreventivoModel;
use CodeIgniter\Controller;

class PreventivoController extends Controller
{
    public function store()
    {

        if (!session()->has('id')) {
            return redirect()->to('/login')->with('error', 'Devi effettuare il login per inviare un preventivo.');
        }
        
        $request = service('request');

        $rules = [
            'user_id'     => 'required|integer',
            'status'      => 'required|max_length[50]',
            'basepizza'   => 'permit_empty|numeric',
            'vino'      => 'permit_empty|numeric',
            'olio' => 'permit_empty|numeric',
            'panzerotto'    => 'permit_empty|numeric',
            'focacciatondabarese' => 'permit_empty|numeric',
            'focacciacateringbarese' => 'permit_empty|numeric',
            'focacciacateringpomodoro' => 'permit_empty|numeric',
            'orecchiette' => 'permit_empty|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Errore nei dati del preventivo.');
        }

        $model = new PreventivoModel();
        $data = [
            'user_id'     => $request->getPost('user_id'),
            'status'      => $request->getPost('status'),
            'created_at'  => date('Y-m-d H:i:s'),
            'basepizza'   => $request->getPost('basepizza'),
            'vino'      => $request->getPost('vino'),
            'olio' => $request->getPost('olio'),
            'panzerotto'    => $request->getPost('panzerotto'),
            'focacciatondabarese' => $request->getPost('focacciatondabarese'),
            'focacciacateringbarese' => $request->getPost('focacciacateringbarese'),
            'focacciacateringpomodoro' => $request->getPost('focacciacateringpomodoro'),
            'orecchiette' => $request->getPost('orecchiette'),
        ];

        if ($model->insert($data)) {
            session()->setFlashdata('success', 'Preventivo inserito con successo!');
            return redirect()->to(base_url('/faiunarichiesta'));  // Reindirizza alla stessa pagina
        } else {
            session()->setFlashdata('error', 'Errore nell’inserimento del preventivo.');
            return redirect()->to(base_url('/faiunarichiesta')); 
        }
    }

    public function getProdottiCatalogo()
{
    $catalogoModel = new \App\Models\CatalogoModel();
    $prodotti = $catalogoModel->findAll(); // Recupera tutti i prodotti

    return $this->response->setJSON([
        'status' => 'success',
        'prodotti' => $prodotti
    ]);
}

public function eliminaPreventivo()
{
    $preventivoModel = new PreventivoModel();
    $request = $this->request->getJSON();
    $id = $request->id ?? null; // Ottieni l'ID dal corpo della richiesta

    if (!$id || !$preventivoModel->find($id)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Preventivo non trovato!'
        ]);
    }

    if ($preventivoModel->delete($id)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Preventivo eliminato con successo!'
        ]);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Errore durante l\'eliminazione, riprova.'
        ]);
    }
}

}
