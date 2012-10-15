<?php
require_once('base/helpers.php');
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$start = microtime_float();
require_once('protected/controllers/CommentController.php');
$commentController = new CommentController();
if (isset($_POST['action']))
	$action = $_POST['action'];
elseif (isset($_GET['action']))
	$action = $_GET['action'];
else $action = 'list';
$action = 'action'.ucfirst(strtolower($action));

$commentController->$action();
?>
<?php
$end = microtime_float();
?>
<?php //Page rendering time: <?php echo sprintf('%.6f', $end - $start).' sec'; ?>