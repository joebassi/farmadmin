<?php
date_default_timezone_set('America/Los_Angeles');
DEFINE('FARM_DB','farmadmin_db');
DEFINE('FARM_USERS','farmadmin_users');
DEFINE('FARM_PICKS','farmadmin_picks');
DEFINE('DEFAULT_FLAT_WEIGHT', '2.5');
DEFINE('PICKER_PAY_PER_POUND', '0.45');

function tep_db_connect() {

  $db_link = mysql_connect('localhost', 'root', 'mysql');
  mysql_select_db(FARM_DB);

  if (!$db_link) 
	{
	  die('Could not connect: ' . mysql_error());
	}
}

function tep_db_close() {

    $result = @mysql_close();
    
    return $result;
}

function get_farm_users()
{
	$que = "SELECT * FROM `".FARM_USERS."`";
	$query = mysql_query($que);
	$ret = array();
	if( @mysql_num_rows($query) > 0)
	{
	  while( $res = mysql_fetch_assoc($query) )
	  {
		$sid = $res['user_id'];
		$user_name = $res['user_name'];
		$ret[$sid] = $user_name;
	  }
	}
	return $ret;
}

function get_farm_picks($user_id=0,$limit=0) {

	$que = "SELECT *
			FROM `".FARM_PICKS."`
			WHERE 1 ";
	if( isset($_GET['date']) && $_GET['date'] >= '2014-06-30' )
	{
		$que .= " AND `pick_date` = '".$_GET['date']."'";
	}
	if( isset($_GET['fromdate']) || isset($_GET['enddate']) )
	{
		if( $_GET['fromdate']  >= '2014-06-30' )$que .= " AND `pick_date` >= '".$_GET['fromdate']."'";
		if( $_GET['enddate']  >= '2014-06-30' )$que .= " AND `pick_date` <= '".$_GET['enddate']."'";
	}
	if($user_id > 0)
	{
		$que .= " AND pick_user_id = ".$user_id;
		$que .= " ORDER BY `pick_date` asc, `pick_id`";
	}else{
		$que .= " ORDER BY `pick_id` desc";
	}
	if($limit > 0)$que .= ' Limit '.$limit;
	$query = mysql_query($que);
	$ret = array();
	if(@mysql_num_rows($query) > 0)
	{
		while($res = mysql_fetch_assoc($query))
		{
			$ret[] = $res;
		}
	}
	return $ret;
}

function get_pick($pick_id)
{
	$que = "SELECT *
			FROM `".FARM_PICKS."`
			WHERE pick_id = ".$pick_id;
	$query = mysql_query($que);
	$ret = array();
	if(@mysql_num_rows($query) > 0)
	{
		$ret = mysql_fetch_assoc($query);
	}
	return $ret;
}

tep_db_connect();
$users = get_farm_users();

if( isset($_POST['add_pick']) )
{
	extract($_POST);
	$ins_que = "INSERT INTO `".FARM_PICKS."` 
					(`pick_id`, `pick_date`, `pick_weight`, `pick_flats`, `pick_user_id`) 
				VALUES 
					(NULL, '".$pick_date."', '".$pick_weight."', '".$pick_flats."', '".$picker."')";
	@mysql_query($ins_que);
	header('Location: index.php?pick_date='.$pick_date.'&picker='.$picker);
	exit();
}

if( isset($_POST['edit_pick']) )
{
	extract($_POST);
	$upd_que = "UPDATE `".FARM_PICKS."` 
				SET `pick_date` = '".$pick_date."',
					`pick_weight` = '".$pick_weight."',
					`pick_flats` = '".$pick_flats."' 
				WHERE `pick_id` = ".$pick_id;
	@mysql_query($upd_que);
	if($from_page == 'index')
	{
	  header('Location: index.php?pick_date='.$pick_date.'&picker='.$picker_id);
	}else
	{
	  header('Location: index.php?page=picks');
	}
	exit();
}


?>
