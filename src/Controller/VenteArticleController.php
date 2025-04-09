<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Entity\VenteArticle;
use App\Form\VenteArticleType;
use App\Repository\VenteArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vente/article')]
final class VenteArticleController extends AbstractController
{
    #[Route(name: 'app_vente_article_index', methods: ['GET'])]
    public function index(VenteArticleRepository $venteArticleRepository): Response
    {
        return $this->render('vente_article/index.html.twig', [
            'vente_articles' => $venteArticleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vente_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $venteArticle = new VenteArticle();
        $form = $this->createForm(VenteArticleType::class, $venteArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($venteArticle);
            $entityManager->flush();

            return $this->redirectToRoute('app_vente_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vente_article/new.html.twig', [
            'vente_article' => $venteArticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vente_article_show', methods: ['GET'])]
    public function show(VenteArticle $venteArticle): Response
    {
        return $this->render('vente_article/show.html.twig', [
            'vente_article' => $venteArticle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vente_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VenteArticle $venteArticle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VenteArticleType::class, $venteArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vente_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vente_article/edit.html.twig', [
            'vente_article' => $venteArticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vente_article_delete', methods: ['POST'])]
    public function delete(Request $request, VenteArticle $venteArticle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$venteArticle->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($venteArticle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vente_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
