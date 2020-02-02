<?php

/**
 * (c) Moyon Camille <siwane@github.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Menu\Service;

use App\Entity\Recipe;
use App\Menu\Entity\Menu;
use App\Menu\Factory\MenuFactory;
use Exception;

class MenuService
{
    /**
     * @var MenuFactory
     */
    private $factory;

    /**
     * MenuService constructor.
     * @param MenuFactory $factory
     */
    public function __construct(MenuFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return Recipe[]
     * @throws Exception
     */
    public function createMenu()
    {
        $parameters = [
            MenuFactory::DAYS_BY_MENU => 7
        ];

        return $this->formatMenu($this->factory->build($parameters));
    }

    protected function formatMenu(Menu $menu)
    {
        $formattedMeals = [];
        foreach ($menu->getMealByDays() as $mealByDay) {
            $formattedMeals[$mealByDay->getFormattedDatetime()] = $mealByDay;
        }
        return $formattedMeals;
    }
}