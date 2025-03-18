<?php

namespace App\Models;

use CodeIgniter\Model;

class PreventivoModel extends Model
{
    protected $table = 'preventivi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'status',
        'created_at',
        'basepizza',
        'puccia',
        'pinsaromana',
        'ciabatta',
        'focacciatondabarese', // ✅ Corretto il nome del campo
        'focacciacateringbarese',
        'focacciacateringpomodoro',
        'focacciacateringbianca'
    ];
}
