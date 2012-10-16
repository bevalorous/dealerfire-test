<?php
if (file_exists('protected/config/main.php'))
	header('Location: /guestbook.php');
else
	header('Location: /config.php');