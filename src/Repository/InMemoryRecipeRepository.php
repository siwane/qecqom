<?php


namespace App\Repository;


use App\Entity\Recipe;

class InMemoryRecipeRepository
{
    public function random(int $count)
    {
        $recipes = $this->getRecipes();
        return $recipes[array_rand($recipes)];
    }

    /**
     * @return Recipe[]
     */
    protected function getRecipes()
    {
        return [];
    }


}