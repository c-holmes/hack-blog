<?php
	class Post {
		public $id;
		public $author;
		public $title;
		public $teaser_content;
		public $content;
		public $date;

		public function __construct($id, $user_id, $title, $content, $date)
		{
			$this->id = $id;
			$this->author = $this->getUsername($user_id);
			$this->title = $title;
			$this->content = $content;
			if(strlen($content) > 250){
				$this->teaser_content = substr($content, 0, 250) . '...';
			}
			$this->date = $date;
		}

		public static function getUsername($id)
		{
			$dbh = Db::getInstance(true);
			$sql = "SELECT firstname, lastname
				FROM users 
				WHERE id = :id";
			$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':id' => $id));

			$name_arr = $sth->fetchAll();
			$full_name = $name_arr[0]['firstname'] . " " . $name_arr[0]['lastname'];
			return $full_name;
		}

		public static function all()
		{
			$list = [];
			$db = Db::getInstance(true);
			$req = $db->query('SELECT * FROM posts');

			//we create a list of Posts object from the database results
			foreach($req->fetchAll() as $post) {
				$list[] = new Post(
					$post['id'], 
					$post['user_id'], 
					$post['title'], 
					$post['content'],
					$post['created_at']
				);
			}

			return $list;
		}

		public static function find($id) {
			$db = Db::getInstance(true);
			// we make sure $id is an integer
			$id = intval($id);
			$req = $db->prepare('SELECT * FROM posts WHERE id = :id');
			// the query was prepared, now we replace :id with out actual $id value
			$req->execute(array('id' => $id));
			$post = $req->fetch();

			return new Post(
				$post['id'], 
				$post['user_id'], 
				$post['title'], 
				$post['content'],
				$post['created_at']
			);
		}
	}