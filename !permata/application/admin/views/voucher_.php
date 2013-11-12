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
					<div class="clear"></div>

					<div class='minitab-sub' style="background:#efefef;">
						<div class='float col-440'>
						<?php 
							echo anchor($subpage.'/Vouchers/voucher_set','Voucher'); 
							echo ' ['.$total_vocer.']'; 
							
						?>
						
						</div>
						<div class="float_r button_add">
							<?php echo anchor($subpage.'/Vouchers/voucher_setup','Add New Voucher');  ?>
						</div>
						<div class="clear"></div>
					</div>

					<?php
					if($this->uri->segment(3) == 'voucher_set')
					{
					?>
					<div class='minitab-sub'  style="background:#aaa; color:#fff">
						<div class='float col-380' style="font-weight:bold;">Voucher Name</div>
						<div class='float col-80' style="font-weight:bold;">Value</div>
						<div class='float col-80' style="font-weight:bold;">Voucher Type</div>
						<div class='float col-60' style="font-weight:bold;">Date Issue</div>
						<div class='float col-60' style="font-weight:bold;">Date Start</div>
						<div class='float col-80' style="font-weight:bold;">Date Expired</div>
						<div class="clear"></div>
					</div>
					<?php
						foreach($voucher as $vcr)
						{	
							if($this->uri->segment(4))
							{	$page = $this->uri->segment(4); }
							else
							{	$page = '0'; }
							
					?>
					<div class='minitab-sub'>
						<div class='float col-380' style="font-weight:bold;"><?php echo anchor($subpage.'/Vouchers/voucher_set/'.$page.'/'.$vcr->id_voucher.'/view',$vcr->vcr_caption); ?> </div>
						<div class='float col-80'><?php echo number_format($vcr->vcr_value, 0, ',', '.'); ?> </div>
						<div class='float col-80'><?php echo $vcr->vcr_type; ?> </div>
						<div class='float col-60'><?php echo date ("d/m/Y",strtotime($vcr->date_issue)); ?> </div>
						<div class='float col-60'><?php echo date ("d/m/Y",strtotime($vcr->date_start)); ?> </div>
						<div class='float col-80'><?php echo date ("d/m/Y",strtotime($vcr->date_expired)); ?> </div>
						<div class="clear"></div>
					</div>
					<?php
							if($dattr == $vcr->id_voucher){
					?>
					<div class='minitab-sub' style="font-style:italic;">
						<div class='float col-260'>Code</div>
						<div class='float col-260'>Owner (Customer Name/ Email)</div>
						<div class="float_r button_add">
							<?php echo anchor($subpage.'/Vouchers/code_setup/'.$vcr->id_voucher.'/'.$vcr->vcr_value.'/'.$vcr->vcr_type,'Add New Code');  ?>
						</div>
						<div class="clear"></div>
					</div>
					<?php
								foreach($voucher_use as $vu){
								if($vu->emailvcr)
								{	$owner = $vu->emailvcr;	$name = ''; }
								else if($vu->emailcust)
								{	$owner = $vu->emailcust; $name = $vu->firstname.' '.$vu->lastname.', '.$vu->phone; 	}
								else { 	$owner = anchor($subpage.'/Vouchers/code_setup/'.$vcr->id_voucher.'/'.$vcr->vcr_value.'/'.$vcr->vcr_type.'/'.$vu->id_vcr_used,'Not Registered'); 	$name = ''; 	}
								
					?>
					<div class='minitab-sub'>
						<div class='float col-260'><?php echo $vu->code; ?></div>
						<div class='float col-220 emailink'><?php echo $owner; $owner = ''; ?></div>
						<div class='float col-260'><?php echo $name; $name = ''; ?></div>
						<div class="clear"></div>
					</div>
					<?php
								}
							}
						}
						if($link)
						{
					?>
					<div class='minitab-sub' style="background:#aaa; color:#fff"">
						<div class='float col-440' style="text-align:center">  <?php echo '<div class="page-nums">Page '.$link.'</div>'?></div>
						<div class="clear"></div>
					</div>
					<?php
						}
					}
					?>
					<div class='minitab-sub' style="background:#efefef;">
						<div class='float col-440'>
						<?php echo anchor($subpage.'/Vouchers/voucher_not_use','Voucher Not Use'); ?> 
						<?php echo ' ['.$total_vocer_notuse.']';  ?>
						</div>
						<div class="clear"></div>
					</div>
					<?php
					if($this->uri->segment(3) == 'voucher_not_use')
					{
					?>
					<div class='minitab-sub' style="font-style:italic;">
						<div class='float col-260'>Code</div>
						<div class='float col-260'>Owner (Customer Name/ Email)</div>
						<div class="clear"></div>
					</div>
					<?php
								foreach($voucher_not_use as $vu){
					?>
					<div class='minitab-sub'>
						<div class='float col-260'><?php echo $vu->code; ?></div>
						<div class='float col-220 emailink'><?php echo anchor($subpage.'/Vouchers/use_voucher_code/'.$vu->id_vcr_used,'Not Registered'); ?></div>
						<div class="clear"></div>
					</div>
					<?php
								}
					}
					?>

					<div class="clear"></div>
					<?php
					if($this->uri->segment(3) == 'voucher_setup')
					{
						echo form_open($subpage.'/save_voucer'); 
					?>

					<div class='float'><div class='label col-160'>Voucher Name</div></div>
					<div class='float'><input type='text' name='captionname' ></div>
					<span class="float star">* this information needed</span>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Customer Group</div></div>
					<div class='float'>
						<select name="customergrup">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>
					
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Code Length</div></div>
					<div class='float'><input type='text' name='codelength' > example : '8'</div>
					<span class="float star">* this information needed</span>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Code Separator</div></div>
					<div class='float'><input type='text' name='codeseparator' > example : '-/_~'</div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Code Length Separator</div></div>
					<div class='float'><input type='text' name='codeseparatorlength' >example : '4' </div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'> &nbsp </div></div>
					<div class='float'><div class='label col-500' style="background:#cfc; margin-top:5px; padding:5px 5px 5px 15px;">Code example for code length '8' separator '-' and length separator '4'; (XXXX-XXXX)</div></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Code Type</div></div>
					<div class='float'>
						<select name="codetype">
							<option value="Automatic">Automatic</option>
							<option value="Manual">Manual</option>
						</select>
					</div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Voucher Discount Value</div></div>
					<div class='float'><input type='text' name='vouchervalue' ></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Voucher Type</div></div>
					<div class='float'>
						<select name="vouchertype">
							<option value="Value">Value</option>
							<option value="Percent">Percent</option>
						</select>
					</div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Quantity</div></div>
					<div class='float'><input type='text' name='qty' ></div>
					<span class="float star">* this information needed</span>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Specific Product</div></div>
					<div class='float'>
						<select name="specificproduct">
							<option value="0"></option>
				<?php
				foreach ($product_list as $pl)
				{
						echo '<option value="'.$pl->id_product.'">'.$pl->name.'</option>';
				}
				?>
							

						</select>
					</div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Date Issue</div></div>
					<div class='float'><input type='text' class="datepicker" name='issue' ></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Date Started</div></div>
					<div class='float'><input type='text' class="datepicker" name='started' ></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-160'>Date Expired</div></div>
					<div class='float'><input type='text' class="datepicker" name='expire' ></div>
					<div class="clear"></div>
					<div class='float col-160'> &nbsp </div>
					<div class='float col-120'><input type='submit' name='submit' value='Save'></div>
					<?php echo form_close() ?>
					<div class="clear"></div>

					<?php
					}
					?>
					
					<?php
					if($this->uri->segment(3) == 'code_setup')
					{
						if($this->uri->segment(7))
						{
							foreach($konfigurasi as $konf)
							{
								$idcode = $konf->id_vcr_used;
								$reso = $konf->code;
								$date_issue = date("d/m/Y",strtotime($konf->date_issue));
								$date_start = date("d/m/Y",strtotime($konf->date_start));
								$date_expired = date("d/m/Y",strtotime($konf->date_expired));
								echo form_open($subpage.'/edit_code'); 
							}
						}
						else
						{
							foreach($konfigurasi as $konf)
							{
								$code_length = $konf->code_length;
								$code_separator = $konf->code_separator;
								$length_separator = $konf->length_separator;
								$code_type = $konf->code_type;
								$vcr_value = $konf->vcr_value;
								$vcr_type = $konf->vcr_type;
								$product_name = $konf->name;
								$date_issue = date("d/m/Y",strtotime($konf->date_issue));
								$date_start = date("d/m/Y",strtotime($konf->date_start));
								$date_expired = date("d/m/Y",strtotime($konf->date_expired));
								$vcr_caption = $konf->vcr_caption;
								$qty = $konf->qty;
								$counts = $konf->counts;
						
									if($counts >= $qty)
									{	$disabled = 'disabled'; $text = 'This promotion code has reached maximum value';
									}
									else { $disabled = ''; $text = ''; }
								
								$res   = (strtoupper(substr(md5(time()), 0, $code_length)));
								if($length_separator)
								{	$code_result = $code_length / $length_separator;	}
								else { $code_result = $code_length; }
								
								$reso = '';
								$a = 0;
								if($length_separator)
								{
									for($i = 0; $i <= $code_result; $i++)
									{
										$resw = $code_separator.''.substr($res, $a, $length_separator);
										$reso = $reso.''.$resw;
										$a = $a + $length_separator;
									}

									$reso = substr($reso, 1); 
									$reso = substr($reso,0, -1); 
								}
								else
								{
									$reso = $res;
								}
								

								echo form_open($subpage.'/save_code'); 
							}
						}
						
					?>
					<?php
						if(!$this->uri->segment(7))
						{
					?>
					<div class='float'><div class='label col-440' style="font-weight:bold;">Total Used : <?php echo $counts ; ?> / <?php echo $qty; ?> <span class="star"><?php echo  $text; ?></span></div></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120' style="margin-top:-1px;">Automatic Code</div></div>
					<div class='float' style="font-weight:bold; font-size:14px;"><?php echo $reso ?></div>
					<div class="clear"></div>	
					<div class='float'><div class='label col-120'>Manual Code</div></div>
					<div class='float'>
					<input type="hidden" name="code_length" value="<?php echo $code_length ?>">
					<input type="hidden" name="id_voucher" value="<?php echo $this->uri->segment(4); ?>">
					<input type="hidden" name="vocer_val" value="<?php echo $this->uri->segment(5); ?>">
					<input type="hidden" name="vocer_type" value="<?php echo $this->uri->segment(6); ?>">
					
					<input type="hidden" name="code_length" value="<?php echo $code_length ?>">
					<input type="hidden" name="code_separator" value="<?php echo $code_separator ?>">
					<input type="hidden" name="length_separator" value="<?php echo $length_separator ?>">
					<input type="hidden" name="codeauto" value="<?php echo $reso ?>">
					<input type='text' name='code' placeholder="<?php echo $res ?>" <?php echo $disabled?>>	Code Length : <?php echo $code_length; ?></div>
					<div class="clear"></div>	
					<div class='float'><div class='label col-120'>Specific Product</div></div>
					<input type="hidden" name="product_name" value="<?php echo $product_name ?>">
					<div class='float' style="margin-top:13px;"> <?php echo $product_name; ?></div>
					<div class="clear"></div>	
					<?php
						}
						else
						{
					?>
					<input type="hidden" name="voucher_code" value="<?php echo $idcode; ?>" >
					<div class='float'><div class='label col-120' style="margin-top:15px;">Redeem Code</div></div>
					<div class='float' style="font-weight:bold; font-size:14px; margin-top:15px;"><?php echo $reso ?></div>
					<div class="clear"></div>	
					<?php
						}
					?>
					<h2>Give To Customer</h2> 
					<div class='float'><div class='label col-120'>Customer Name</div></div>
					<div class='float'>
						<select name="customer" <?php echo @$disabled?>>
						<option value=""></option>
					<?php
					foreach($cust as $cus)
					{
						echo '<option value="'.$cus->id_customer.'">'.$cus->firstname.' '.$cus->lastname.'</option>';
					}
					?>
						</select>
					</div>
					<div class="clear"></div>
					<div class='float' style="margin-left:25px"><h3>Or Send To Email</h3></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Email</div></div>
					<div class='float'><input type='text' name='email' <?php echo @$disabled?>> </div>
					<div class="clear"></div>
					<hr>
					<div class='float'><div class='label col-120'>Date Issue</div></div>
					<div class='float'><input type='text' name='dateissue' class="datepicker" value="<?php echo $date_issue; ?>" <?php echo @$disabled?>> </div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Date Start</div></div>
					<div class='float'><input type='text' name='datestart' class="datepicker" value="<?php echo $date_start; ?>" <?php echo @$disabled?>></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Date Expire</div></div>
					<div class='float'><input type='text' name='dateexpired' class="datepicker" value="<?php echo $date_expired; ?>" <?php echo @$disabled?>></div>
					<div class="clear"></div>
					<div class='float col-160'> &nbsp </div>
					<div class='float col-120'><input type='submit' name='submit' value='Save' <?php echo @$disabled?>></div>
					<?php echo form_close() ?>
					<div class="clear"></div>
					<?php
					}
					?>

					<?php
					if($this->uri->segment(3) == 'use_voucher_code')
					{

						foreach($konfigurasi_rator as $konf)
							{
								$idcode = $konf->id_vcr_used;
								$reso = $konf->code;
								$date_issue = date("d/m/Y",strtotime($konf->date_issue));
								$date_start = date("d/m/Y",strtotime($konf->date_start));
								$date_expired = date("d/m/Y",strtotime($konf->date_expired));
								echo form_open($subpage.'/edit_code'); 
							}
					?>
					<input type="hidden" name="voucher_code" value="<?php echo $idcode; ?>" >
					<div class='float'><div class='label col-120' style="margin-top:15px;">Redeem Code</div></div>
					<div class='float' style="font-weight:bold; font-size:14px; margin-top:15px;"><?php echo $reso ?></div>
					<div class="clear"></div>	


					
					<h2>Give To Customer</h2> 
					<div class='float'><div class='label col-120'>Customer Name</div></div>
					<div class='float'>
						<select name="customer">
						<option value=""></option>
					<?php
					foreach($cust as $cus)
					{
						echo '<option value="'.$cus->id_customer.'">'.$cus->firstname.' '.$cus->lastname.'</option>';
					}
					?>
						</select>
					</div>
					<div class="clear"></div>
					<div class='float' style="margin-left:25px"><h3>Or Send To Email</h3></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Email</div></div>
					<div class='float'><input type='text' name='email' > </div>
					<div class="clear"></div>
					<hr>
					<div class='float'><div class='label col-120'>Date Issue</div></div>
					<div class='float'><input type='text' name='dateissue' class="datepicker" value="<?php echo $date_issue; ?>" > </div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Date Start</div></div>
					<div class='float'><input type='text' name='datestart' class="datepicker" value="<?php echo $date_start; ?>" ></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Date Expire</div></div>
					<div class='float'><input type='text' name='dateexpired' class="datepicker" value="<?php echo $date_expired; ?>" ></div>
					<div class="clear"></div>
					<div class='float col-160'> &nbsp </div>
					<div class='float col-120'><input type='submit' name='submit' value='Save'></div>
					<?php echo form_close() ?>
					<div class="clear"></div>
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
