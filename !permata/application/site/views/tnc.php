<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>
<?php $this->load->view('0breadcrumb'); ?>

<div id="tnc" class="body-wrapper">
	<div class="cb" style="height:10px;"></div>
	
	<div class="col">
		<div class="title"><?php echo $page_detail->title; ?></div>
		<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:22px; margin-top:5px;"></div>
		<?php echo $page_detail->tx; ?>
	</div>
	
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>