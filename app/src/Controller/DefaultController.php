<?php

namespace App\Controller;

use App\Repository\SearchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request, SearchRepository $searchRepository)
    {
        $results = $searchRepository->search($request->get('term'));

        return $this->render('default/search.html.twig', [
            'search_term' => $request->get('term'),
            'results' => $results,
        ]);
    }
}
