<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
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
				<a href="<?php echo site_url(); ?>transactions/<?php echo $p->alias; ?>">
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
					<?php 
					if (($this->uri->segment(5) != 'edit') AND ($this->uri->segment(3) != 'add')) {
					?>
					<div class="float_r button-add"><?php echo anchor('transactions/bank_account/add','Add') ?></div>
					<div class="float_r button-search" >
						<?php echo form_open('transactions/bank_account'); ?>
							<input type="text" name="search" placeholder="Search">
							<input type="button" class="icon-search">
						<?php echo form_close(); ?>
					</div>
					<?php } ?>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
					<?php
					if($this->uri->segment(3) == 'add')
					{
						echo form_open($subpage.'/bank_update'); 
					?>
							<div class='float'><div class='label col-120'>Bank Account <span class="star">*</span></div></div>
							<div class='float'><input class="upper" type='text' name='method' ></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Account Name <span class="star">*</span></div></div>
							<div class='float'><input type='text' name='accname' ></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Account ID <span class="star">*</span></div></div>
							<div class='float'><input type='text' name='accountid' ></div>
							<div class="clear"></div>
							<span class="float star-box">* This information needed</span>
							<div class="clear"></div>
							<div class='float col-120'><input type='submit' name='submit' value='Save'></div>
					<?php
						echo form_close();
					}
					else if ($this->uri->segment(4))
					{
						foreach ($bank_selected as $bs) {
							echo form_open($subpage.'/bank_update'); 
					?>
							<input type='hidden' name='id' value='<?php echo $bs->id_bank_acc; ?>' >
							<div class='float'><div class='label col-120'>Bank Account</div></div>
							<div class='float'><input class="upper" type='text' name='method' value='<?php echo $bs->payment_method; ?>' ></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Account Name</div></div>
							<div class='float'><input type='text' name='accname' value='<?php echo $bs->name_account; ?>' ></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Account ID</div></div>
							<div class='float'><input class="upper" type='text' name='accountid' value='<?php echo $bs->id_account; ?>' ></div>
							<div class="clear"></div>
							<div class='float col-120'><input type='submit' name='submit' value='Save'></div>
					<?php
							echo form_close();
						}
					}
					else
					{
					?>
								
						
						<div class='display-head'>
							<div class='col-220'>Bank Account</div>
							<div class='col-220'>Account Name</div>
							<div class='col-220'>Account ID</div>
						</div>
						<div class="clear"></div>
						<div class='display-page'>
						
						<?php
						$row = 1;
						foreach ($bank_list as $all) {
							if($this->uri->segment(3)) { $page = $this->uri->segment(3); } else { $page = 1; }
								echo 
							   '<div class="page-list">
								<div class="col-220" style="background:none;">'.$all->payment_method.'&nbsp</b></div>
								<div class="col-220" style="background:none;"><span><b>'.$all->name_account.'&nbsp</b></span></div>
								<div class="col-220" style="background:none;"><span><b>'.$all->id_account.'&nbsp</b></span></div>
								<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor($subpage.'/bank_account/'.$page.'/'.$all->id_bank_acc.'/edit','[View]').'</span></div>
								</div>';
						}
						?>
						</div>
					<?php
					}
					?>
					</div>
					
				</div>
				<div class="clear"></div>
				<?php 
				if($this->uri->segment(3) != 'add')
				{
					echo '<div class="page-nums">'.$this->pagination->create_links().'</div>';
				}
				?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php $this->load->view('00footer.php'); ?>
