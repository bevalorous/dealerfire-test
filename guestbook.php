<?php
?>
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
        <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="comment">
            <div class="thumb-col">
                <div class="thumb">
                    <div></div>
                </div>
            </div>
            <div class="comment-col">
                <p class="text">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
                <p class="author">Orman Clark</p>
                <p class="datetime">14 Mar 2011 @ 11:07am</p>
                <button class="reply-button">Reply</button>
            </div>            
        </div>
        <?php endfor; ?>
        <div class="add-comment-form">
            <button class="reply-button">Add comment</button>
        </div>
	</div>
</body>
</html>