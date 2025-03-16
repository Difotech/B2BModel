<?php

namespace App\Controllers;

use App\Models\PreventivoModel;
use CodeIgniter\Controller;

class PreventivoController extends Controller
{
    public function faiUnaRichiesta()
    {
        $session = session();
        $preventivoModel = new PreventivoModel();

        // Controlla se l'utente è loggato
        if (!$session->get('logged_in')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Devi essere loggato per inviare una richiesta.']);
        }

        // Ottiene l'ID dell'utente loggato
        $user_id = $session->get('id');

        // Salva solo user_id e data della richiesta
        $preventivoData = [
            'user_id' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $preventivoModel->insert($preventivoData);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Preventivo inviato con successo!']);
    }

    public function listaPreventivi()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $preventivoModel = new PreventivoModel();
        $data['preventivi'] = $preventivoModel->getPreventiviByUser($session->get('id'));

        return view('area_personale/preventivi', $data);
    }
}
