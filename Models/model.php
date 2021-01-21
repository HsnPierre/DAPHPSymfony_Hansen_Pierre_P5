<?php
namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    protected $table;

    private $datab;

    public function findAll()
    {
        return $this->requete('SELECT * FROM '.$this->table)->fetchAll();
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

        return $this->requete('SELECT * FROM '.$this->table.' WHERE '.$liste_champs, $valeurs)->fetchAll();
    }
    
    public function findOrderBy(string $critere, string $order)
    {
        return $this->requete('SELECT * FROM '.$this->table.' ORDER BY '.$critere.' '.$order)->fetchAll();
    }

    public function find(int $id)
    {
        return $this->requete('SELECT * FROM '.$this->table.' WHERE id'.ucfirst($this->table).' = '.$id)->fetch();
    }

    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        foreach($this as $champ => $valeur){

            if($valeur !== null && $champ != 'datab' && $champ != 'table'){
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        return $this->requete('INSERT INTO '.$this->table.' ('.$liste_champs.')VALUES('.$liste_inter.')', $valeurs);
    }

    public function update()
    {
        $champs = [];
        $valeurs = [];

        foreach($this as $champ => $valeur){
            if($valeur !== null && $champ != 'datab' && $champ != 'table'){
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        
        $nomId = 'id'.ucfirst($this->table);

        $id = $_SESSION["$nomId"];

        $valeurs[] = $id;

        $liste_champs = implode(', ', $champs);

        return $this->requete('UPDATE '.$this->table.' SET '.$liste_champs.' WHERE id'.ucfirst($this->table).' = ?', $valeurs);
    }

    public function delete(int $id)
    {
        return $this->requete('DELETE FROM '.$this->table.' WHERE id'.ucfirst($this->table).' = ?', [$id]);
    }

    public function requete(string $sql, array $attributs = null)
    {
        $this->datab = Db::getInstance();
        
        if($attributs !== null){
                $query = $this->datab->prepare($sql);
                $query->execute($attributs);
                return $query;
        }else{
            return $this->datab->query($sql);
        }

    }

    public function hydrate($donnees)
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