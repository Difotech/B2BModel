<?php
 
namespace App\Controllers;
 
use CodeIgniter\Controller;
 
class CatalogoController extends Controller
{
    public function index()
    {
        // Dati hardcoded per il debug
        $prodotti = [
            [
                'codiceprodotto' => '001',
                'nomeprodotto'   => 'Prodotto di Test 1',
                'immagine'       => 'https://via.placeholder.com/150'
            ],
            [
                'codiceprodotto' => '002',
                'nomeprodotto'   => 'Prodotto di Test 2',
                'immagine'       => 'https://via.placeholder.com/150'
            ],
            [
                'codiceprodotto' => '003',
                'nomeprodotto'   => 'Prodotto di Test 3',
                'immagine'       => 'https://via.placeholder.com/150'
            ],
        ];
 
        // Restituisce i dati in formato JSON
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $prodotti
        ]);
    }
}
