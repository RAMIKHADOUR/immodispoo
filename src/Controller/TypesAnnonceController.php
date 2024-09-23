<?php

namespace App\Controller;

use App\Entity\TypesAnnonce;
use App\Form\TypesAnnonceType;
use App\Repository\TypesAnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/types/annonce')]
final class TypesAnnonceController extends AbstractController
{
    #[Route(name: 'app_types_annonce_index', methods: ['GET'])]
    public function index(TypesAnnonceRepository $typesAnnonceRepository): Response
    {
        return $this->render('types_annonce/index.html.twig', [
            'types_annonces' => $typesAnnonceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_types_annonce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typesAnnonce = new TypesAnnonce();
        $form = $this->createForm(TypesAnnonceType::class, $typesAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typesAnnonce);
            $entityManager->flush();

            return $this->redirectToRoute('app_types_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('types_annonce/new.html.twig', [
            'types_annonce' => $typesAnnonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_types_annonce_show', methods: ['GET'])]
    public function show(TypesAnnonce $typesAnnonce): Response
    {
        return $this->render('types_annonce/show.html.twig', [
            'types_annonce' => $typesAnnonce,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_types_annonce_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypesAnnonce $typesAnnonce, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypesAnnonceType::class, $typesAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_types_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('types_annonce/edit.html.twig', [
            'types_annonce' => $typesAnnonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_types_annonce_delete', methods: ['POST'])]
    public function delete(Request $request, TypesAnnonce $typesAnnonce, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typesAnnonce->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typesAnnonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_types_annonce_index', [], Response::HTTP_SEE_OTHER);
    }
}
