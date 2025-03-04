<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';  // Assicurati che questa tabella esista nel database
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'password'];

    // Metodo per registrare un nuovo utente
    public function registerUser($data) {
        return $this->insert($data);
    }
}