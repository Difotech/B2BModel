<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContattaciController extends CI_Controller {

    public function index() {
        $this->load->view('contattaci');
    }

    public function invia() {
        $this->load->library('form_validation');

        // Imposta regole di validazione
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('messaggio', 'Messaggio', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Ricarica la pagina con errori di validazione
            $this->load->view('contattaci');
        } else {
            // Ottieni i dati dal form
            $nome = $this->input->post('nome');
            $email = $this->input->post('email');
            $messaggio = $this->input->post('messaggio');

            // Esempio: puoi salvare i dati nel database o inviare un'email
            $this->load->library('email');
            $this->email->from($email, $nome);
            $this->email->to('vitodifonzo1998@gmail.com'); // Modifica con la tua email
            $this->email->subject('Nuovo messaggio dal modulo di contatto');
            $this->email->message($messaggio);

            if ($this->email->send()) {
                echo "Messaggio inviato con successo!";
            } else {
                echo "Errore nell'invio del messaggio.";
            }
        }
    }
}
?>
