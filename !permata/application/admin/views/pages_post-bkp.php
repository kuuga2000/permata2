<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
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
				if(($this->uri->segment(3) == 'Edit') OR ($this->uri->segment(3) == 'Add'))
				{
					$titles = 'Pages';
					$icon = $this->uri->segment(3);
				}
				else
				{
				foreach($post_info as $pg)
					{
						$titles = $pg->title;
						$icon = $pg->icon;
					}
				}
				?>
					<div id="breadcrumb">
					<?php
					/*
					if($breadc)
					{
						foreach ($breadc as $bc)
						{
							if($bc->level == 1)
							{ echo $bc->cru1.' > '.$bc->cru2.' > '.$title;  }
							else if( $bc->level == 0)
							{ echo $bc->cru1.' > '.$title;  }
							else
							{ echo $this->uri->segment(1);}
						}
					}
					else
					{	echo $title;	}
					*/
					echo $title.' > Post > '.$titles;
					?>
					</div>
					<h1><?php echo $icon; ?></h1>
					<div class="float_r button-add" ><?php echo anchor('pages','Back') ?></div>
					<?php if(($this->uri->segment(3) != 'Add') AND ($this->uri->segment(3) != 'Edit'))
					{
					?>
					<div class="float_r button-add" style="margin-right:5px;"><?php echo anchor('pages/post/Add/'.$this->uri->segment(3),'Add') ?></div>
					<?php } ?>
					<div class='display'>
						<?php echo '<div class="page-nums">'.$pages.'</div>'?>
						<div class='display-head'>
							<div class='col-80'>Photo</div>
							<div class='col-120'>Product Name</div>
							<div class='col-120'>Brand Name</div>
							<div class='col-120'>Price</div>
							<div class='col-80'>Hot Deals</div>
							<div class='col-80'>Enable</div>
						</div>
						<div class="clear"></div>
						<div class='display-body'>	
					<?php
					foreach($post_list as $posts)
					{
					?>
					<div style="padding:25px;">
					<div style="font-size:16px;">A<?php echo anchor('pages/post/Edit/'.$posts->alias,$posts->title); ?></div>
					<div style="padding:15px;">
					<p><?php echo $posts->tx; ?></p>
					</div>
					<div style="border-top:dotted 1px #ccc;"></div>
					</div>
					<?php
					}
					?>
						</div>

					
					<?php echo '<div class="page-nums">'.$pages.'</div>'?>
					<?php
					if(($this->uri->segment(3) != 'Edit') AND ($this->uri->segment(3) != 'Add'))
					{
					?>
					<div class="float_r button-add"><?php echo anchor('pages','Back') ?></div>
					<div class="float_r button-add" style="margin-right:5px;"><?php echo anchor('pages/post/Add/'.$this->uri->segment(3),'Add') ?></div>
					<?php
					}
					?>
					
					<?php
					
					if(($this->uri->segment(3) == 'Edit') OR  ($this->uri->segment(3) == 'Add'))
					{
						if($this->uri->segment(3) == 'Edit')
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
						else
						{
							$id_post = '';
							$alias_post = '';
							$title_post = '';
							$meta_title_post = '';
							$meta_keywords_post = '';
							$meta_description_post = '';
							$tx_post = '';
							$stats = '';
						}
					echo form_open('pages/post_save');
					if($this->uri->segment(3) == 'Add') 
					{ echo '<input type="hidden" name="pagesalias" value="'.$this->uri->segment(4).'">';}
					?>
					<div class='float'><div class='label col-120'>Title</div></div>
					<input type="hidden" name="idpost" value="<?php echo $id_post ?>">
					<input type="hidden" name="aliaspost" value="<?php echo $alias_post ?>">
					<div class='float'><input type='text' name='title' value="<?php echo $title_post; ?>" style="width: 580px;"> &nbsp <input type="checkbox" name="status" value="1" <?php echo  $stats; ?>> Enable </div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Meta Title</div></div><div class='float'><input style="width: 580px;" type='text' name='metatitle' value="<?php echo $meta_title_post; ?>"></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Meta Keywords</div></div><div class='float'><textarea style="width: 580px;" name="metakeyword" ><?php echo $meta_keywords_post; ?></textarea></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Meta Descriptions</div></div><div class='float'><textarea style="width: 580px;" name="metadesc"><?php echo $meta_description_post; ?></textarea></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-120'>Post Content</div></div><div class='float'><textarea class="myTextEditor" name="postcontent"><?php echo $tx_post; ?></textarea></div>
					<div class="clear"></div>
					<div class="float button-add" style="margin-left: 675px; margin-top:15px;"><input type="submit" value="Save"></div>
					<?php
					echo form_close();
					}
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
