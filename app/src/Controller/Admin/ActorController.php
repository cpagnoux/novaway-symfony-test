<?php

namespace App\Controller\Admin;

use App\Entity\Actor;
use App\Form\ActorType;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/actor")
 */
class ActorController extends AbstractController
{
    /**
     * @Route("/", name="actor_index", methods="GET")
     */
    public function index(ActorRepository $actorRepository): Response
    {
        return $this->render('admin/actor/index.html.twig', ['actors' => $actorRepository->findAll()]);
    }

    /**
     * @Route("/new", name="actor_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $actor = new Actor();
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actor);
            $em->flush();

            return $this->redirectToRoute('actor_index');
        }

        return $this->render('admin/actor/new.html.twig', [
            'actor' => $actor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actor_show", methods="GET")
     */
    public function show(Actor $actor): Response
    {
        return $this->render('admin/actor/show.html.twig', ['actor' => $actor]);
    }

    /**
     * @Route("/{id}/edit", name="actor_edit", methods="GET|POST")
     */
    public function edit(Request $request, Actor $actor): Response
    {
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_edit', ['id' => $actor->getId()]);
        }

        return $this->render('admin/actor/edit.html.twig', [
            'actor' => $actor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actor_delete", methods="DELETE")
     */
    public function delete(Request $request, Actor $actor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actor->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actor);
            $em->flush();
        }

        return $this->redirectToRoute('actor_index');
    }
}
