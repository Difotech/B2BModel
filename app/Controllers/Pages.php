<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
	public function view($page = 'home')
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) // check whether the requested page actually exists:
        {
                // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);//If the page doesn’t exist, a “404 Page not found” 	error is shown.
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter. In the header template, the $title variable was used to customize the page title. The value of title is defined in this method, but instead of assigning the value to a variable, it is assigned to the title element in the $data array.

		return view('templates/header', $data)
			  .view('pages/' . $page, $data)
			  .view('templates/footer');

    }

}
?>
