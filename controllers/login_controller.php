<?php
class LoginController
{
	public function create()
	{
		require_once('views/login/create.php');
	}

	public function store()
	{
		$valid = $this->auth($_POST['email'], $_POST['password']);
		if($valid['status']){
			require_once('views/login/create.php');
			// header('Location: /');
		} else {
			require_once('views/login/create.php');
		}
	}

	public function auth($email, $pass)
	{
		try
		{
			$dbh = Db::getInstance(true);

			$user = array(
				"email" => $email,
				"password" => password_hash($pass, PASSWORD_DEFAULT)
			);

			$sql = 'SELECT password 
				FROM users 
				WHERE email = :email';

			$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':email' => $email));
			$hash = $sth->fetch();

			if (password_verify($pass, $hash["password"])){
				return array("status" => true);
			} else {
				return array(
					"status" => false,
					"err" => "Incorrect Password or Username"
				);
			}
		}

		catch(PDOException $error)
		{
			echo $sql . "<br>" . $error->getMessage();
		}
	}
}