<?php
$page = 'home';
$inc_page = 'index_inc.php';
if( isset($_GET['page']) && file_exists($_GET['page'].'_inc.php')  )
{
	$page = $_GET['page'];
	$inc_page = $page.'_inc.php';
}
include_once('db_func.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="language" content="en">
	<meta property="title" content="Farm Admin">
	<title>Farm - Admin</title>
	<script type="text/javascript" src="admin_files/jquery-latest.js"></script>
	
	 <link rel="stylesheet" href="admin_files/jquery-ui.css" />
	 <script src="admin_files/jquery-ui.js"></script>
	
	<link rel="stylesheet" type="text/css" href="admin_files/normalize.css">
	<link rel="stylesheet" type="text/css" href="admin_files/main.css">
	<link rel="stylesheet" type="text/css" href="admin_files/admin.css">
	<script>
	  $(function() {
	    $( "#pick_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  });
	</script
	</head>
<body>
<div id="page">

	<div id="header">
		<div class="container">
			<a href="index.php" id="header-logo">Farm Admin</a>
			<br class="clear" />
		</div>
	</div>
	
	
	<div class="container">
			
		
		<?php include_once($inc_page); ?>
			
	</div>
	
	
	<div id="footer">
		<div class="container" style="padding-top:33px;">
			<p class="footer_links">Copyright &copy; 2012-<?php echo date('Y'); ?> Farm Admin</p>
			<br class="clear">
		</div>
	</div>

</div> <!-- end page -->


</body>
</html>
<?php tep_db_close(); ?>