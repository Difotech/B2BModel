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


    public function eliminaPreventivo()
{
    $session = session();

    // Se l'utente non è loggato, restituisci errore
    if (!$session->get('isLoggedIn')) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Utente non autenticato'
        ]);
    }

    // Ottieni i dati dalla richiesta JSON
    $json = $this->request->getJSON();
    $id = $json->id ?? null;

    if (!$id) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'ID non valido'
        ]);
    }

    $preventivoModel = new PreventivoModel();

    // Verifica che il preventivo appartenga all'utente loggato
    $userId = $session->get('id');
    $preventivo = $preventivoModel->where('id', $id)->where('user_id', $userId)->first();

    if (!$preventivo) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Preventivo non trovato o non autorizzato'
        ]);
    }

    // Elimina il preventivo
    if ($preventivoModel->delete($id)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Preventivo eliminato con successo'
        ]);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Errore durante l\'eliminazione'
        ]);
    }
}

}
