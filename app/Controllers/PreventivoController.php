<?php

namespace App\Controllers;

use App\Models\PreventivoModel;
use CodeIgniter\Controller;

class PreventivoController extends Controller
{
    public function store()
    {
        $request = service('request');

        $rules = [
            'user_id'     => 'required|integer',
            'status'      => 'required|max_length[50]',
            'basepizza'   => 'permit_empty|numeric',
            'puccia'      => 'permit_empty|numeric',
            'pinsaromana' => 'permit_empty|numeric',
            'ciabatta'    => 'permit_empty|numeric',
            'focacciatondabarese' => 'permit_empty|numeric',
            'focacciacateringbarese' => 'permit_empty|numeric',
            'focacciacateringpomodoro' => 'permit_empty|numeric',
            'focacciacateringbianca' => 'permit_empty|numeric',
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
            'puccia'      => $request->getPost('puccia'),
            'pinsaromana' => $request->getPost('pinsaromana'),
            'ciabatta'    => $request->getPost('ciabatta'),
            'focacciatondabarese' => $request->getPost('focacciatondabarese'),
            'focacciacateringbarese' => $request->getPost('focacciacateringbarese'),
            'focacciacateringpomodoro' => $request->getPost('focacciacateringpomodoro'),
            'focacciacateringbianca' => $request->getPost('focacciacateringbianca'),
        ];

        if ($model->insert($data)) {
            return redirect()->back()->with('success', 'Preventivo inserito con successo!');
        } else {
            return redirect()->back()->with('error', 'Errore nell’inserimento del preventivo.');
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
