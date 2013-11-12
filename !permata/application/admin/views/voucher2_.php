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
					<?php
					if($this->uri->segment(3) != 'add')
					{
					?>
					<div class="float_r button-add"><?php echo anchor('transactions/voucher/add','Add') ?></div>
					<div class="float_r button-search" >
						<?php echo form_open('transactions/voucher'); ?>
							<input type="text" name="search" placeholder="Search">
							<input type="button" class="icon-search">
						<?php echo form_close(); ?>
					</div>
					<?php
					}
					?>
					<h1><?php echo $title; ?></h1>
					<?php
					if($this->uri->segment(3) == 'add')
					{
						$res   = (strtoupper(substr(md5(time()), 0, 25)));
						echo form_open('transactions/save_voucher_');
					?>
						<div class="float"><div class="label col-120">Code</div></div>
						<div class="float" style="padding-top:15px; font-weight:bold; font-size:16px;">
							<input  type="hidden" name="code" class="upper" value="<?php echo $res; ?>">
							<?php echo $res; ?> 
						</div>
						<div class="clear"></div>
						<div class="float"><div class="label col-120">Title <span class="star">*</span></div></div>
						<div class="float"><input type="text" name="caption"> </div>
						<div class="clear"></div>
						<div class="float"><div class="label col-120">Value <span class="star">*</span></div></div>
						<div class="float"><input type="text" name="value"> </div>
						<div class="clear"></div>
						<div class="float"><div class="label col-120">Qty <span class="star">*</span></div></div>
						<div class="float"><input type="text" name="qty"> <input style="margin-top:-1px;" type="checkbox" name="qtyun" value='-1'> Unlimited</div>
						<div class="clear"></div>
						<!--<div class="float"><div class="label col-80">Date Issue</div></div>
						<div class="float"><input type="text" name="issue" class='datepicker'> </div><span class="float star">* This information is needed</span>
						<div class="clear"></div>-->
						<div class="float"><div class="label col-120">Date Start <span class="star">*</span></div></div>
						<div class="float"><input type="text" name="start" class='datepicker'> </div>
						<div class="clear"></div>
						<div class="float"><div class="label col-120">Date Expired <span class="star">*</span></div></div>
						<div class="float"><input type="text" name="expire" class='datepicker'> </div>
						<div class="clear"></div>

						<span class="float star-box">* This information needed</span>
						<div class="clear"></div>
						<div class="float"><input type="submit" name="submit" value="Save"></div>

						<div class="clear"></div>
					<?php
						echo form_close();
					}
					else
					{
					?>
					<div class='display'>
						<div class='display-head'>
							<div class='col-120'>Title</div>
							<div class='col-220'>Code</div>
							<div class='col-80'>Value</div>
							<div class='col-80'>Qty</div>
							<!--<div class='col-120'>Date Issue</div>-->
							<div class='col-120'>Date Start</div>
							<div class='col-120'>Date Expired</div>
						</div>
						<div class="clear"></div>
						<div class='display-page'>
						<?php
						foreach($voucher as $vcr){
						if($vcr->vcr_value)
						{	$format_number = number_format($vcr->vcr_value, 0, ',', '.'); $price = array($format_number,' Idr'); $price = implode('',$price); 	}
						if($vcr->qty == -1)
						{	$qty = 'Unlimited'; 	}
						else
						{	$qty = number_format($vcr->qty, 0, ',', '.'); 	}
						echo 
							   '<div class="page-list">
								<div class="col-120" style="font-weight:bold; background:none;">'.$vcr->vcr_caption.'&nbsp</b></div>
								<div class="col-220" style="font-weight:bold; background:none;"><span><b>'.$vcr->code.'</b></span></div>
								<div class="col-80" style="font-weight:bold; background:none; text-align:right"><span><b>'.@$format_number.'&nbsp</b></span></div>
								<div class="col-80" style="background:none; text-align:right;"><span><b>'.@$qty.'&nbsp</b></span></div>';
						//		<div class="col-120" style="background:none;"><span><b>'.date ("d F Y",strtotime($vcr->date_issue)).'&nbsp</b></span></div>
						echo	'<div class="col-120" style="background:none;"><span><b>'.date ("d F Y",strtotime($vcr->date_start)).'&nbsp</b></span></div>
								<div class="col-120" style="background:none;"><span><b>'.date ("d F Y",strtotime($vcr->date_expired)).'&nbsp</b></span></div>
								<div class="col-40 deleteform" style="font-weight:bold; background:none;"><span>'.anchor('transactions/voucher_delete/'.$vcr->id_voucher,'[Delete]').'</span></div>
								</div>';
								$format_number = '';
								$qty = '';
						}
						?>
						</div>
					</div>
					<?php echo '<div class="page-nums">'.@$link.'</div>'?>
					<?php
					}
					?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php $this->load->view('00footer.php'); ?>
