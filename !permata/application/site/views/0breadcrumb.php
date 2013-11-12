<div id="breadcrumb">
	<?php $ctr = 0; foreach($breadcrumb AS $key => $val) { $ctr++;?>
	<a href="<?php echo $val['url']?>">
		<div class="breadcrumb-item <?php echo ($ctr == 1 ? "first":"")?>">
			<?php echo $val['label']?>
		</div>
	</a> 
	
	<?php if($ctr < count($breadcrumb)) { ?>
		<div class="breadcrumb-separator">/</div> <?php 
	} ?>
	
	<?php } ?>
	<div class="cb" style="height:5px;"></div>
</div>
	