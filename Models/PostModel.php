<?php
namespace App\Models;

class PostModel extends Model
{

    protected $idPost;
    protected $content;
    protected $date;
    protected $dateEdit;
    protected $title;
    protected $description;
    protected $editor;
    protected $idUser;

    public function __construct()
    {
        $this->table = 'post';
    }

    public function findAllBy(string $donnee)
    {
        return $this->requete('SELECT '.$donnee.' FROM '.$this->table)->fetchAll();
    }

    public function findOneBy(string $donnee, string $valeur)
    {
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '.$donnee.' = ?', [$valeur])->fetch();
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

    public function getDateEdit()
    {
        return $this->dateEdit;
    }

    public function setDateEdit($dateEdit)
    {
        $this->dateEdit = $dateEdit;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getEditor()
    {
        return $this->editor;
    }

    public function setEditor($editor)
    {
        $this->editor = $editor;

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

}