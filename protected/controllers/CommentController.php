<?php
require_once('protected/models/Comment.php');

class CommentController
{
    public function actionList()
    {
        $newComment = new Comment();
        
        if (isset($_POST['Comment']))
        {
        
        }
        
        $comments = Comment::findAll();
        $this->render('list', array(
            'comments'=>$comments,
            'newComment'=>$newComment,
        ));
    }
    
    public function render($view, $data)
    {
        // Initialize view data as variables
        foreach ($data as $name => $value)
        {
            $$name = $value;
        }
        require('protected/views/comment/'.$view.'.php');
        echo 'View file: '.$view.'<br>';
        echo 'Data for view: '.'<br>';
        echo '<pre>';
        echo print_r($data);
        echo '</pre>';
    }
}