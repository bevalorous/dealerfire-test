<!DOCTYPE html>
<html>
<head>	
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?php echo tr('Comment', 'List'); ?></title>
</head>
<body>	
    <div id="container">
		<div id="lang-switcher">			
			<?php if (!isset($_GET['lang'])) $_GET['lang'] = 'en'; ?>
			
			<?php if ($_GET['lang'] != 'en'): ?>
				<a href="?lang=en">English</a>
			<?php else: ?>
				<span class="current">English</span>
			<?php endif; ?>
			|
			<?php if ($_GET['lang'] != 'ru'): ?>
				<a href="?lang=ru">Русский</a>
			<?php else: ?>
				<span class="current">Русский</span>
			<?php endif; ?>
		</div>
        <?php if (isset($comments) && is_array($comments) && count($comments)): ?>
            <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="thumb-col">
                    <div class="thumb">
                        <div></div>
                    </div>
                </div>
                <div class="comment-col">
                    <p class="text"><?php echo $comment->getAttribute('content'); ?></p>
                    <p class="author"><?php echo $comment->getAttribute('author'); ?></p>
                    <?php $dt = strtotime($comment->getAttribute('createTime')); ?>
                    <p class="datetime"><?php echo date('d M Y', $dt).'&nbsp;@&nbsp;'.date('h:ia', $dt); ?></p>
                    <button class="reply-button"><?php echo tr('Comment', 'Reply'); ?></button>
                </div>            
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-comments"><?php echo tr('Comment', 'notFoundText'); ?></div>
        <?php endif; ?>
        
        <div class="form">
            <h1><?php echo tr('Comment', 'Add'); ?></h1>
            <form  action="" method="post">
                <div class="row">
                    <input type="text" name="Comment[author]" placeholder="<?php echo tr('Comment', 'author'); ?>" maxlength="100" value="<?php echo $newComment->getAttribute('author'); ?>">
                    <div class="error"><?php echo $newComment->getError('author'); ?></div>
                </div>
                <div class="row">
                    <input type="text" name="Comment[email]" placeholder="<?php echo tr('Comment', 'email'); ?>" maxlength="100" value="<?php echo $newComment->getAttribute('email'); ?>">
                    <div class="error"><?php echo $newComment->getError('email'); ?></div>
                </div>
                <div class="row">
                    <textarea name="Comment[content]" placeholder="<?php echo tr('Comment', 'content'); ?>"><?php echo $newComment->getAttribute('content'); ?></textarea>
                    <div class="error"><?php echo $newComment->getError('content'); ?></div>
                </div>
                <button type="submit" class="reply-button"><?php echo tr('Comment', 'Add'); ?></button> <a href="#"><?php echo tr('Comment', 'Cancel'); ?></a>
            </form>
        </div>
        
        <div class="add-comment-form">
            <button class="reply-button"><?php echo tr('Comment', 'Add'); ?></button>
        </div>
	</div>
</body>
</html>