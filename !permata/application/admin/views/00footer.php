<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
		<script>
		$(document).ready(function(){  
			$('.deleteform a').bind('click',function(e){
				var commit = confirm('Record will be deleted! This operation can\'t be undone. \nAre you sure?');
				if ( ! commit)
					return false;
			});
		});
		</script>
<div class="footer">
	<div class="footerspan"><span>Developed By <?php echo anchor($developer_url,$developer); ?></span></div>
</div>
</body>
</html>