<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
	<div id="submenu-pages">
		<div id="submenuback"></div>
		<div id="submenuwrap">
			<div id="submenushadow"></div>
			<ul id="submenu">
				<?php
				foreach ($subpages as $p) {
					//if (priv_page($p->alias)) {
				?>
				<a href="<?php echo site_url(); ?><?php echo $subpage; ?>/<?php echo $p->alias; ?>">
					<li>
						<div class="inner">
							<div class="title"><?php echo $p->name; ?></div>
							<div class="clear"></div>
						</div>
					</li>
				</a>
				<?php //}
				} ?>
			</ul>
		</div>
	</div>
	

	<div id="content" style="margin-left:357px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
					<?php // ----------- *** Use For Adding New Shipping Region *** -------------- //
					//	echo '<div class="float"><div class="label col-160">New Shipping Location</div></div>';
					//	echo form_open($subpage.'/save_region');
					//	echo '<div class="float"><input type="text" name="newregion" ></div>
					//		<div class="clear"></div>
					//		<div class="float col-160"> &nbsp </div>
					//		<div class="float col-120"><input type="submit" name="submit" value="Save">
					//		</div>';
					//	 echo form_close();
					?>
					<div class="clear"></div>
					<div class='minitab-sub' style="background:#ccc; margin-top:15px;">
						<div class='float col-40'>No</div>
						<div class='float col-120'>Location</div>
						<div class='float col-80'>Cost</div>
						<div class='float col-40'>Enable</div>
						<div class='float col-220'>Action</div>
						<div class="clear"></div>
					</div>
					<?php
					$position = 1;
					foreach ($primattr as $ptr)
					{
						if(($this->uri->segment(3) == 'edit') AND ($this->uri->segment(4) == $ptr->id_region))
						{
							$class_style = 'style="padding-top:5px;"';
						}
					?>
					<div class='minitab-sub' style="background:#efefef;">
						<div class='float col-40 <?php echo $class_style; ?>'><?php echo $position; ?></div>
						<div class='float col-440'>
						<?php echo anchor($subpage.'/shipping_area/'.$ptr->id_region,$ptr->region_name);  ?> 
						<?php echo '['.$ptr->counts.']'; ?>
						<?php 
						if(($this->uri->segment(3) == 'edit') AND ($this->uri->segment(4) == $ptr->id_region))
						{
							echo form_open($subpage.'/edit_region');
						?>
							<input type="hidden" name="idregion" value="<?php echo $ptr->id_region; ?>" >
							<input type="text" name="location_name"  style="font-size:12px; height:15px; width:105px;" value="<?php echo $ptr->region_name; ?>">
							<input type="submit" value="Save" style="font-size:12px; height:31px;">
						<?php
							echo form_close();
						}
						else
						{
							echo anchor($subpage.'/shipping_area/edit/'.$ptr->id_region,'[Edit]');  
						}
						?>
						</div>
					<?php
					if($dattr == $ptr->id_region){
						if($ptr->flag)
						{
					?>
					<div class='float col-240' style="margin-top:-7px; margin-bottom:-8px; ">
					<?php
					
							echo form_open($subpage.'/save_location');  ?>
						<input type="hidden" name="idval" value="<?php echo $ptr->id_region; ?>">
						<input type="text" style="font-size:12px; height:15px; width:80px;" name="location" placeholder="Add locations ... .">
						<input type="text" style="font-size:12px; height:15px; width:80px;" name="cost" placeholder="Add cost ... .">
					</div>
					<div class='float col-80'>
						<input type="submit" value="Save" style="font-size:12px; height:31px;">
						</div>
					<?php	echo form_close();
						}
					}
					?>
						<div class="clear"></div>
					</div>
					<?php
					if($dattr == $ptr->id_region){
						foreach($primattr_sel as $ps)
						{
							if($ps->enable == 1)
							{ $icon = 'class="ui-icon ui-icon-check"'; $dataenable = 0; }
							else
							{ $icon = 'class="ui-icon ui-icon-close"'; $dataenable = 1; }
					?>
					<div class='minitab-sub'>
						<div class='float col-40'> &nbsp </div>
						<?php
						if(($this->uri->segment(5) == 'edit') AND ($this->uri->segment(4) == $ps->id_shipping))
						{
							echo form_open($subpage.'/edit_location');
						?>
						<input type="hidden" name="idval" value="<?php echo $ps->id_shipping; ?>">
						<div class='float'><input type="text" name="location_name"  style="font-size:12px; height:15px; width:105px;" value="<?php echo $ps->name; ?>"></div>
						<div class='float col-120'><input type="text" name="location_cost"  style="font-size:12px; height:15px; width:80px;" value="<?php echo $ps->cost; ?>"></div>
						<div style="margin-top:6px;"><input type="submit" value="Save" style="font-size:12px; height:31px;"></div>
						<?php
							echo  form_close();
						}
						else
						{
						?>
						<div class='float col-120'><?php echo anchor($subpage.'/shipping_area/'.$ps->id_region.'/'.$ps->id_shipping.'/edit',$ps->name);  ?></div>
						<div class='float col-80' style="text-align:right; margin-right:3px;"><?php echo number_format($ps->cost, 0, ',', '.');  ?></div>
						<div class='float col-40'><?php echo anchor('transactions/location_enable/'.$ps->id_shipping.'/'.$dataenable, '<span '.$icon.'></span>'); ?></div>
						<?php
						}
						?>
						<div class="clear"></div>
					</div>
					<?php					
						}
					}
					?>
					<?php
						$position++;
					}
					?>
					<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php $this->load->view('00footer.php'); ?>
