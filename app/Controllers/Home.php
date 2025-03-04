<?php

namespace App\Controllers;

class Home extends BaseController
{public function index() {
    return view('home');  // Carica la vista home.php da app/Views
}
}
