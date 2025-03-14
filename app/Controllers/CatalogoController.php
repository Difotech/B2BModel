<?php

namespace App\Controllers;

use App\Models\CatalogoModel;
use CodeIgniter\Controller;

class CatalogoController extends Controller
{
    public function index()
    {
        $model = new CatalogoModel();

        // Recupera tutti i prodotti dal database
        $prodotti = $model->findAll();

        // Restituisce i dati in formato JSON
        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $prodotti
        ]);
    }
}
