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
				<div class="float">
					 <div id="chart_div" style="width: 450px; height: 250px;"></div>
					 <div id="block_div" style="width: 400px; height: 200px;"></div>
				</div>
				
				<div class="float">
				<div class="float buttoadd"><a href="">Add<br>Product</a></div>
				<div class="float buttoadd"><a href="">Add<br>Order</a></div>
				<div class="float buttoadd"><a href="">Add<br>Customer</a></div>
				<div class="float buttoadd"><a href="">Add<br>Voucher</a></div>
				<div class="clear"></div>
				<div class='minitab-sub' style="background:#ccc; height:22px;">
						<div class="float col-120">Payment</div>
						<div class='float col-440'>[10]</div>
				</div>
				<div class='minitab-sub' style="background:#ccc; height:22px;">
						<div class="float col-120">New Customer</div>
						<div class='float col-440'>[10]</div>
				</div>
				<div class="clear"></div>
				<div class='display-head'>
					<div class='col-220'>Payment Method</div>
					<div class='col-220'>Account Name</div>
					<div class='col-220'>#Id</div>
				</div>
				<div class="clear"></div>
				<div class='display-body'>
				<a href="">
					<div class="col-220">Bank Transfer</div>
					<div class="col-220">Philip Richard</div>
					<div class="col-220">347115110</div>
				</a>
				<a href="">
					<div class="col-220">Bank Transfer</div>
					<div class="col-220">Philip Richard</div>
					<div class="col-220">347115110</div>
				</a>
				<a href="">
					<div class="col-220">Bank Transfer</div>
					<div class="col-220">Philip Richard</div>
					<div class="col-220">347115110</div>
				</a>
				<a href="">
					<div class="col-220">Bank Transfer</div>
					<div class="col-220">Philip Richard</div>
					<div class="col-220">347115110</div>
				</a>
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
