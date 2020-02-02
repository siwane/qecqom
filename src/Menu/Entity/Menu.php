<?php

/**
 * (c) Moyon Camille <siwane@github.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Menu\Entity;

use App\Entity\MealByDay;

class Menu
{
    /**
     * @var MealByDay[]
     */
    protected $mealByDays = [];

    public function addMealByDay(MealByDay $mealByDay): Menu
    {
        $this->mealByDays[] = $mealByDay;
        return $this;
    }

    /**
     * @return MealByDay[]
     */
    public function getMealByDays(): array
    {
        return $this->mealByDays;
    }

//    /**
//     * @param array $recipes
//     * @return Menu
//     */
//    public function setRecipes(\Iterator $recipes): Menu
//    {
//        if (count($recipes) % 2 == 0) {
//            throw new \InvalidArgumentException('Menu should contains a pair number of recipes');
//        }
//
//
//        $dayNumber = 0;
//
//        while ($recipes->valid()) {
//            $noon = $recipes->current();
//            $recipes->next();
//            $evening = $recipes->current();
//            $mealByDay = new MealByDay($noon, $evening);
//            $this->addMealByDay($mealByDay);
//            $recipes->next();
//            $dayNumber++;
//        }
//
//        $day = strtotime('+' . $dayNumber . ' day', $this->startDay->format('U'));
//        $dateString = $this->formatDate($day);
//        $menu[$dateString] = $submenu;
//
//        $menu = $submenu = [];
////        $mealType = ['Midi', 'Soir'];
//        $i = $dayNumber = 0;
//
//        $this->addRecipeByDay();
//
//        $i = 0;
//        $mealType = new MealByDay();
//        foreach ($recipes as $recipe) {
//            $i++;
//            $odd = $i % $this->numberByDay;
//            $submenu[$mealType[$odd]] = $recipe;
//            if ($odd == 1) {
//                $dayNumber++;
//                $day = strtotime('+' . $dayNumber . ' day', $this->startDay->format('U'));
//                $dateString = $this->formatDate($day);
//                $menu[$dateString] = $submenu;
//                $submenu = [];
//            }
//            $i++;
//        }
//        $this->recipes = $menu;
//        return $this;
//    }



}