<div class="content-wrapper">
	<?php
	$pg = isset($_GET['pg']) ? $_GET['pg'] : "";

	if($pg == "dashboard" OR $pg == ""){
		require_once "view/dashboard.php";
	}else{
		require_once "view/".$pg.".php";
	}
	?>
</div>