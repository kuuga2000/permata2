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
					<div class="display">
					<div class="clear"></div>

					<div class="minitab-sub" style="background:#efefef;">
						<div class="float col-440">
						<?php 
							echo anchor($subpage.'/rewards/view','Rewards'); 
							echo ' ['.$total_rewards.']'; 
							
						?>
						
						</div>
						<div class="float_r button_add">
							<?php echo anchor($subpage.'/rewards/setup','Add New Rewards');  ?>
						</div>
						<div class="clear"></div>
					</div>

					
					<?php
					if($this->uri->segment(3) == 'view')
					{
					?>
					<div class='minitab-sub'  style="background:#aaa; color:#fff">
						<div class="float col-160" style="font-weight:bold;">Value</div>
						<div class="float col-160" style="font-weight:bold;">Rewards</div>
						<div class="float col-80" style="font-weight:bold;">Enable</div>
						<div class="clear"></div>
					</div>
					<?php
						foreach($rewards as $rwds)
						{	
							if($this->uri->segment(4))
							{	$page = $this->uri->segment(4); }
							else
							{	$page = '0'; }
							if($rwds->enable) { $enable = '[enable]'; $val = 0; } else { $enable = '[disable]'; $val = 1; }
							
					?>
					<div class='minitab-sub'>
						<div class="float col-160" style="font-weight:bold;"><?php echo anchor($subpage.'/rewards/view/'.$page.'/'.$rwds->id.'/view',number_format($rwds->value, 0, ',', '.')); ?> </div>
						<div class="float col-160"><?php echo number_format($rwds->reward, 0, ',', '.'); ?> </div>
						<div class="float col-80"><?php echo anchor('transactions/enable_rewards/'.$rwds->id.'/'.$val,$enable); ?> </div>
						<div class="clear"></div>
					</div>
					<?php
							if($dattr == $rwds->id){
					?>
					<div class="minitab-sub" style="font-style:italic;">
						<div class="float col-260">Code</div>
						<div class="float col-260">Owner (Customer Name/ Email)</div>
						<div class="clear"></div>
					</div>
					<?php
								foreach($rewards_use as $vu){

								if($vu->emailcust)
								{	$owner = $vu->emailcust; $name = $vu->firstname.' '.$vu->lastname.', '.$vu->phone; 	}
								else { 	$owner = anchor($subpage.'/rewards/setup/'.$vcr->id_voucher.'/'.$vcr->vcr_value.'/'.$vcr->vcr_type.'/'.$vu->id_vcr_used,'Not Registered'); 	$name = ''; 	}
								
					?>
					<div class='minitab-sub'>
						<div class="float col-260"><?php echo $vu->code; ?></div>
						<div class="float col-220"><?php echo anchor('transactions/customers_setup/'.$vu->id,$name); $name = ''; ?></div>
						<div class="float col-260 emailink"><?php echo $owner; $owner = ''; ?></div>
						
						<div class="clear"></div>
					</div>
					<?php
								}
							}
						}
						if($link)
						{
					?>
					<div class="minitab-sub" style="background:#aaa; color:#fff"">
						<div class="float col-440" style="text-align:center">  <?php echo '<div class="page-nums">Page '.$link.'</div>'?></div>
						<div class="clear"></div>
					</div>
					<?php
						}
					}
					?>
					<div class="minitab-sub" style="background:#efefef;">
						<div class="float col-440">
						<?php echo anchor($subpage.'/rewards/customers','Customer'); ?> 
						</div>
						<div class="clear"></div>
					</div>
					<?php
					if($this->uri->segment(3) == 'customers')
					{
						if($this->uri->segment(4))
						{	$page = $this->uri->segment(4); }
						else
						{	$page = '0'; }
					?>
					<div class="minitab-sub"  style="background:#aaa; color:#fff">
						<div class="float col-160" style="font-weight:bold;">Name</div>
						<div class="float col-160" style="font-weight:bold;">Rewards</div>
						<div class="float col-80" style="font-weight:bold;">Enable</div>
						<div class="clear"></div>
					</div>
					<?php
								foreach($customer_rewards as $cr){
								$name = $cr->firstname.' '.$cr->lastname;
					?>
					<div class="minitab-sub">
						<div class="float col-260" style="font-weight:bold;"><?php echo anchor('transactions/rewards/customers/'.$page.'/'.$cr->id,$name); ?> &nbsp </div>
						<div class="clear"></div>
					</div>
					<?php
								}
							if($datcr == $cr->id){
					?>
					<div class="minitab-sub" style="font-style:italic;">
						<div class="float col-260">Code</div>
						<div class="float col-260">Rewards</div>
						<div class="clear"></div>
					</div>
					<?php
								foreach($customer_use as $cu){

								if($cu->emailcust)
								{	$owner = $cu->emailcust; $name = $cu->firstname.' '.$cu->lastname.', '.$cu->phone; 	}
								else { 	$owner = anchor($subpage.'/rewards/setup/'.$cu->id_vcr_used,'Not Registered'); 	$name = ''; 	}
								
					?>
					<div class='minitab-sub'>
						<div class="float col-260"><?php echo $cu->code; ?></div>
						<div class="float col-220"><?php echo number_format($cu->value, 0, ',', '.'); ?></div>	
						<div class="clear"></div>
					</div>
					<?php
								}
							}
					}
					?>

					<div class="clear"></div>
					<?php
					if($this->uri->segment(3) == 'setup')
					{
						echo form_open($subpage.'/save_reward'); 
					?>
					<div class="float"><div class='label col-120'>Value</div></div>
					<div class="float"><input type='text' name='value' ></div>
					<span class="float star">* this information needed</span>
					<div class="clear"></div>
					<div class="float"><div class='label col-120'>Reward</div></div>
					<div class="float"><input type='text' name='reward' ></div>
					<span class="float star">* this information needed</span>
					<div class="clear"></div>
					<div class="float col-120"><input type='submit' value='Save'></div>
					<?php
					}
					?>
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
