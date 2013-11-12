<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
<?php

?>

	<div id="content" style="margin-left:157px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
				<?php
					foreach($post_info as $pg)
					{
						$titles = $pg->title;
						$icon = $pg->icon;
					}
				?>
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $titles; ?></h1>
					<div class='display'>
					<div class="float_r button-add" style="margin-top:-25px; margin-bottom:25px;" ><?php echo anchor('pages/post/'.$this->uri->segment(3),'Back') ?></div>

					<?php
					$id_post = '';
					$alias_post = '';
					$title_post = '';
					$meta_title_post = '';
					$meta_keywords_post = '';
					$meta_description_post = '';
					$tx_post = '';
					$stats = '';
					if($post_edit)
					{					
						foreach($post_edit as $pe)
						{
							$id_post = $pe->id;
							$alias_post = $pe->alias;
							$title_post = $pe->title;
							$meta_title_post = $pe->meta_title;
							$meta_keywords_post = $pe->meta_keywords;
							$meta_description_post = $pe->meta_description;
							$tx_post = $pe->tx;
							if($pe->status){ $stats = 'checked'; } else { $stats = ''; }
						}
					}
					if($id_post)
					{
						echo '<div class="float_r button-add deleteform" style="margin-top:-25px; margin-bottom:25px; margin-right:3px;" >'.anchor('pages/post_delete/'.$this->uri->segment(3).'/'.$this->uri->segment(4),'Delete').'</div>';
					}
					echo form_open('pages/post_save');
					?>
					<div class='float'><div class='label col-120'>Title</div></div>
					<input type="hidden" name="newpost" value="<?php echo $this->uri->segment(3); ?>">
					<input type="hidden" name="idpost" value="<?php echo $id_post ?>">
					<input type="hidden" name="aliaspost" value="<?php echo $alias_post ?>">
					<div class='float'><input type='text' name='title' value="<?php echo $title_post; ?>" style="width: 580px;"> 
					<?php
					if($id_post)
					{
						echo '&nbsp <input type="checkbox" name="status" value="1" '.$stats.'> Enable ';
					}
					else
					{
						echo '<input type="hidden" name="status" value="1">';
					}
					?>
					</div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Post Content</div></div><div class='float'><textarea class="myTextEditor" name="postcontent"><?php echo $tx_post; ?></textarea></div>
					<div class="clear"></div>
					<div class="float button-add" style="margin-left: 675px; margin-top:15px;"><input type="submit" value="Save"></div>
					<?php
					echo form_close();
					
					?>

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
