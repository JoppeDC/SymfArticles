<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ArticleRepository $articleRepository, EntityManagerInterface $em)
    {
        $this->articleRepository = $articleRepository;
        $this->em = $em;
    }

    /**
     * @Route("/", name="article_list")
     */
    public function index(): Response
    {
        $articles = $this->articleRepository->findAll();

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/new", name="new_article")
     * Method({"GET","POST"})
     */
    public function newArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $this->em->persist($article);
            $this->em->flush();

            return $this->redirectToRoute('article_list');
        }

        return $this->render('articles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/edit/{id}", name="edit_article")
     * Method({"GET","POST"})
     */
    public function editArticle(Request $request, $id): Response
    {
        $article = $this->articleRepository->find($id);

        if (!$article instanceof Article) {
            $article = new Article();
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('article_list'); //Redirect naar de naam van de route
        }

        return $this->render('articles/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function showArticle($id): Response
    {
        $article = $this->articleRepository->find($id);

        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/article/delete/{id}")
     * Method({"DELETE"})
     */
    public function delete($id): void
    {
        $response = new Response();
        $article = $this->articleRepository->find($id);

        if (!$article instanceof Article) {
            $response->send();
        }

        $this->em->remove($article);
        $this->em->flush();

        $response->send();
    }
}
