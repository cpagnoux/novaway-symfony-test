<?php

namespace App\Controller\Admin;

use App\Entity\Bluray;
use App\Form\BlurayType;
use App\Repository\BlurayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/bluray")
 */
class BlurayController extends AbstractController
{
    /**
     * @Route("/", name="bluray_index", methods="GET")
     */
    public function index(BlurayRepository $blurayRepository): Response
    {
        return $this->render('bluray/index.html.twig', ['blurays' => $blurayRepository->findAll()]);
    }

    /**
     * @Route("/new", name="bluray_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $bluray = new Bluray();
        $form = $this->createForm(BlurayType::class, $bluray);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bluray);
            $em->flush();

            return $this->redirectToRoute('bluray_index');
        }

        return $this->render('bluray/new.html.twig', [
            'bluray' => $bluray,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bluray_show", methods="GET")
     */
    public function show(Bluray $bluray): Response
    {
        return $this->render('bluray/show.html.twig', ['bluray' => $bluray]);
    }

    /**
     * @Route("/{id}/edit", name="bluray_edit", methods="GET|POST")
     */
    public function edit(Request $request, Bluray $bluray): Response
    {
        $form = $this->createForm(BlurayType::class, $bluray);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bluray_edit', ['id' => $bluray->getId()]);
        }

        return $this->render('bluray/edit.html.twig', [
            'bluray' => $bluray,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bluray_delete", methods="DELETE")
     */
    public function delete(Request $request, Bluray $bluray): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bluray->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bluray);
            $em->flush();
        }

        return $this->redirectToRoute('bluray_index');
    }
}
