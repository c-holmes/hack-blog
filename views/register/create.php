<?php 
if (isset($_POST['submit']) && $valid['status'] && isset($sth)) 
{ ?>
	<blockquote><?php echo escape($_POST['firstname']); ?> successfully added.</blockquote>
<?php 
} ?>

<form method="post">
	<div>
		<label for="firstname">First Name</label>
		<input type="text" name="firstname" id="firstname">
	</div>
	<div>
		<label for="lastname">Last Name</label>
		<input type="text" name="lastname" id="lastname">
	</div>
	<div>
		<label for="email">Email Address</label>
		<input type="text" name="email" id="email">
	</div>
	<div>
		<label for="email">Password</label>
		<input type="password" name="password" id="password">
	</div>
	<div>
		<label for="email">Retype Password</label>
		<input type="password" name="password_retype" id="password_retype">
	</div>
	<input type="submit" name="submit" value="Submit">
</form>

<?php 
if (isset($_POST['submit']) && !$valid['status']) 
{ ?>
	<blockquote><?php echo $valid['err']; ?></blockquote>
<?php 
} ?>