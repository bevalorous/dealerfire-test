<?php
require_once('protected/models/Comment.php');
require_once('base/Controller.php');

class CommentController extends Controller
{
    public function actionList()
    {
        $newComment = new Comment();        
        
        if (isset($_POST['Comment']))
        {
            $newComment->setAttributes($_POST['Comment']);
            $newComment->save();            
        }        
        
        $comment = new Comment();
        $comments = $comment->findAll();
        $this->render('list', array(
            'comments'=>$comments,
            'newComment'=>$newComment,
        ));
    }
}