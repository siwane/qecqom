<?php

/**
 * (c) Moyon Camille <siwane@github.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Menu\Factory;

use App\Entity\MealByDay;
use App\Entity\Recipe;
use App\Menu\Entity\Menu;

class MenuFactory
{
    public const START_DATE = 'start-date';
    public const DAYS_BY_MENU = 'days-by-menu';

    public function build(array $parameters = []) : Menu
    {
        $start = $parameters[self::START_DATE] ?? new \DateTime();
        $numberOfDay = $parameters[self::DAYS_BY_MENU] ?? 7;

        $menu = new Menu();
        for ($day = 0 ; $day < $numberOfDay; $day++) {
            $current = clone $start;

            $recipes = $this->getRandomRecipe(2);

            $mealByDay = new MealByDay($current);
            $mealByDay->setNoon($recipes[0]);
            $mealByDay->setEvening($recipes[1]);

            $menu->addMealByDay($mealByDay);

            $start->modify('+1 day');
        }

        return $menu;
    }

    public function getRandomRecipe(int $count): array
    {
        $recipes = $this->getRecipes();
        $randomIndexes = array_rand($recipes, $count);

        if (!is_array($randomIndexes)) {
            $randomIndexes = [$randomIndexes];
        }
        $return = [];
        foreach ($randomIndexes as $index) {
            $return[] = $recipes[$index];
        }

        return $return;

        // ingredient
        // leger (tartine) ou repas
        // diff feculent / legumes / proteines
        // recette par groupe (oeufs)
        // par saison

        // allergenes
        // preferences (vegan)

        /** MENU */
    }

    /**
     * @return Recipe[]
     */
    protected function getRecipes() : array
    {
        $array = [
            ['name' => 'wok de crevettes'],
            ['name' => 'wok de légumes'],

            ['name' => 'pates bolognaise'],
            ['name' => 'pates carbonara'],
            ['name' => 'pates / crevettes / carottes'],

            ['name' => 'oeufs sur le plat'],
            ['name' => 'omelette'],

            ['name' => 'fishtick / patates sautées / haricot vert'],
            ['name' => 'poisson / riz / sauce hollandaise'],
            ['name' => 'poisson / patates / sauce beurre'],

            ['name' => 'tartines'],
            ['name' => 'tartines'],
            ['name' => 'tartines'],
            ['name' => 'tartines de la mer'],
            ['name' => 'tartines sucrée'],

            ['name' => 'lasagnes'],
            ['name' => 'hachie parmentier'],
            ['name' => 'fajitas'],
            ['name' => 'crêpes salées'],
            ['name' => 'steak frites'],
            ['name' => 'semoule saucisses'],
            ['name' => 'riz / boulettes / tomates'],
            ['name' => 'lasagne de légumes'],
            ['name' => 'risotto de poulet'],
            ['name' => 'boulettes / sauce tomate /tagliatelles'],
            ['name' => 'viandes / petits pois carottes'],
            ['name' => 'nugget / haricot blanc sauce tomates'],

            ['name' => 'poulet / frites'],

            ['name' => 'recette pour mettre à l\'honneur un légume' ],
            ['name' => 'recette pour mettre à l\'honneur une viande' ],
            ['name' => 'recette pour mettre à l\'honneur un poisson' ],

            ['name' => 'restaurant'],
            ['name' => 'repas de saison'],
        ];

        $recipes = [];
        foreach ($array as $value) {
            $recipes[] = (new Recipe())->setTitle($value['name']);
        }
        return $recipes;
    }
}