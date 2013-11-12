<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
<?php
	$idgall = '';
	$caption = '';
	$img = '';
	$pos = '';
	$edit = '';
	$url = '';
	if($data_home)
	{
		foreach($data_home as $dh)
		{
			$idgall = $dh->id;
			$caption = $dh->title;
			$img = $dh->img;
			$pos = $dh->pos;
			$edit = $dh->edit;
			$url = $dh->url;
		}
	}
?>	
	<div id="content" style="margin-left:157px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $title; ?> ( <?php if($caption){ echo $caption; } else { echo 'NEW'; } ?> )</h1>
					<div class='display'>
					<?php echo form_open('pages/save_home_gall'); ?>
					<input type="hidden" name="idpost" value="<?php echo $idgall; ?>">
					<input type="hidden" name="idpagesnew" value="<?php echo $this->uri->segment(3); ?>">
					<input type="hidden" name="idpostnew" value="<?php echo $this->uri->segment(4); ?>">
					<?php
					if($edit) // ini ambil dari post.status dan hanya yang bernilai 1 maka akan muncul
					{
						echo '<div class="float"><div class="label col-120">Caption</div></div>';
						echo '<div class="float"><input type="text" name="caption" value="'.$caption.'"></div>';
						echo '<div class="clear"></div>';
						echo '<div class="float"><div class="label col-120">Url</div></div>';
						echo '<div class="float"><input type="text" name="url" value="'.$url.'"></div>';
						echo '<div class="clear"></div>';
					}
					else if(!$data_home){
						echo '<div class="float"><div class="label col-120">Caption</div></div>';
						echo '<div class="float"><input type="text" name="caption"></div>';
						echo '<div class="clear"></div>';
						echo '<div class="float"><div class="label col-120">Url</div></div>';
						echo '<div class="float"><input type="text" name="url"></div>';
						echo '<div class="clear"></div>';
					}
					else
					{
						echo '<input type="hidden" name="caption" value="'.$caption.'">';
					}
					?>
					

					<div style="margin-bottom:55px;"></div>
					<div class="float" style="background:#f4f4f4;">
					<div class="float" style="margin-top:-35px; background:#ccc; width:100%; height:35px;">
					<div class="float_r button_add" style="margin:8px 8px 0px 0px;"><?php echo anchor('pages/add_gallery/'.$this->uri->segment(3).'/'.$this->uri->segment(4),'Add New Images'); ?> <?php echo anchor('pages/post_gallery/'.$this->uri->segment(3).'/'.$this->uri->segment(4),'Back'); ?></div></div>
					<div class="float" style="padding:15px 0px 0px 15px;">
					<?php
						foreach($gallery as $gal)
						{
							if(@$img == $gal->img) { $cheked = 'checked'; } else { $cheked = ''; } 
							if($gal->img)
							{
							$count = $gal->count - 1;
					?>
					<div class="float" style="border:#ccc dotted 1px; padding:0px 15px 10px 15px; width:315px; margin-right:15px; margin-bottom:15px; background:#fff;">
						<span class="float" style="margin-bottom:-30px; padding-top:3px;">use(<span style="color:#f00;"><?php echo $count; ?></span>)</span><span class="float_r deleteform" style="margin-bottom:-30px; padding-top:3px; margin-right:25px;"><?php echo anchor('pages/delete_gallery/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$gal->img,'(x)'); ?></span>
						<div class="clear"></div>
						<div class="float" style="margin-left:300px; margin-bottom:4px;">
						<input type="radio" name="picture" value="<?php echo $gal->img; ?>" <?php echo $cheked ?>>
						</div>
						<div class="float">
						<?php
							echo '<img style="width:315px;" src="'.$site_url.'/assets/upload/gallery/'.$gal->img.'"></div>';
						?>
					</div>
					<?php
							}
						}
					?>
					</div>
					</div>
					<div class="clear"></div>
					<div class="float" style="margin-top:15px;"><input type="submit" name="submit" value="Save"></div>
					<?php echo form_close(); ?>
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
