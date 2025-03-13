<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogoModel extends Model
{
    protected $table = 'catalogo'; // Sostituisci con il nome effettivo della tua tabella
    protected $primaryKey = 'codiceprodotto';
    protected $allowedFields = ['nomeprodotto', 'codiceprodotto', 'immagine'];
}
