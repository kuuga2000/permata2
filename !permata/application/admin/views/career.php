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
		<li class='nav-tombol newseven'><?php echo anchor('site/data','NEWS & EVENT')?></li>
		<li class='nav-tombol-active career'><?php echo anchor('career','CAREER')?></li>
		<li class='nav-tombol contactus'><?php echo anchor('contact','CONTACT US')?></li>
	</ul>
	</div>
	<?php if ($company_banner){ ?>
	<div class='hd-title'>
	<img src="<?php echo base_url()?>asset/upload/<?php echo $company_banner->img ?>" width='765' height='230'>
	</div>
	<?php } ?>
	<br>
	<br>
	<br>
	<div class='bg-career'>
		<div class='contact'>
		<h4>CONTACT</h4>
		<h5><?php echo $company_info->c_name ?></h5>
		<p><?php echo $company_info->c_address ?><br>
		<?php echo $company_info->c_web ?></p>
		<br>
		<p>T : <?php echo $company_info->c_phone ?><br>
		F : <?php echo $company_info->c_fax ?></p>
		</div>
		
		<article class='bg-contact'>
		<h4>SEND YOUR MAIL</h4>
		<?php echo $company_info->career_info ?>
		</article>
	</div>
