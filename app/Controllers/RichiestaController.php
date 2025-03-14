<?php

namespace App\Controllers;

use App\Models\RichiestaModel;
use CodeIgniter\Controller;

class RichiestaController extends Controller
{
    public function faiUnaRichiesta()
    {
        // Carichiamo gli helper per form e URL
        helper(['form', 'url']);

        // Se il form è stato inviato in POST
        if ($this->request->getMethod() === 'post') {
            $codiceprodotto = $this->request->getPost('codiceprodotto');
            $note           = $this->request->getPost('note');

            // Verifichiamo se l'utente è loggato
            // Se hai salvato in session il 'userId' o un campo simile
            $user_id = session()->get('userId'); // Se non esiste, risulta NULL

            // Salvataggio richiesta
            $richiestaModel = new RichiestaModel();
            $richiestaData = [
                'user_id'        => $user_id,        // NULL se non loggato
                'codiceprodotto' => $codiceprodotto,
                'note'           => $note
            ];

            $richiestaModel->insert($richiestaData);

            // Messaggio di successo e redirect
            return redirect()->to('/faiunarichiesta')
                             ->with('success', 'Richiesta inviata correttamente!');
        }

        // Se è una GET, mostriamo il form
        return view('faiunarichiesta');
    }
}
