	<div class='navigasi'>
	<ul>
		<li class='nav-awal awal'><?php echo anchor(base_url(),"<img src='".base_url()."asset/img/bg/homebutton2.png'>") ?></li>
		<li class='nav-tombol company'><?php echo anchor('company','COMPANY PROFILE')?></li>
		<li class='nav-tombol facility dropdown'><a class="dropdown-toggle" href="#">DESIGN ARTICLE & FACILITY</a>
			<ul class="dropdown-menu">
			<li class='mw240'><?php echo anchor('site/facility_list/','DESIGN ARTICLE')?></li>
			<li><?php echo anchor('site/process/','FACILITY')?></li>
		  </ul>
		</li>
		<li class='nav-tombol-active newseven'><?php echo anchor('site/data','NEWS & EVENT')?></li>
		<li class='nav-tombol career'><?php echo anchor('career','CAREER')?></li>
		<li class='nav-tombol contactus'><?php echo anchor('contact','CONTACT US')?></li>
	</ul>
	</div>
	
	<div class='bg-news-tab' >
		<nav>
		<ul>
		<?php
		foreach ($_detail_mirror as $detail_mirror){
			$id=$detail_mirror->idnews;
			$cat=$detail_mirror->idnews_cat;
		}
		?>
			<li><?php echo anchor('site/view/'.$id.'/'.$cat.'/'.$title,'OTHER NEWS')?></li>
			<li class='tab-active' style=''><span>OTHER EVENT</span></li>
		</ul>
		</nav>
		<br>
		<aside>
		<div class='bg-news-tlist'>
		<?php 
		foreach ($_detail_news as $detail_news):
		$dotted = '';
		$content_news = substr($detail_news->content, 0,85);
		if(strlen($detail_news->content) > 85)
		{ $dotted = " ... "; }
		?>
			<p class='view-more'><h4><?php echo anchor('site/view/'.$detail_news->idnews.'/'.$detail_news->idnews_cat.'/'.$detail_news->title,date ("d F Y",strtotime($detail_news->date)))?></h4><br>
			<?php echo $content_news,$dotted; ?>
			</p>
			<hr>
		<?php
		endforeach;
		?>		
			<p class='view-more'><?php echo anchor('site/data/'.$detail_news->idnews_cat.'/'.$detail_news->cat_name,'See More')?></a></P>
		</div>
		</aside>
	</div>
	<div style="clear:both"></div>
	<?php if ($_news){ ?>
	<div class='bg-news' style="min-height:500px;">
	<hgroup>
	<h4><?php echo $_news->title ?></h4>
	<h5><?php echo date ("d F Y",strtotime($_news->date)) ?> | Category : <?php echo $_news->cat_name ?></h5>
	</hgroup>
	<?php if($_news->img) { ?>
	<img src="<?php echo base_url()?>asset/upload/<?php echo $_news->img ?>" width='500' height='282' style="width:500px;" title='<?php echo $_news->title ?>'>
	<?php } ?>
	<p style='text-align:justify; text-justify:inter-word;'>
	<?php echo $_news->content ?>

	</p>
	</div>
	<?php } ?>
	<div style="clear:both"></div>
	<br>