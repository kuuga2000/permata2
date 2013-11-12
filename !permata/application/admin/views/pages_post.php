<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>

	<div id="content" style="margin-left:157px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
				<?php
				if(($this->uri->segment(3) == 'Edit') OR ($this->uri->segment(3) == 'Add'))
				{
					$icon = $this->uri->segment(3);
				}
				else
				{
				foreach($post_info as $pg)
					{
						$icon = $pg->icon;
					}
				}
				?>
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $icon; ?></h1>
					<div class='display'>
					<div class="float_r button-add" style="margin-top:-25px; margin-bottom:25px;" ><?php echo anchor('pages','Back') ?></div>
					<?php
					if($this->uri->segment(3) == 'Edit')
					{
					?>
					<div class="float_r button-add" style="margin-top:-25px; margin-bottom:25px; margin-right:3px;" ><?php echo anchor('pages/post_delete/'.$this->uri->segment(4),'Delete') ?></div>
					<?php
					}
					if($this->uri->segment(3) != $home_id) 
						// untuk nandain home atau bukan ... $home_id adalah id pages untuk home, itu tombolnya untuk pages bukan home
						// $home_id diambil dari file global.php 
					{
					echo '<div class="float_r button-add" style="margin-right:5px; margin-top:-25px; margin-bottom:15px;">'.anchor('pages/post_edit/'.$this->uri->segment(3),'Add').'</div>';
					}
					?>
						<div class='display-head'>
							<div class='col-80'>Title</div>
						</div>
						<div class="clear"></div>
						<div class='display-page'>	
					<?php
					if($post_list)
					{
						foreach($post_list as $posts)
						{
							if($this->uri->segment(3) != $home_id)
							{
								echo '<div class="page-list"><div class="col-440" style="font-weight:bold; background:none;"><span><b>'.$posts->title.'</b></span></div>';
								echo '<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor('pages/post_edit/'.$this->uri->segment(3).'/'.$posts->id,'[View]').'</span></div>';
								echo '<div class="col-40 deleteform" style="font-weight:bold; background:none;"><span>'.anchor('pages/post_delete/'.$this->uri->segment(3).'/'.$posts->id,'[Delete]').'</span></div>';
								echo '</div>';
							}
							else
							{
								echo '<div class="page-list"><div class="col-440" style="font-weight:bold; background:none;"><span><b>'.$posts->title.'</b></span></div>';
								echo '<div class="col-40 " style="font-weight:bold; background:none;"><span>'.anchor('pages/post_gallery/'.$this->uri->segment(3).'/'.$posts->id,'[View]').'</span></div>';
								echo '</div>';
							}
						}
					}
					?>
						</div>
					<?php echo '<div class="page-nums">'.$pages.'</div>'?>
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
