<?php

namespace App\Controller\Admin;

use App\Entity\Dvd;
use App\Form\DvdType;
use App\Repository\DvdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/dvd")
 */
class DvdController extends AbstractController
{
    /**
     * @Route("/", name="dvd_index", methods="GET")
     */
    public function index(DvdRepository $dvdRepository): Response
    {
        return $this->render('admin/dvd/index.html.twig', ['dvds' => $dvdRepository->findAll()]);
    }

    /**
     * @Route("/new", name="dvd_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $dvd = new Dvd();
        $form = $this->createForm(DvdType::class, $dvd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dvd);
            $em->flush();

            return $this->redirectToRoute('dvd_index');
        }

        return $this->render('admin/dvd/new.html.twig', [
            'dvd' => $dvd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dvd_show", methods="GET")
     */
    public function show(Dvd $dvd): Response
    {
        return $this->render('admin/dvd/show.html.twig', ['dvd' => $dvd]);
    }

    /**
     * @Route("/{id}/edit", name="dvd_edit", methods="GET|POST")
     */
    public function edit(Request $request, Dvd $dvd): Response
    {
        $form = $this->createForm(DvdType::class, $dvd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dvd_edit', ['id' => $dvd->getId()]);
        }

        return $this->render('admin/dvd/edit.html.twig', [
            'dvd' => $dvd,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dvd_delete", methods="DELETE")
     */
    public function delete(Request $request, Dvd $dvd): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dvd->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dvd);
            $em->flush();
        }

        return $this->redirectToRoute('dvd_index');
    }
}
