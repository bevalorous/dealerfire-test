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
			$newComment->setAttribute('createTime', date('Y-m-d H:i:s'));
            if ($newComment->save())
			{
				$newComment->unsetAttributes();
			}
        }        
        
        $comment = new Comment();
        $comments = $comment->findAll('1 = 1', 'createTime DESC');
        $this->render('list', array(
            'comments'=>$comments,
            'newComment'=>$newComment,
        ));
    }
	
	public function actionAdd()
	{
		$newComment = new Comment();
        
        if (isset($_POST['Comment']))
        {
            $newComment->setAttributes($_POST['Comment']);
			$newComment->setAttribute('createTime', date('Y-m-d H:i:s'));
            if ($newComment->save())
			{
				$newComment->unsetAttributes();
			}
        }
		$errors = $newComment->getErrors();
		echo json_encode(array('attributes'=>$newComment->getAttributes(), 'errors'=>$errors, 'errorCount'=>count($errors)));
	}
}