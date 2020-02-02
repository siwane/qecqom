<?php

/**
 * (c) Moyon Camille <siwane@github.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Home\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/{route}",
     *     name="home",
     *     defaults={"route": null},
     *     requirements={"route": "^(?!_wdt|_profiler|api).*$"}
     * )
     *
     * @return Response
     */
    public function home()
    {
        return $this->render("base.html.twig");
    }
}