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
$commentController->actionList();
?>
<?php
$end = microtime_float();
?>
Page rendering time: <?php echo sprintf('%.6f', $end - $start); ?> sec