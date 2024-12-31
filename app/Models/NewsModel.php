<?php
namespace App\Models;
use CodeIgniter\Model;
class NewsModel extends Model
{
    protected $table = 'news';
	protected $allowedFields = ['id', 'title', 'text', 'slug'];
	
	/*public function getNews($slug = false)
{
    if ($slug === false) {
        return $this->findAll();
    }

    return $this->where(['slug' => $slug])->first();
}*/
	public function getNews($slug = FALSE)
{
      if ($slug === FALSE)
        {$sql = "SELECT * FROM news ORDER BY title;";
         $query =  $this->query($sql);
          return $query->getResultArray();
         }
        $sql = "SELECT * FROM news WHERE slug='$slug';";
        $query = $this->query($sql);
        return $query->getRowArray();
} 

	public function setNews($data)
{   $sql= "INSERT INTO news values($data[id], '$data[title]','$data[slug]', '$data[text]');";
	$query =  $this->query($sql);
	return $query;
} 

	
	}
	
	
?>