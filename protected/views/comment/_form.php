<div class="form" id="add-comment-form">
	<h1><?php echo tr('Comment', 'Add'); ?></h1>
	<form action="" method="post">
		<div class="row">
			<input type="text" id="Comment_author" name="Comment[author]" placeholder="<?php echo tr('Comment', 'author'); ?>" maxlength="100" value="<?php echo $newComment->getAttribute('author'); ?>">
			<div class="error" id="Comment_author_em"><?php echo $newComment->getError('author'); ?></div>
		</div>
		<div class="row">
			<input type="text" id="Comment_email" name="Comment[email]" placeholder="<?php echo tr('Comment', 'email'); ?>" maxlength="100" value="<?php echo $newComment->getAttribute('email'); ?>">
			<div class="error" id="Comment_email_em"><?php echo $newComment->getError('email'); ?></div>
		</div>
		<div class="row">
			<textarea id="Comment_content" name="Comment[content]" placeholder="<?php echo tr('Comment', 'content'); ?>"><?php echo $newComment->getAttribute('content'); ?></textarea>
			<div class="error" id="Comment_content_em"><?php echo $newComment->getError('content'); ?></div>
		</div>
		<button type="submit" class="reply-button" id="add-comment-button"><?php echo tr('Comment', 'Add'); ?></button>
		<a href="#" id="cancel-comment" style="display: none;" onclick="hide(findById('add-comment-form')); show(findById('add-comment-main-button')); hide(this); return false;"><?php echo tr('Comment', 'Cancel'); ?></a>
	</form>
</div>