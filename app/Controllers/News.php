<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
	
    public function index()
    {
        $model = new NewsModel();
         $data['news'] = $model->getNews();
		 $data['title'] = 'News Archive';
		 
		 return view('templates/header', $data)
            . view('news/overview')
            . view('templates/footer');

    
	
	}

    public function view($slug = null)
    {
        
		$model = new NewsModel();

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }
		
		
	public function create()
    {
        $model = new NewsModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'id'  => 'required',
			'title' => 'required|min_length[3]|max_length[255]',
            'text'  => 'required',
			'slug'  => 'required',

        ])) {
			$data_form= [
                'id' => $this->request->getPost('id'),
                'title' => $this->request->getPost('title'),
                'slug'  => $this->request->getPost('slug'),
                'text'  => $this->request->getPost('text'),
            ];
            $model->setNews($data_form);

            return view('news/success');
        }

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/create')
            . view('templates/footer');
    } 
	
		
		
		
		
		
		
		
    
}
?>
