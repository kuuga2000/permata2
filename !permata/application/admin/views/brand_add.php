<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>

	<div id="content" style="margin-left:157px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
						<div class='display-body'>
						<?php
							echo form_open_multipart($subpage.'/manufaktur_save'); 
						?>
					<!--	<div class='float' ><div class='label col-120'>Logo</div></div>
							<div class='float' style="margin-top:15px;"><input type='file' name="img"></div>
							<div class="clear"></div>-->
							<div class='float'><div class='label col-120'>Name <span class="star">*</span></div></div><div class='float'><input type='text' name='name'></div>
							<div class="clear"></div>
					<!--	<div class='float'>
								<div class='label col-120'>Description</div>
								<div class='float'><textarea class="ckeditor" name="description"></textarea></div>
								<div class='float'>&nbsp <input type="checkbox" name="descenable" value="1"> Enable</div>
							</div>-->
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Meta Title</div></div><div class='float'><input type='text' name='metatitle'></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Meta Description</div></div><div class='float'><input type='text' name='metadesc'></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Meta Keyword</div></div><div class='float'><input type='text' name='metakey'></div>
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
