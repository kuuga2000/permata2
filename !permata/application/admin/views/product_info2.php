<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
<?php 
	$id_product = '';
	if ($product_detail)
	{
		$id_product = $product_detail->id_product;
	}							
?>
	<div id="submenu-pages">
		<div id="submenuback"></div>

		<div id="submenuwrap">
			<div id="submenushadow"></div>

			<ul id="submenu">

				<?php
				foreach ($subpages as $p) {
					//if (priv_page($p->alias)) {

				?>
				<?php if($p->alias == 'information'){ ?>
				<a href="<?php echo site_url(); ?>product/<?php echo $p->alias; ?>/<?php echo $id_product; ?>">
					<li>
						<div class="inner">
							<div class="title"><?php echo $p->name; ?></div>
							<div class="clear"></div>
						</div>
					</li>
				</a>
				<?php 
				}
				else
				{
				?>
				<a href="" >
					<li>
						<div class="inner">
							<div class="title" style="color:#ddd;"><?php echo $p->name; ?></div>
							<div class="clear"></div>
						</div>
					</li>
				</a>
				<?php } ?>
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
						<div class='display-body'>
						<?php
							echo form_open($subpage.'/prod_save'); 
						?>
							<div class='float'><div class='label col-120'>Product Name<span class="star">*</span></div></div>
							<div class='float'><input type='text' name='product'> <input type="checkbox" value="processed" name="status" style="margin-left: 5px;" /> process  
							<input type="hidden" name="enable" value="1"> 
							<?php
							foreach($productid as $pid){
								$proid = $pid->id_product + 1;
								echo '<input type="hidden" name="productid" value="'.$proid.'">';
							}
							?>
							
							</div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Attribute</div></div>
							<div class='float' style="margin-top:15px;">
								 <input type="checkbox" name="hotdeal" value='1'> Sale &nbsp 
								 <input type="checkbox" name="paket" value='1'> Paket &nbsp 
								 <input type="checkbox" name="promosi" value='1'> Promotions &nbsp 
								 <input type="checkbox" name="clear" value='1'> Clearance &nbsp 
								 <input type="checkbox" name="new" value='1'> New 
								 
							</div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Code Number<span class="star">*</span></div></div><div class='float'><input class="upper" type='text' name='code'></div>
							
							<div class="clear"></div>
							
							<!--<div class='float'><div class='label col-120'>Date Release</div></div><div class='float'><input type='text' name='date' class='datepicker'></div>
							<div class="clear"></div>-->
							<div class='float'><div class='label col-120'>Brand Name</div></div><div class='float'>
							<select name="idbrand">
							<?php 
							foreach ($manuf as $m)
							{
								echo '<option value='.$m->id_manufacturer.'>'.$m->manuf_name.'</option>';
							}
							?>
							</select>
							</div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Description</div></div><div class='float'><textarea class="myTextEditor" name="description"></textarea></div>
							<div class="clear"></div>
							<span class="float star-box">* This information needed</span>
							<div class="clear"></div>
							<div class='float'><input type='submit' name='submit' value='Save'></div>
						<?php echo form_close() ?>
						</div>
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
