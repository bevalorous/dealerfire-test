<?php
$start = microtime();
require_once('protected/controllers/CommentController.php');
$commentController = new CommentController();
$commentController->actionList();
?>
<?php
$end = microtime();
?>
Page rendering time: <?php echo sprintf('%.6f', $end - $start); ?> sec