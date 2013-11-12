<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>
<?php $this->load->view('0breadcrumb'); ?>

<div id="faq" class="body-wrapper">
	<div class="cb" style="height:10px;"></div>
	
	<div class="col">
		<div class="title"><?php echo $page_detail->title; ?></div>
		<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:22px; margin-top:5px;"></div>
		<?php $ctr = 0; 
		if ($faq_list) {
			foreach($faq_list as $val) { $ctr++;?>
			<div class="faq <?php echo ($ctr%3==0 ? "last-column":"")?>">
				<div class="question"><?php echo $val->title;?></div>
				<div class="answer"><?php echo $val->tx;?></div>
			</div>
			<?php if($ctr%3==0) { echo "<div class='cb'></div>";}?>
			<?php } ?>
		<?php }?>
	</div>
	
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>