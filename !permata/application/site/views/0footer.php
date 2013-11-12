<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>	
				
</div> <!-- end of #mybody -->

<div id="footer">
	<div class="body-wrapper">
		<div class="cb" style="height:80px;"></div>
		<div id="footer-menu">
			<?php
			
			if ($this->pix_page->view('bottom')) {
				$ctr = 0; $totalmenu = count($this->pix_page->view('bottom'));
				foreach ($this->pix_page->view('bottom') as $p) { $ctr++;
					if ($p->template == 'account')
					{
						if ($this->session->userdata('sess_account'))
							echo anchor($p->alias, strtoupper($p->title), array('class' => 'footer-menu-item'));
						else
							echo anchor('checkout/'.$p->alias, strtoupper($p->title), array('class' => 'footer-menu-item'));
					}
					else
						echo anchor($p->template == 'home' ? false : $p->alias, strtoupper($p->title), array('class' => 'footer-menu-item'));
				if($ctr != $totalmenu) { ?>
				 &middot;
				<?php } ?>
			
				<?php
				} // end of foreach
			} // end of if
			?>
		</div>
		<div id="footer-cpr"><?php echo lang('global_footercpr', '');?></div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){	
	
});
</script>

</body>
</html>
