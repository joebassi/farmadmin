<?php
if( isset( $_GET['picker'] ) )
{
	$picks = get_farm_picks($_GET['picker']);
}else
{
	$picks = get_farm_picks();
}
$rate = PICKER_PAY_PER_POUND;
?>
			<?php if( !isset($_GET['print']) ) {?>
			
			<div id="search-container" class="lgrey">
				<span class="admin-title">Picks</span>
			</div>

			
			<div id="filter-container" class="lgrey">
					<ul class="admin-filters" style="margin:0;margin-left:-30px;"> 
					<li>Filters:&nbsp;&nbsp;</li>
					<li>
					<select name="picker" class="required" onchange="window.location='index.php?page=picks&picker='+this.value">
						<option value="all">Please Select</option>
						<?php 
						foreach($users as $user_id => $user_name)
						{  
						  	$sel = '';
							if($_GET['picker'] == $user_id)$sel = ' Selected';
							echo '<option value="'.$user_id.'"'.$sel.'>'.$user_name.'</option>'."\n";
						} 
						?>
					</select>
					&nbsp; | &nbsp;
					</li>
					<li>Count: (<?php echo count($picks); ?>)&nbsp; | &nbsp;</li>
					<li><a href="javascript:void(0);" onclick="javascript:window.location=window.location.href+'&print=1'">Print View</a></li>
				</ul>
			</div>
			<?php } else { ?>
			<div id="search-container" class="lgrey">
				<span class="admin-title">&nbsp;&nbsp;</span>
			</div>
			<?php } ?>

			<div id="list-container" class="lgrey">
				<table width="100%" class="list-items">
					<thead>
						<tr class="thead">
							<td style="border:0;padding:5px 5px 5px 15px; width: 30px;" class="headlinks">&nbsp;</td>
							<td style="border:0;padding:5px 5px 5px 15px;"><a href="index.php?page=picks&order_by=date" class="headlinks">Date</a></td>
							<td style="border:0;padding:5px 5px 5px 15px;"><a href="index.php?page=picks&order_by=picker" class="headlinks">Picker</a></td>
							<td style="border:0;padding:5px 5px 5px 15px;"><a href="index.php?page=picks&order_by=date" class="headlinks">Weight</a></td>
							<td style="border:0;padding:5px 5px 5px 15px;"><a href="index.php?page=picks&order_by=date" class="headlinks">Flats</a></td>
							<?php if( !isset($_GET['print']) ) {?><td style="border:0;padding:5px 5px 5px 15px;" class="headlinks">&nbsp;</td><?php } ?>
						</tr>
					</thead>
					<tbody>
					<?php
					$counter = 1;
					$tot_weight = 0;
					$tot_flats = 0;
					$base_url = 'index.php?page=picks';
					if( isset($_GET['picker']) )$base_url .= '&picker='.$_GET['picker'];
					foreach($picks as $pick)
					{
						$puser_id = $pick['pick_user_id'];
					?>
						<tr>
							<td><?php echo $counter; ?></td>
							<td>
							<?php
							$date_url = $base_url.'&date='.$pick['pick_date'];
							echo '<a href="'.$date_url.'">';
							?>
							<?php echo $pick['pick_date']; ?></a>
							</td>
							<td><?php echo $users[$puser_id]; ?></td>
							<td><?php echo $pick['pick_weight']; ?></td>
							<td><?php echo $pick['pick_flats']; ?></td>
							<?php if( !isset($_GET['print']) ) {?><td><a href="index.php?page=picks_edit&pick_id=<?php echo $pick['pick_id']; ?>" class="listlinks">edit</a></td><?php } ?>
						</tr>
					<?php
						$tot_weight += $pick['pick_weight'];
						$tot_flats  += $pick['pick_flats'];
						$counter++;
					}
					$tot_flats_weight = ($tot_flats * DEFAULT_FLAT_WEIGHT);
					$net_weight = $tot_weight - $tot_flats_weight;
					$tot_paid = $net_weight*$rate;
					
					$extra_td = '';
					if( !isset($_GET['print']) ) {
						$extra_td = '<td>&nbsp;</td>';
					}
					?>
					
						<tr>
							<td colspan="3" align="right"><strong>TOTALS:</strong>&nbsp;</td>
							<td><strong><?php echo $tot_weight; ?> LBS</strong></td>
							<td><?php echo $tot_flats; ?> FLATS X <?php echo DEFAULT_FLAT_WEIGHT; ?> = <strong><?php echo $tot_flats_weight; ?> LBS</strong> </td>
							<?php echo $extra_td; ?>
						</tr>
						
						<tr>
							
							<td colspan="3" align="right"><strong>NET WEIGHT:</strong></td>
							<td colspan="2" align="left"><?php echo $tot_weight.' - '.$tot_flats_weight.' = <strong>'.$net_weight.' LBS</strong>';?></td>
							<?php echo $extra_td; ?>
							
						</tr>
						
						<tr>
							<td colspan="3" align="right"><strong>TOTAL PAY:</strong>&nbsp;</td>
							<td colspan="2" align="left"><?php echo $net_weight.' X $'.$rate.' = ';?><strong><?php echo '$'.ceil($tot_paid);?></strong>&nbsp;</td>
							<?php echo $extra_td; ?>
						</tr>
						
					</tbody>
				</table>
			</div>		