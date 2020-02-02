<?php
/**
 * Created by PhpStorm.
 * User: siwane
 * Date: 01/09/18
 * Time: 22:05
 */

namespace App\Crawler;


class MarmitonSearch
{
    public function search(string $field)
    {
        $field = str_replace($field, ' ', '-');
        $url = sprintf('https://www.marmiton.org/recettes/recherche.aspx?type=all&aqt=%s', $field);

        $recipes = [];
        $search = fopen();
        $recipes = new SearchParser($search);
        return $recipes;

    }

    protected function parse()
    {

    }
}