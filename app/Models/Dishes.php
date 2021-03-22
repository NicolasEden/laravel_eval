<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dishes extends Model
{
    use HasFactory;
    private $prix;
    private $libelle;
    private $poids;
    private $dishes_origines;
    private $dishes_type_food;
    private $dishes_types;

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * @param mixed $poids
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    }

    /**
     * @return mixed
     */
    public function getDishesOrigines()
    {
        return $this->dishes_origines;
    }

    /**
     * @param mixed $dishes_origines
     */
    public function setDishesOrigines($dishes_origines)
    {
        $this->dishes_origines = $dishes_origines;
    }

    /**
     * @return mixed
     */
    public function getDishesTypeFood()
    {
        return $this->dishes_type_food;
    }

    /**
     * @param mixed $dishes_type_food
     */
    public function setDishesTypeFood($dishes_type_food)
    {
        $this->dishes_type_food = $dishes_type_food;
    }

    /**
     * @return mixed
     */
    public function getDishesTypes()
    {
        return $this->dishes_types;
    }

    /**
     * @param mixed $dishes_types
     */
    public function setDishesTypes($dishes_types)
    {
        $this->dishes_types = $dishes_types;
    }
}
