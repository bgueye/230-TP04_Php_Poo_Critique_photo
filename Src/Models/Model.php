<?php

namespace App\Src\Models;

use App\Src\Core\DbAccess;

abstract class Model extends DbAccess
{
    // Table de la base de données
    protected $table;

    // Instance de DbAccess
    private $db;
    
    
    public function requete(string $sql, array $attributs = null)
    {
        // On récupère l'instance de Db
        $this->db = DbAccess::getInstance();

        // On vérifie si on a des attributs
        if ($attributs !== null) {
            
            // Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            
            // Requête simple
            return $this->db->query($sql);
        }
    }

    
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }


    public function findByLogin(string $login)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE login = ?", [$login])->fetch();
    }
    

    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = ?", [$id])->fetch();
    }
    
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id])->fetch();
    }

    public function hydrate($donnees)
    {

    }

    abstract public function create();
    
    

}