<?php

namespace App\Service;

use App\Entity\Search;
use App\Entity\SearchRecipe;
use Doctrine\ORM\EntityManager;

class SearchService
{
    const CACHE_PREFIX = 'search_field_';

    /** @var string  */
    protected $dataFolder;

    /** @var EntityManager */
    protected $em;

    /** @var Search */
    protected $search;

    public function __construct($rootDir, EntityManager $em)
    {
        $this->dataFolder = realpath($rootDir . '/../data');
        $this->em = $em;
    }

    protected function getSearchRecipeRepository()
    {
        return $this->em->getRepository(SearchRecipe::class);
    }

    public function search(string $field=null)
    {
        if (is_null($field)) {
            return [];
        }

        $searchRepository = $this->em->getRepository(Search::class);

        $field = $this->format($field);
        $search = $searchRepository->findOneBy(['search' => $field]);

        if (is_null($search)) {
            $this->search = new Search();
            $this->search->setSearch($field);
            $this->doSearch($field);
            $this->em->persist($this->search);
            $this->em->flush();
            $search = $this->search;
        }

        return $search->getRecipes()->toArray();
    }

    protected function doSearch($field)
    {
        $url = sprintf('https://www.marmiton.org/recettes/recherche.aspx?type=all&aqt=%s', $field);
        $resource = fopen($url, 'r');
        $dest = fopen($this->getSearchFile(), 'w');
        stream_copy_to_stream($resource, $dest);
        fclose($resource);
        fclose($dest);
        $html = file_get_contents($this->getSearchFile());
        $this->parse($html);
    }

    protected function format(string $field)
    {
        return str_replace(' ', '-', $field);
    }

    protected function getCacheKey(string $string): string
    {
        return preg_replace('/[^a-zA-Z0-9-\']/', '', $string);
    }

    protected function parse($html)
    {
        preg_match_all("'<a  class=\"recipe-card-link\" href=\"(.*?)\">'si", $html, $cards);
        preg_match_all("'<h4 class=\"recipe-card__title\">(.*?)</h4>'si", $html, $titles);
        preg_match_all("'<div class=\"recipe-card__description\">(.*?)</div>'si", $html, $descriptions);

        preg_match_all("'<p class=\"recipe-card__subtitle\">(.*?)</p>'si", $html, $types);
        preg_match_all("'<span class=\"recipe-card__rating__value\">(.*?)</span>'si", $html, $notes);

        $numberOfMatch = count($cards[0]);

        $h = 199;
        for ($i=0; $i<$numberOfMatch; $i++) {
            $recipe = new SearchRecipe();
            $recipe->setTitle($titles[1][$i]);
            $recipe->setDescription(trim($descriptions[1][$i]));
            if (isset($types[1][$i])) {
                $recipe->setType($types[1][$i]);
            }
            if (isset($notes[1][$i])) {
                $recipe->setNote($notes[1][$i]);
            }
            $recipe->setLink($cards[1][$i]);
            $recipe->setImage('http://p-hold.com/food/300/' . $h++);

            $this->em->persist($recipe);
            $this->search->addRecipe($recipe);
        }
    }

    protected function getSearchFile()
    {
        return $this->dataFolder . '/test.html';
    }
}