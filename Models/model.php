<?php
namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    protected $table;

    private $db;


    public function findAll()
    {
        return $this->requete('SELECT * FROM'.$this->table)->fetchAll();
    }

    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        foreach($criteres as $champ => $valeur){
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        $liste_champs = implode(' AND ', $champs);

        return $this->requete('SELECT * FROM '.$this->table.' WHERE '.$liste_champs,$valeurs)->fetchAll();
    }

    public function find(int $id)
    {
        return $this->requete('SELECT * FROM'.$this->table.' WHERE id = '.$id)->fetch();
    }

    public function create(Model $model)
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        foreach($model as $champ => $valeur){

            if($valeur !== null && $champ != 'db' && $champ != 'table'){
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        return $this->requete('INSERT INTO'.$this->table.' ('.$liste_champs.')VALUES('.$liste_inter.')',$valeurs);
    }

    public function update(int $id, Model $model)
    {
        $champs = [];
        $valeurs = [];

        foreach($model as $champ => $valeur){
            if($valeur !== null && $champ != 'db' && $champ != 'table'){
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;

        $liste_champs = implode(', ', $champs);

        return $this->requete('UPDATE '.$this->table.' SET '.$liste_champs.' WHERE id = ?', $valeurs);
    }

    public function delete(int $id)
    {
        return $this->requete('DELETE FROM '.$this->table.' WHERE id = ?', [$id]);
    }

    public function requete(string $sql, array $attributs = null)
    {
        $this->db = Db::getInstance();

        if($attributs !== null){
                $query = $this->db->prepare($sql);
                $query->execute($attributs);
                return $query;
        }else{
            return $this->db->query($sql);
        }

    }

    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value){
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
        return $this;
    }
}