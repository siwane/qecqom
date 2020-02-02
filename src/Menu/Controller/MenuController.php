<?php

/**
 * (c) Moyon Camille <siwane@github.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Menu\Controller;

use App\Menu\Service\MenuService;
use App\Service\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * @Route("/api/menu/generate", name="getMenu")
     *
     * @param MenuService $menuService
     * @return JsonResponse
     * @throws \Exception
     */
    public function generate(MenuService $menuService)
    {
        return new JsonResponse($menuService->createMenu());
    }

    /**
     * @Route("/api/search", name="search")
     *
     * @param SearchService $searchService
     * @param Request $request
     * @return JsonResponse
     */
    public function search(SearchService $searchService, Request $request)
    {
        $field = $request->get('search');
        return new JsonResponse($searchService->search($field));
    }

    /**
     * @Route("/api/menu/random", name="getRandomRecipe")
     *
     * @param MenuService $menuService
     * @return JsonResponse
     */
    public function random(MenuService $menuService)
    {
        return new JsonResponse($menuService->getRandomRecipe(1)[0]);
    }
}