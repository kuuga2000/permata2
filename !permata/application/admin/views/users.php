<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
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
						<div class='display-head'>
							<div class='col-120'>Username</div>
							<div class='col-220'>Name</div>
							<div class='col-120'>Email</div>
						</div>
						<div class="clear"></div>
						<div class='display-body'>
						
						<?php
						$row = 1;
						foreach ($data_all as $all) {
							echo anchor('users/'.$all->username,'
														<div class="col-120">'.$all->username.'</div>
														<div class="col-220">'.$all->firstname.' '.$all->lastname.'</div>
														<div class="col-120">'.$all->email.'</div>'); 
							$row++;
						}
						?>
						</div>
					</div>
					
				</div>
				<div class="clear"></div>
				<?php echo '<div class="page-nums">'.$this->pagination->create_links().'</div>'?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php $this->load->view('00footer.php'); ?>
