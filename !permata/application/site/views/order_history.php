<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div id="order-history" class="body-wrapper">
	<div class="cb" style="height:10px;"></div>
	
	
	<h2>MY ACCOUNT</h2>
	<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:20px; margin-top:5px;"></div>
	
	<?php $this->load->view('0member_header'); ?>
	
	<?php if(count($order) == 0) { ?>
	<?php echo 'No data'; ?>
	<?php } else { ?>
	<div id="table-history">
		<div class="fr row">
			<div class="fc col">ORDER</div>
			<div class="col">DATE</div>
			<div class="col">TOTAL PRICE</div>
			<div class="col">STATUS</div>
			<div class="lc col"></div>
			
			<div class="cb"></div>
		</div>
		
		<?php if($order){ foreach($order AS $val) { ?>
		<div class="row">
			<div class="fc col">
				<a href="<?php echo base_url('account/order_detail/'.$val->invoice_number);?>"><?php echo $val->invoice_number?></a>
			</div>
			<div class="col"><?php echo date('d M Y H:i:s', strtotime($val->order_date)); ?></div>
			<div class="col">IDR <?php echo $val->total_orders?></div>
			<div class="col"><?php echo ($val->cancel == 1) ? "Cancelled" : ( $val->accept == 1 ? "Accepted" : ($val->waiting == 1 ? "Waiting Payment Approval" : "Waiting for payment") ); ?></div>
			<div class="lc col">
				<?php if($val->waiting == 0) { ?>
				<a href="<?php echo base_url('account/confirm/'.$val->invoice_number);?>"><div class="red-button" style="width:110px; margin:auto; float:none;">CONFIRMATION</div></a>
				<?php }?>
			</div>
			
			<div class="cb"></div>
		</div>
		<?php } } ?>
	</div>
	<?php } ?>
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>