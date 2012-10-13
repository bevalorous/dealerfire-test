<!DOCTYPE html>
<html>
<head>	
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Comment list</title>
</head>
<body>	
    <div id="container">
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
                    <button class="reply-button">Reply</button>
                </div>            
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-comments">No comments.</div>
        <?php endif; ?>
        
        <div class="form">
            <h1>Add comment</h1>
            <form  action="" method="post">
                <div class="row">
                    <input type="text" name="Comment[author]" placeholder="Name" maxlength="100" value="<?php echo $newComment->getAttribute('author'); ?>">
                    <div class="error"><?php echo $newComment->getError('author'); ?></div>
                </div>
                <div class="row">
                    <input type="text" name="Comment[email]" placeholder="Email" maxlength="100" value="<?php echo $newComment->getAttribute('email'); ?>">
                    <div class="error"><?php echo $newComment->getError('email'); ?></div>
                </div>
                <div class="row">
                    <textarea name="Comment[content]" placeholder="Your comment"><?php echo $newComment->getAttribute('content'); ?></textarea>
                    <div class="error"><?php echo $newComment->getError('content'); ?></div>
                </div>
                <button class="reply-button">Add comment</button> <a href="#">Cancel</a>
            </form>
        </div>
        
        <div class="add-comment-form">
            <button class="reply-button">Add comment</button>
        </div>
	</div>
</body>
</html>