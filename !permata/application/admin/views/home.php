<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
<?php $this->load->view('00header.php'); ?>

<div id="wrap">

<?php $this->load->view('00sidemenu.php');?>
	<div id="content">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
				<div id="breadcrumb">
					<?php
					echo $title;
					?>
					</div>

				<div>
				<h1>Welcome, Admin!</h1>
				<pre>
				This is your Administrator Panel, you can add or edit your website contents here. 
				You can start by clicking your point of interest on the left main menu. 
				</pre>
				</div>
				<div class="float">
				
				<div class="float buttoadd"><?php echo anchor('product/add','Add<br>Product'); ?></div>
				<div class="float buttoadd"><?php echo anchor('transactions/customers_setup','Add<br>Customer'); ?></div>
				<div class="float buttoadd"><?php echo anchor('transactions/voucher/add','Add<br>Voucher'); ?></div>
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
