<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
	<style>
		body {margin:0;}
		
		.topnav {
  		overflow: hidden;
  		background-color: #333;
		}

		.topnav a {
		  float: left;
		  color: #f2f2f2;
  		text-align: center;
  		padding: 14px 16px;
  		text-decoration: none;
  		font-size: 17px;
		}

		.topnav a:hover {
  		background-color: #ddd;
  		color: black;
		}

		.topnav a.active {
  		background-color: #999;
  		color: white;
		}
	</style>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>
<body>
	<div class="topnav">
		<?php
    	function theUrl($link) {
      	$uri = current_url();
        if($link==$uri) {
        	return 'class="active"';
       	}
    	}
			
			$deliverable = site_url('examples/deliverable_management');
			$task = site_url('examples/tasks_management');
			$issue = site_url('examples/issue_management');
			$action_item = site_url('examples/action_item_management');
			$resource = site_url('examples/resource_management');
		
		?>
		
		<?php 
		echo "<a href='".$deliverable."'".theUrl($deliverable).">Deliverables</a>";
		echo "<a href='".$task."'".theUrl($task).">Tasks</a>";
		echo "<a href='".$issue."'".theUrl($issue).">Issues</a>";
		echo "<a href='".$action_item."'".theUrl($action_item).">Action Items</a>";
		echo "<a href='".$resource."'".theUrl($resource).">Resources</a>";
		?>
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
