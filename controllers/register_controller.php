<?php
class RegisterController 
{
	public function create()
	{
		require_once('views/register/create.php');
	}

	public function checkPassword($pass1, $pass2){
		if($pass1 === $pass2 ){
			return array("status" => true);
		} else {
			return array(
				"status" => false,
				"err" => 'Passwords Do Not Match'
			);
		}
	}

	public function store()
	{
		$valid = $this->checkPassword($_POST['password'], $_POST['password_retype']);
		if($valid['status']){
			try
			{
				$dbh = Db::getInstance(true);

				$new_user = array(
					"firstname" => $_POST['firstname'],
					"lastname" => $_POST['lastname'],
					"email" => $_POST['email'],
					"password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
				);

				$sql = sprintf(
					"INSERT INTO %s (%s) values (%s)",
					"users",
					implode(", ", array_keys($new_user)),
					":" . implode(", :", array_keys($new_user))
				);

				$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($new_user);

				require_once('views/register/create.php');
				// header('Location: /register');
			}

			catch(PDOException $error)
			{
				echo $sql . "<br>" . $error->getMessage();
			}
		} else {
			require_once('views/register/create.php');
		}
	}
}