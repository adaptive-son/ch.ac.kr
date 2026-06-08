<? include "../_common.php" ?>

<?php
$_SESSION['sel_site_id'] = $_POST['selSiteId'];
redirect("/adframe/mng/index.php");
?>
