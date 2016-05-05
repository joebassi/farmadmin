<?php
$picks = get_farm_picks(0,5);
?>
<div id="search-container" class="lgrey">
	<span class="admin-title"> Add Pick </span>
</div>
<div id="results-container" class="lgrey">
	<div class="form-content lgrey">
		<form id="user-form" action="" method="post" autocomplete="off">
			<div class="left">
				<div class="form-item">
					<label for="picker" class="required"> Picker <span class="required">* </span>
					</label>
					<select name="picker" class="required">
						<?php 
						foreach($users as $user_id => $user_name)
						{  
						  	$sel = '';
							if($_GET['picker'] == $user_id)$sel = ' Selected';
							echo '<option value="'.$user_id.'"'.$sel.'>'.$user_name.'</option>'."\n";
						} 
						?>
					</select>
				</div>
				<div class="form-item">
					<label for="pick_date" class="required"> Pick Date <span class="required">* </span>
					</label>
					<input name="pick_date" id="pick_date" type="text" value="<?php echo $_GET['pick_date']; ?>"/>
				</div>
			</div>
			<div class="right">
				<div class="form-item">
					<label for="pick_weight" class="required"> Pick Weight <span class="required">* </span>
					</label>
					<input name="pick_weight" id="pick_weight" type="text" value="" style="width:100px;" autofocus="autofocus" />
				</div>
				<div class="form-item">
					<label for="pick_flats" class="required"> Pick Flats <span class="required">* </span>
					</label>
					<input name="pick_flats" id="pick_flats" type="text" value="" style="width:100px;" />
				</div>
				<div class="form-item">
					<input type="hidden" name="add_pick" value="1">
					<input type="submit" name="yt0" value="Add New"/>
				</div>
			</div>
		</form>
	</div>
</div>

<div id="results-container" class="lgrey">
	Recent Picks
</div>

<div id="list-container" class="lgrey">
	<table width="100%" class="list-items">
		<thead>
			<tr class="thead">
				<td style="border:0;padding:5px 5px 5px 15px;" class="headlinks">Date</a></td>
				<td style="border:0;padding:5px 5px 5px 15px;" class="headlinks">Picker</a></td>
				<td style="border:0;padding:5px 5px 5px 15px;" class="headlinks">Weight</a></td>
				<td style="border:0;padding:5px 5px 5px 15px;" class="headlinks">Flats</td>
				<?php if( !isset($_GET['print']) ) {?><td style="border:0;padding:5px 5px 5px 15px;" class="headlinks">&nbsp;</td><?php } ?>
			</tr>
		</thead>
		<tbody>	
		<?php
		foreach($picks as $pick)
		{
			$puser_id = $pick['pick_user_id'];
		?>
			<tr>
				<td><?php echo $pick['pick_date']; ?></td>
				<td><?php echo $users[$puser_id]; ?></td>
				<td><?php echo $pick['pick_weight']; ?></td>
				<td><?php echo $pick['pick_flats']; ?></td>
				<?php if( !isset($_GET['print']) ) {?><td><a href="index.php?page=picks_edit&pick_id=<?php echo $pick['pick_id']; ?>&from_page=index" class="listlinks">edit</a></td><?php } ?>
			</tr>
		<?php
		}
		?>
			</tbody>
	</table>
	
	<table class="pager">
		<tr><td><a href="index.php?page=picks" class="listlinks">View All</a></td></tr>
	</table>
	
</div>