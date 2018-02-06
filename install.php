<?php

/**
 * Open a connection via PDO to create a
 * new database and table with structure.
 *
 */

require __DIR__ . '/vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
require_once("connection.php");

try
{
	$sql = file_get_contents("data/init.sql");
	$db = Db::getInstance(false);
	// the query was prepared, now we replace :id with out actual $id value
	$req = $db->exec($sql);

	echo "Database and table posts & users created successfully.";
}

catch(PDOException $error)
{
	echo $sql . "<br>" . $error->getMessage();
}
