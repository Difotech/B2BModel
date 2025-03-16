<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PreventivoModel;

class AreaPersonaleController extends Controller
{
    public function index()
    {
        $session = session();

        // Se l'utente non è loggato, reindirizza al login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Ottieni l'ID dell'utente loggato dalla sessione
        $userId = $session->get('id');

        // Istanzia il model per la tabella 'preventivi'
        $preventivoModel = new PreventivoModel();

        // Filtra i preventivi in base all'utente loggato
        $richieste = $preventivoModel->where('user_id', $userId)->findAll();

        // Passa i dati alla vista 'area-personale.php'
        $data['richieste'] = $richieste;

        // Carica la vista con i dati
        return view('area-personale', $data);
    }
}
