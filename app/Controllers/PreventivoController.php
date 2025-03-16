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
        $request = $this->request->getJSON();

        // Controlla se l'utente è loggato
        $userId = $session->get('isLoggedIn') ? $session->get('id') : null;
        $email = isset($request->email) ? $request->email : null;

        if (!$userId && !$email) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Devi essere loggato o fornire un’email.'
            ]);
        }

        // Creazione dell'array dati per il preventivo
        $datiPreventivo = [
            'user_id' => $userId,
            'email' => $email,
            'status' => 'in attesa',
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Inizializza i campi della tabella con valore 0
        $prodottiDisponibili = [
            'basepizza', 'puccia', 'pinsaromana', 'ciabatta',
            'focciatondabarese', 'focciacateringbarese', 'focciacateringpomodoro', 'focciacateringbianca'
        ];

        foreach ($prodottiDisponibili as $prodotto) {
            $datiPreventivo[$prodotto] = 0; // Valore di default
        }

        // Aggiorna la quantità per i prodotti richiesti
        foreach ($request->prodotti as $prodotto) {
            $colonna = strtolower(str_replace(' ', '', $prodotto->nome)); // Converti nome in colonna
            if (in_array($colonna, $prodottiDisponibili)) {
                $datiPreventivo[$colonna] = intval($prodotto->quantita);
            }
        }

        // Inserisci il preventivo nel database
        if ($preventivoModel->insert($datiPreventivo)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Preventivo inviato con successo!'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Errore durante il salvataggio, riprova.'
            ]);
        }
    }
}

