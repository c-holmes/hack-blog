<p>Here is a list of all posts:</p>

<?php foreach ($posts as $post) { ?>
	<div>
		<h3><?php echo $post->title; ?></h3>
		<p>Posted By: <?php echo $post->author; ?></p>
		<p>
		<?php if(isset($post->teaser_content)){
			echo $post->teaser_content; 
		} else {
			echo $post->content; 
		}
		?>
		</p>
		<a href='/post/?id=<?php echo $post->id; ?>'>See Full Post</a>
	</div>
<?php } ?>