<?php
namespace App\Models;

class UserModel extends Model
{

    protected $idUser;
    protected $username;
    protected $password;
    protected $name;
    protected $surname;
    protected $email;
    protected $role;
    protected $rgpd;
    protected $date;

    public function __construct()
    {
        $this->table = 'user';
    }

    public function setSession()
    {
        $_SESSION['user'] = [
            'idUser' => $this->idUser,
            'username' => $this->username,
            'password' => $this->password,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'role' => $this->role,
            'rgpd' => $this->rgpd,
            'date' => $this->date
        ];
    }

    public function findAllBy(string $donnee)
    {
        return $this->requete('SELECT '.$donnee.' FROM '.$this->table)->fetchAll();
    }

    public function findOneBy(string $donnee, string $valeur)
    {
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '.$donnee.' = ?', [$valeur])->fetch();
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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;

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

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}