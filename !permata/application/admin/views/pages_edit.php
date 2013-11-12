<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
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
					<?php
					foreach($viewpages as $vp)
					{
						$id = $vp->id;
						$alias = $vp->alias;
						$title = $vp->title;
						$icon = $vp->icon;
						$content = $vp->tx;
						$meta_title = $vp->meta_title;
						$meta_keywords = $vp->meta_keywords;
						$meta_description = $vp->meta_description;
						$latitude = $vp->latitude;
						$template = $vp->template;
						$latitude = $vp->latitude;
						$image = $vp->image;
						$edit = $vp->edit;
						$fm = $vp->form_enable;
						$ti = strpos($fm,'ti');
						$ic = strpos($fm,'ic');
						$im = strpos($fm,'im');
						$mt = strpos($fm,'mt');
						$mk = strpos($fm,'mk');
						$md = strpos($fm,'md');
						$tx = strpos($fm,'tx');
						$lt = strpos($fm,'lt');
					}
					echo form_open_multipart('pages/save_pages'); 
					?>
					<input type="hidden" name="idpost" value="<?php echo $id ?>">
					<input type="hidden" name="aliaspost" value="<?php echo $alias ?>">
					
					<?php
					
						if($ti)
						{
						/*	
							echo '<div class="float"><div class="label col-120">Title</div></div>
								  <div class="float">
								  <input type="text" name="title" value="'.$title.'" style="width: 580px;"></div>
								  <input type="hidden" name="ti" value="'.$ti.'">
								  <div class="clear"></div>
								  ';
						*/
						}
						
						if($ic)
						{
							echo '<div class="float"><div class="label col-120">Caption</div></div>
								  <div class="float"><input type="text" name="icon" value="'.$icon.'" style="width: 580px;"></div>
								  <input type="hidden" name="ic" value="'.$ic.'">
								  <div class="clear"></div>
								  ';
						}
					?>
					<?php
						if($im)
						{
							if($image)
							{
					?>
					<div class='float'><div class='label col-120'>&nbsp </div></div>
					<div class="float"><img style="width:315px;" src="<?php echo $site_url.'/assets/img/page-banner/'.$vp->image; ?>"></div>
					<div class="clear"></div>
					<?php
							}
							echo '<div class="float"><div class="label col-120">Image</div></div>
								  <div class="float"><input style="width: 580px; margin-top:8px;" type="file" name="img"></div>
								  <input type="hidden" name="im" value="'.$im.'">
								  <div class="clear"></div>
								  ';
						}
						if($mt)
						{
							echo '<div class="float"><div class="label col-120">Meta Title</div></div>
								  <div class="float"><input type="text" name="metatitle" value="'.$meta_title.'" style="width: 580px;"></div>
								  <input type="hidden" name="mt" value="'.$mt.'">
								  <div class="clear"></div>
								  ';
						}
						if($mk)
						{
							echo '<div class="float"><div class="label col-120">Meta Keywords</div></div>
								  <div class="float"><input type="text" name="metakeyword" value="'.$meta_keywords.'" style="width: 580px;"></div>
								  <input type="hidden" name="mk" value="'.$mk.'">
								  <div class="clear"></div>
								  ';
						}
						if($md)
						{
							echo '<div class="float"><div class="label col-120">Meta Descriptions</div></div>
								  <div class="float"><input type="text" name="metadesc" value="'.$meta_description.'" style="width: 580px;"></div>
								  <input type="hidden" name="md" value="'.$md.'">
								  <div class="clear"></div>
								  ';
						}
						if($tx)
						{
							echo '<div class="float"><div class="label col-120">Content</div></div>
								  <div class="float"><textarea name="postcontent" class="myTextEditor">'.$content.'</textarea></div>
								  <input type="hidden" name="tx" value="'.$tx.'">
								  <div class="clear"></div>
								  ';
						}
						if($lt)
						{
							echo '<div class="float"><div class="label col-120">Map</div></div>
								  <div class="float"><input type="text" name="latitude" value="'.$latitude.'" style="width: 580px;"></div>
								  <input type="hidden" name="md" value="'.$lt.'">
								  <div class="clear"></div>
								  ';
						}
					?>

					<div class="float button-add" style="margin-left: 675px; margin-top:15px;"><input type="submit" value="Save"></div>
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
