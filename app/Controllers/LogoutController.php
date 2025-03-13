<?php

namespace App\Controllers;

use CodeIgniter\Controller;

public function logout() {
    log_message('debug', 'Logout function called - Destroying session');
    session()->remove('isLoggedIn');
    session()->remove('nome');
    session()->destroy();

    // Controllo della sessione
    if (session()->has('isLoggedIn')) {
        log_message('debug', 'Session still exists');
    } else {
        log_message('debug', 'Session destroyed successfully');
    }

    // Cancella i cookie di sessione
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    return redirect()->to('/login')->with('message', 'Sei stato disconnesso con successo.');
}