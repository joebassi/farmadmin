<?php
$pick = get_pick($_GET['pick_id']);
?>
<div id="search-container" class="lgrey">
	<span class="admin-title">
	Edit Pick </span>
</div>
<div id="results-container" class="lgrey">
	<div class="form-content lgrey">
		<form id="user-form" action="" method="post">
			<div class="left">
				<div class="form-item">
					<label for="pickid" class="required"> Pick ID <span class="required">* </span>
					</label>
					<input name="pickid" id="pickid" type="text" value="<?php echo $pick['pick_id']; ?>" disabled />
				</div>
				<div class="form-item">
					<label for="picker" class="required"> Picker <span class="required">* </span>
					</label>
					<input name="picker" id="picker" type="text" value="<?php echo $users[$pick['pick_user_id']]; ?>" disabled />
				</div>
				<div class="form-item">
					<label for="pick_date" class="required"> Pick Date <span class="required">* </span>
					</label>
					<input name="pick_date" id="pick_date" type="text" value="<?php echo $pick['pick_date']; ?>"/>
				</div>
			</div>
			<div class="right">
				<div class="form-item">
					<label for="pick_weight" class="required"> Pick Weight <span class="required">* </span>
					</label>
					<input name="pick_weight" id="pick_weight" type="text" value="<?php echo $pick['pick_weight']; ?>" style="width:100px;" />
				</div>
				<div class="form-item">
					<label for="pick_flats" class="required"> Pick Flats <span class="required">* </span>
					</label>
					<input name="pick_flats" id="pick_flats" type="text" value="<?php echo $pick['pick_flats']; ?>" style="width:100px;" />
				</div>
				<div class="form-item">
					<input type="hidden" name="edit_pick" value="1">
					<input type="hidden" name="pick_id" value="<?php echo $pick['pick_id']; ?>">
					<input type="hidden" name="picker_id" value="<?php echo $pick['pick_user_id']; ?>">
					<?php if($_GET['from_page']) { ?>
					<input type="hidden" name="from_page" value="<?php echo $_GET['from_page']; ?>">
					<?php }?>
					<input type="submit" name="yt0" value="Save"/>
					<a href="javascript: window.history.go(-1)" class="cancel"> Cancel </a>
				</div>
			</div>
		</form>
	</div>
</div>