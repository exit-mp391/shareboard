<?php
class ShareModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM shares ORDER BY create_date DESC');
		$rows = $this->resultSet();
		return $rows;
	}

 //uzimamo podatke kroz nas share model, imacemo pristup nas view model	

	public function add(){
		// Sanitizujemo koji god POST dobijemo
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){
			if($post['title'] == '' || $post['body'] == '' || $post['link'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			// Insert into MySQL
			$this->query('
				INSERT INTO shares
			 (title, body, link, user_id)
			 VALUES
			 (:title, :body, :link, :user_id)');
             //placeholders

			$this->bind(':title', $post['title']);
			$this->bind(':body', $post['body']);
			$this->bind(':link', $post['link']);
			$this->bind(':user_id', 1);
			$this->execute();
			//bindujemo titl sa ono sto je postovano u titl, isto vazi i za ostale
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'shares');
			}
		}
		return;
	}
}

//proveravamo dali je submitovano