<?php
namespace App\Controllers;

use App\Controllers\MainController;
use App\Controllers\BlogController;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\CommentModel;

class CommentController extends Controller
{
    public function showThisPostComment($id)
    {
        $comments = new CommentModel;
        $user = new UserModel;
        $valeurs = $comments->findOrderBy('date', 'DESC');
                
        $donnees = array ("valeurs" => $valeurs, "user" => $user, "id" => $id);

        $this->render('blog/post', $donnees, 'post');
    }

    public function showComment(int $valid)
    {
        $comment = new CommentModel;
        $user = new UserModel;
        $infos = array("valid" => $valid);
        $valeurs = $comment->findBy($infos);

        $result = array ("valeurs" => $valeurs, "user" => $user);

        return $result;
    }

    public function addComment($id)
    {
        $comments = new CommentController;
        $comment = new CommentModel;

        if(isset($_POST['rgpd'])){
            if($comments->validate($_POST, ['comments'])){
                
                $contenu = strip_tags($_POST['comments']);
                $idUser = $_SESSION['user']['idUser'];
                $idPost = $id;

                $comment->setContent($contenu);
                $comment->setIdUser($idUser);

                if(stristr($_SESSION['user']['role'], "Administrateur")){
                    $comment->setValid(1);
                }else{
                    $comment->setValid(0);
                }

                $comment->setRgpd(1);
                $comment->setIdPost($idPost);

                $comment->create();

                if(stristr($_SESSION['user']['role'], "Administrateur")){
                    $_SESSION['valide'] = 'Votre commentaire a bien été publié.'; 
                }else{
                    $_SESSION['valide'] = 'Votre commentaire a bien été pris en compte, il est soumis à validation.'; 
                }    
                header('Location: '. $_SERVER['HTTP_REFERER']);    
            }
        } elseif(isset($_POST)){
            $_SESSION['erreur'] = "Vous devez accepter les conditions pour pouvoir commenter.";
            header('Location: '. $_SERVER['HTTP_REFERER']); 
        }
    }

    public function validateComment()
    {
        $comment = new CommentModel;

        if(isset($_POST['oui'])){
            $_SESSION['idComment'] = $_POST['oui'];
            $comment->setValid(1);
            $comment->update();
            header('Location :'.$_SERVER['HTTP_REFERER']);
        } else if(isset($_POST['non'])){
            $id = $_POST['non'];
            $comment->delete($id);
            header('Refresh:0');
        }
    }

    public function validate(array $donnees, array $champs)
    {
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                $_SESSION['erreur'] = "Le commentaire ne peut pas être vide.";
                return false;
            }
        }
        return true;
    }
}