<?php

namespace App\Src\Models;

use App\Src\Core\DbAccess;

class Model extends DbAccess
{
    // Table de la base de données
    protected $table;

    // Instance de Db
    private $db;


    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    

    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }
    
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

}