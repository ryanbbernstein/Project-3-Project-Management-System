<!DOCTYPE html>

<?php
	session_start();

	$username = "User Name";
	$password = "password";

	$_SESSION['logged_in'] = true;

	if(isset($_POST['username']) && isset($_POST['password'])) {
		$_SESSION['logged_in'] = true;
	}
?>

<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>
<body>
	<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false): ?>
	<form method="post">
		Username:<br/>
		<input type="text" name="username"><br/>
		Password:<br/>
		<input type="password" name="password"><br/>
		<input type="submit" value="Login">
	</form>
	<?php else: ?>
	<div>
		<a href='<?php echo site_url('examples/deliverable_management')?>'>Deliverables</a> |
		<a href='<?php echo site_url('examples/tasks_management')?>'>Tasks</a> |
		<a href='<?php echo site_url('examples/issue_management')?>'>Issues</a> |
		<a href='<?php echo site_url('examples/action_item_management')?>'>Action Items</a> | 
		<a href='<?php echo site_url('examples/resource_management')?>'>Resources</a>		
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
	<?php endif; ?>
</body>
</html>
