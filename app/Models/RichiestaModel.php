<?php

namespace App\Models;
use CodeIgniter\Model;

class RichiestaModel extends Model {
    protected $table = 'richiesta';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'codice_prodotto', 'quantita'];

    public function inserisciRichiesta($email, $prodotti) {
        $data = [];
        
        foreach ($prodotti as $codice => $quantita) {
            if ($quantita > 0) {
                $data[] = [
                    'email' => $email,
                    'codice_prodotto' => $codice,
                    'quantita' => $quantita
                ];
            }
        }

        if (!empty($data)) {
            return $this->insertBatch($data); // Inserisce più righe contemporaneamente
        }
        
        return false;
    }
}
