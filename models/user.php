<?php
class User
{
	public $id;

	public $name;

	public $email;

	public function __construct($id, $fname, $lname, $email) {
		$this->id = $id;
		$this->name = $fname . " " . $lname;
		$this->email = $email;
	}

	public function posts() {
		
	}
}