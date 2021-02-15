<?php
namespace App\Models;

class CommentModel extends Model
{

    protected $idComment;
    protected $content;
    protected $date;
    protected $valid;
    protected $rgpd;
    protected $idUser;
    protected $idPost;

    public function __construct()
    {
        $this->table = 'comment';
    }

    public function findAllBy(string $donnee)
    {
        return $this->requete('SELECT '.$donnee.' FROM '.$this->table)->fetchAll();
    }

    public function findOneBy(string $donnee, string $valeur)
    {
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '.$donnee.' = ?', [$valeur])->fetch();
    }

    public function getIdComment()
    {
        return $this->idComment;
    }

    public function setIdComment($idComment)
    {
        $this->idComment = $idComment;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getValid()
    {
        return $this->valid;
    }

    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    public function getRgpd()
    {
        return $this->rgpd;
    }

    public function setRgpd($rgpd)
    {
        $this->rgpd = $rgpd;

        return $this;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdPost()
    {
        return $this->idPost;
    }

    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }
}