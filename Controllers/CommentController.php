<?php
namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\CommentModel;
use App\Core\Session;
use App\Core\Post;

class CommentController extends Controller
{
    public function showThisPostComment($identifiant)
    {
        $comments = new CommentModel;
        $user = new UserModel;
        $valeurs = $comments->findOrderBy('date', 'DESC');

        $pseudo = [];

        foreach($valeurs as $valeur){
            $pseudo[] = $user->findOneById('username', $valeur['idUser']);
        }
                
        $donnees = array ("valeurs" => $valeurs, "pseudo" => $pseudo, "id" => $identifiant);

        $this->render('blog/post', $donnees, 'post');
    }

    public function showComment(int $valid)
    {
        $comment = new CommentModel;
        $user = new UserModel;
        $infos = array("valid" => $valid);
        $valeurs = $comment->findBy($infos);

        $pseudo = [];

        foreach($valeurs as $valeur){
            $pseudo[] = $user->findOneById('username', $valeur['idUser']);
        }

        $result = array ("valeurs" => $valeurs, "pseudo" => $pseudo);

        return $result;
    }

    public function addComment($identifiant)
    {
        $comments = new CommentController;
        $comment = new CommentModel;

        if(Post::get('rgpd') !== null){
            if($comments->validate(Post::raw(), ['comments'])){
                
                $contenu = strip_tags(Post::get('comments'));
                $idUser = Session::get3d('user', 'idUser');
                $idPost = $identifiant;
                $role = json_decode(Session::get3d('user', 'role'));

                $comment->setContent($contenu);
                $comment->setIdUser($idUser);

                if(in_array('Administrateur', $role)){
                    $comment->setValid(1);
                }else{
                    $comment->setValid(0);
                }

                $comment->setRgpd(1);
                $comment->setIdPost($idPost);

                $comment->create();

                if(in_array('Administrateur', $role)){
                    Session::put('valide', "Votre commentaire a bien été publié."); 
                }else{
                    Session::put('valide', "Votre commentaire a bien été pris en compte, il est soumis à validation."); 
                }    
                header('Location: '. filter_input(INPUT_SERVER, 'HTTP_REFERER'));    
            }
        } elseif(Post::raw() !== null){
            Session::put('erreur', "Vous devez accepter les conditions pour pouvoir commenter.");
            header('Location: '. filter_input(INPUT_SERVER, 'HTTP_REFERER')); 
        }
    }

    public function validateComment()
    {
        $comment = new CommentModel;

        if(Post::get('oui') !== null){
            Session::put('idComment', Post::get('oui'));
            $comment->setValid(1);
            $comment->update();
            header('Refresh:0');
        } else if(Post::get('non') !== null){
            $identifiant = Post::get('non');
            $comment->delete($identifiant);
            header('Refresh:0');
        }
    }

    public function validate(array $donnees, array $champs)
    {
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                Session::put('erreur', "Le commentaire ne peut pas être vide.");
                return false;
            }
        }
        return true;
    }
}