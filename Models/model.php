<?php
namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    protected $table;

    private $db;


    public function findAll()
    {
        $query = $this->query('SELECT * FROM'.$this->table);
        return $query->fetchAll();
    }

    public function query(string $sql, array $attributs = null)
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
}