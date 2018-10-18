<?php

namespace App\Controller\Admin;

use App\Entity\Director;
use App\Form\DirectorType;
use App\Repository\DirectorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/director")
 */
class DirectorController extends AbstractController
{
    /**
     * @Route("/", name="director_index", methods="GET")
     */
    public function index(DirectorRepository $directorRepository): Response
    {
        return $this->render('admin/director/index.html.twig', ['directors' => $directorRepository->findAll()]);
    }

    /**
     * @Route("/new", name="director_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $director = new Director();
        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($director);
            $em->flush();

            return $this->redirectToRoute('director_index');
        }

        return $this->render('admin/director/new.html.twig', [
            'director' => $director,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="director_show", methods="GET")
     */
    public function show(Director $director): Response
    {
        return $this->render('admin/director/show.html.twig', ['director' => $director]);
    }

    /**
     * @Route("/{id}/edit", name="director_edit", methods="GET|POST")
     */
    public function edit(Request $request, Director $director): Response
    {
        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('director_edit', ['id' => $director->getId()]);
        }

        return $this->render('admin/director/edit.html.twig', [
            'director' => $director,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="director_delete", methods="DELETE")
     */
    public function delete(Request $request, Director $director): Response
    {
        if ($this->isCsrfTokenValid('delete'.$director->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($director);
            $em->flush();
        }

        return $this->redirectToRoute('director_index');
    }
}
