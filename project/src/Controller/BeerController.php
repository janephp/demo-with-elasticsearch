<?php

namespace App\Controller;

use JoliCode\Elastically\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BeerController extends AbstractController
{
    const BEERS_INDEX = 'beers';

    /**
     * @Route("/beers", name="beers")
     */
    public function index(Client $client)
    {
        $resultSet = $client->getIndex(self::BEERS_INDEX)->search();
        $results = $resultSet->getResults();

        $output = ['beers' => []];
        foreach ($results as $result) {
            $output['beers'][] = $result->getModel();
        }

        return $this->json($output);
    }
}
