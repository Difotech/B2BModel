<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogoModel extends Model
{
    protected $table = 'catalogo';
    protected $primaryKey = 'codiceprodotto';
    protected $allowedFields = ['nomeprodotto', 'codiceprodotto', 'immagine'];
}
