<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
	<div id="submenu-pages">
		<div id="submenuback"></div>
		<div id="submenuwrap">
			<div id="submenushadow"></div>
			<ul id="submenu">
				<?php
				foreach ($subpages as $p) {
					//if (priv_page($p->alias)) {
				?>
				<a href="<?php echo site_url(); ?>catalog/<?php echo $p->alias; ?>">
					<li>
						<div class="inner">
							<div class="title"><?php echo $p->name; ?></div>
							<div class="clear"></div>
						</div>
					</li>
				</a>
				<?php //}
				} ?>
			</ul>
		</div>
	</div>
	

	<div id="content" style="margin-left:357px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb">
					<?php
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
					?>
					</div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
					<div class='minitab-sub' style="background:#ccc; margin-top:15px;">
						<div class='float col-40'>No</div>
						<div class='float col-260'>Category Name</div>
						<div class='float col-260'>Enable</div>
						<div class="clear"></div>
					</div>
					<?php
					$position = 1;
					foreach ($catlist as $ptr)
					{
						if(@$store != $ptr->lev1)
						{
					?>
					<div class="minitab-sub"  style="background:#efefef; <?php if($this->uri->segment(3) == $ptr->idlev1) { echo 'height:33px;'; } else { echo 'height:19px;';} ?> ">
						<div class='float col-40'><?php echo $position; ?></div>
						<div class='float col-260'>
						<?php 
						if($this->uri->segment(3) == $ptr->idlev1)
						{
							echo '<input type="text" name="location_name"  style="font-size:12px; height:20px; width:105px; margin-top:1px; margin-right:7px;" value="'.$ptr->lev1.'">';
							echo '<input style="margin-top:-9px; " type="submit" value="Save">';
						}
						else
						{	echo anchor('catalog/category/'.$ptr->idlev1,$ptr->lev1);  }
						?> 
						</div>
					</div>
					<div class="clear"></div>
					<?php
							$store = $ptr->lev1;
							$position++;
						}
							if($this->uri->segment(3) == $ptr->idlev1)
							{
								if(@$store2 != $ptr->lev2)
								{
					?>
					<div class="minitab-sub"  style="background:#fff; height:19px;">
						<div class='float col-40'> -*- </div>
						<div class='float col-120'><?php echo anchor('catalog/category/'.$ptr->idlev1.'/'.$ptr->idlev2,$ptr->lev2);  ?> </div>
					</div>
					<div class="clear"></div>
					<?php
									$store2 = $ptr->lev2;
								}
							}
							if($this->uri->segment(4) == $ptr->idlev2)
							{
					?>
					<div class="minitab-sub"  style="background:#fff; height:19px;">
						<div class='float col-40'> -*- </div>
						<div class='float col-120'><?php echo anchor('catalog/category/'.$ptr->idlev3,$ptr->lev3);  ?> </div>
					</div>
					<div class="clear"></div>
					<?php
							}
					}
					?>
					<div class="clear"></div>
					

					
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
