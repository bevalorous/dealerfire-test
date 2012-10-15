<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?php echo tr('Comment', 'List'); ?></title>
	<script type="text/javascript" src="js/functions.js"></script>
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

		<?php $this->renderPartial('_form', array('newComment'=>$newComment)); ?>

        <div id="add-comment-main-button" class="add-comment-form" style="display: none">
            <button class="reply-button" onclick="show(findById('add-comment-form')); show(findById('cancel-comment')); hide(findById('add-comment-main-button'));"><?php echo tr('Comment', 'Add'); ?></button>
        </div>

	</div>
	<script type="text/javascript">
		<?php if (!$newComment->hasErrors()): ?>
		hide(findById('add-comment-form'));
		show(findById('add-comment-main-button'));
		<?php endif; ?>
		findById('add-comment-form').onsubmit = function(){
			ajaxRequest.open('POST', 'guestbook.php?lang=<?php echo (isset($_GET['lang'])? $_GET['lang']: 'en'); ?>&action=add', true);
			ajaxRequest.onreadystatechange = function() {
				if (ajaxRequest.readyState == 4) {
					if (ajaxRequest.status == 200) {		                
						setHtml(findById('Comment_author_em'), '');
						setHtml(findById('Comment_email_em'), '');
						setHtml(findById('Comment_content_em'), '');
						
						var data = eval('(' + ajaxRequest.responseText + ')');
						if (data.errorCount > 0) {
							for (var key in data.errors) {
								findById('Comment_' + key + '_em').innerHTML = data.errors[key];
							}
						}
						else
							document.location.href = 'guestbook.php?lang=<?php echo (isset($_GET['lang'])? $_GET['lang']: 'en'); ?>&action=list';
		            }
					else {
						alert("Server error: " + ajaxRequest.responseText);
					}
				}
				return false;
			}

			ajaxRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			var params = 'Comment[author]=' + encodeURIComponent(findById('Comment_author').value) + '&Comment[email]=' + encodeURIComponent(findById('Comment_email').value) + '&Comment[content]=' + encodeURIComponent(findById('Comment_content').value);
			ajaxRequest.send(params);
			return false;
		}
	</script>
</body>
</html>