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
					<?php if($this->uri->segment(3) != 'setup') { ?><div class="float_r button-add"><?php echo anchor($subpage.'/rewards/setup','Add') ?></div> <?php } ?>
					
					<h1><?php echo $title; ?></h1>
					<div class="display">
						<?php
						if($this->uri->segment(3) != 'setup')
						{
						?>
						<div class='display-head'>
							<div class='col-220'>Value</div>
							<div class='col-220'>Rewards</div>
							<div class='col-40'>Enable</div>
						</div>
						<div class="clear"></div>
						<div class='display-page'>
						
						<?php

							$row = 1;
							foreach ($rewards as $rwds) {
								if($this->uri->segment(4))
								{	$page = $this->uri->segment(4); }
								else
								{	$page = '0'; }
								if($rwds->enable) { $enable = '[enable]'; $val = 0; } else { $enable = '[disable]'; $val = 1; }
									echo 
								   '<div class="page-list">
									<div class="col-220" style="background:none;">'.number_format($rwds->value, 0, ',', '.').'&nbsp</b></div>
									<div class="col-220" style="background:none;"><span><b>'.number_format($rwds->reward, 0, ',', '.').'&nbsp</b></span></div>
									<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor('transactions/enable_rewards/'.$rwds->id.'/'.$val,$enable).'</span></div>
									</div>';
							}
							
						}
						else
						{
							echo form_open($subpage.'/save_reward'); 
						?>
							<div class="float"><div class='label col-120'>Value <span class="star">*</span></div></div>
							<div class="float"><input type='text' name='value' ></div>
							
							<div class="clear"></div>
							<div class="float"><div class='label col-120'>Reward <span class="star">*</span></div></div>
							<div class="float"><input type='text' name='reward' ></div>
							<div class="clear"></div>
							<span class="float star-box">* This information needed</span>
							<div class="clear"></div>
							<div class="float col-120"><input type='submit' value='Save'></div>
						<?php
							echo form_close();
						}
						
						?>
						</div>
						<?php
						if($this->uri->segment(3) != 'setup')
						{
						echo '<div class="page-nums">'.$link.'</div>';
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
