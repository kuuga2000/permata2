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
						<div class='display-head'>
							<div class='col-440'>Title</div>
							<div class='col-440'>Detail</div>
						</div>
						<div class="clear"></div>
						<div class="display-page">
						<?php
						foreach ($subpages as $news) {
							if($news->status) {$status = 'Enable'; } else { $status = 'Disable';}

							echo 
							   '<div class="page-list">
								<div class="col-440" style="font-weight:bold; background:none;"><span><b>'.$news->title.'</b></span></div>';
							if($news->edit)
							{	echo '<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor('pages/post/'.$news->id,'[View]').'</span></div>';	}
							else
							{	echo '<div class="col-40" style="font-weight:bold; background:none;"> &nbsp </div>'; }
							echo '<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor('pages/pages_edit/'.$news->id,'[Edit]').'</span></div>';
							if($news->status_lock)
							{
								echo	'<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor('pages/pages_enable/'.$news->id.'/'.$news->status,'['.$status.']').'</span></div>';
							}	
							echo	'</div>'; 
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
