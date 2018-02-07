<?php 
if (isset($_POST['submit']) && $valid['status']) 
{ ?>
	<blockquote><?php echo escape($_POST['email']); ?> successfully logged in.</blockquote>
<?php 
} ?>

<form method="POST">
	<div>
		<label>Email:</label>
		<input type="text" name="email">
	</div>
	<div>
		<label>Password:</label>
		<input type="password" name="password">
	</div>
	<input type="submit" name="submit" value="Submit">
</form>

<?php 
if (isset($_POST['submit']) && !$valid['status']) 
{ ?>
	<blockquote><?php echo $valid['err']; ?></blockquote>
<?php 
} ?>