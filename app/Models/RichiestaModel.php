<?php

namespace App\Models;

use CodeIgniter\Model;

class RichiestaModel extends Model
{
    protected $table      = 'richieste';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'codiceprodotto',
        'note',
        'created_at',
        'updated_at'
    ];

    // Se vuoi usare i timestamps automatici di CI4
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
