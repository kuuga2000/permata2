	<div class='navigasi'>
	<ul>
		<li class='nav-active awal'><?php echo anchor(base_url(),"<img src='".base_url()."asset/img/bg/homebutton.png'>") ?></li>
		<li class='nav-tombol company'><?php echo anchor('company','COMPANY PROFILE')?></li>
		<li class='nav-tombol facility dropdown'><a class="dropdown-toggle" href="#">DESIGN ARTICLE & FACILITY </a>
			<ul class="dropdown-menu">
			<li class='mw240'><?php echo anchor('site/facility_list/','DESIGN ARTICLE')?></li>
			<li><?php echo anchor('site/process/','FACILITY')?></li>
		  </ul>
		</li>
		<li class='nav-tombol newseven'><?php echo anchor('site/data','NEWS & EVENT')?></li>
		<li class='nav-tombol career'><?php echo anchor('career','CAREER')?></li>
		<li class='nav-tombol contactus'><?php echo anchor('contact','CONTACT US')?></li>
	</ul>
	</div>
	<div id='carousel'>		
<div id="carousel-screenshots" class="carousel slide">
		  <div class="carousel-inner ext-inner-766">
<?php
	$active = 'active';
foreach ($web_carousel as $carousels):
?>
				<div class="item <?php echo $active; $active = ''; ?>">
					<img src="<?php echo base_url()?>asset/upload/<?php echo $carousels->img ?>" width='766' height='310' style="width:766px; height:310px;">
				</div>
<?php
endforeach;
?>	
		  </div>
		</div>
				<div class="carousel-nav">
	<?php
	$actived = 'class="active"';
	$i = 0;
	foreach ($web_carousel as $carosel)
	{
	?>
				<a href="#" data-to="<?php echo $i; ?>" <?php echo $actived; $actived = ''; ?> >&nbsp </a>
	<?php
		$i++;
	}
	?>
				<div style="clear:both"></div>
				</div>
	</div>
	<div>
	<div id='event'>
	
	<aside class='news newscat'>
		<div class='news-cat'>
			<div class='news-cat-logo'>NEWS & EVENT</div>
		</div>
		<div class='news-column'>
<?php
foreach ($news_event as $news):
$dotted = '';
$content_news = substr($news->content, 0,85);
if(strlen($news->content) > 85)
{
	$dotted = " ... ".anchor('site/view/'.$news->idnews.'/'.$news->idnews_cat.'/'.$news->title,'See More');
}
?>
			<div class='news-content' style="font-family:arial; font-size:11px;">
			<span><?php echo anchor('site/view/'.$news->idnews.'/'.$news->idnews_cat.'/'.$news->title,date ("d F Y",strtotime($news->date)))?></span>
			<p><?php echo $content_news,$dotted; ?></p>
			</div>
<?php
endforeach;
?>			
		</div>
		
		<div class='news-column seemore'>
		<?php echo anchor('site/data','See More')?>
		</div>
		<div style="clear:both"></div>
	</aside>
	
	<aside class='news news-achievt''>
		<div class='news-cat'>
			<div class='news-cat-achiev'>ACHIEVEMENT</div>
		</div>
		<div class='news-column'>
			<div class='news-achievement'>		
			<div id="myCarousel" class="carousel slide">
			  <div class="carousel-inner ext-inner-366">
			  
				<?php
					$active = 'active';
				foreach ($web_caro_acv as $acv_carousel):
				?>
					<div class="item <?php echo $active; $active = ''; ?>"  style="height:180px">
						<img src="<?php echo base_url()?>asset/upload/<?php echo $acv_carousel->img ?>" style="height:122px" >
						<br>
						<div><?php echo $acv_carousel->img_capt ?></div>
					</div>
				<?php
				endforeach;
				?>	
			  </div>
			  <a style='color:#333;' class="carousel-control control-left left" href="#myCarousel" data-slide="prev"><span></span></a>
			  <a style='color:#333;' class="carousel-control control-right right" href="#myCarousel" data-slide="next"></a>
			</div>
			</div>
		</div>
	</aside>
	
	</div>

	<div class='side-bar'>
		<div id='side-content'>
			<div class='side-content-title'>COMPANY PROFILE</div>		
		</div>
		<div class='side-content'>
	
			<?php if ($home_banner){ ?>
			<img src="<?php echo base_url()?>asset/upload/<?php echo $home_banner->img ?>" width='475' height='194' style="width:475px;">
			<?php } ?>
			<p>
			<?php if ($company_profile){ 
			$dotted = '';
			$company_content = substr($company_profile->content, 0,600);
			if(strlen($company_profile->content) > 600)
			{
				$dotted = " ... ".anchor('company','See More');
			}
			?>
			
			<h1><?php echo $company_profile->title ?></h1>
			<?php echo $company_content,$dotted; ?>
			<?php } ?>
			</p>
		</div>
	</div>
		<div style="clear:both"></div>
	</div>
		<div style="clear:both"></div>