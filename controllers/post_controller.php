<?php
class PostController 
{
	public function index() 
	{
		// grab all posts
		$posts = Post::all();

		// sort posts by created_at
		usort($posts, array($this, "cmp"));

		// display posts
		require_once('views/posts/index.php');
	}

	public function cmp($a, $b)
	{
		return strcmp($b->date, $a->date);
	}

	public function show() 
	{
		if (!isset($_GET['id']))
			return $this->error();

		// we use the given id to get the right post
		$post = Post::find($_GET['id']);
		require_once('views/posts/show.php');
	}

	public function error() 
	{
		require_once('views/layouts/error.php');
	}
}