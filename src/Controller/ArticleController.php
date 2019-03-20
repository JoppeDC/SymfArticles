<?php
/**
 * Created by PhpStorm.
 * User: JopkePC
 * Date: 31/08/2018
 * Time: 11:18
 */

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    //Routes kunnen ofwel hier ofwel in de routes.yaml geconfigureerd worden

    /**
     * @Route("/", name="article_list")
     */
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll(); //Alle articles uit de db halen
        return $this->render('articles/index.html.twig', [
                'articles' => $articles,
            ]);
    }

    /**
     * @Route("/article/new", name="new_article")
     * Method({"GET","POST"})
     */
    public function newArticle(Request $request)
    {
        $article = new Article();
        $form = $this->createFormBuilder($article) //We gebruiken de formbuilder voor het aanmaken van de forms
                ->add('title', TextType::class, ['attr' => ['class' => 'form-control']])
                ->add('body', TextareaType::class, [
                'required' => true,
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('save', SubmitType::class, [
                    'label' => 'Create',
                    'attr' => ['class' => 'btn btn-primary mt-3'],
                ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) { //Als de form gesubmit word
                $article = $form->getData(); //Neem de data uit de form, en vul het article object ermee

                $entityManager = $this->getDoctrine()->getManager(); //Manager klaarmaken
                $entityManager->persist($article); //Klaarzetten om op te slaan
                $entityManager->flush(); //Opslaan

                return $this->redirectToRoute('article_list'); //Redirect naar de naam van de route
        }

        return $this->render('articles/new.html.twig', [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/article/edit/{id}", name="edit_article")
     * Method({"GET","POST"})
     */
    public function editArticle(Request $request, $id)
    {
        $article = new Article();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $form = $this->createFormBuilder($article)
                ->add('title', TextType::class, ['attr' => ['class' => 'form-control']])
                ->add('body', TextareaType::class, [
                    'required' => true,
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('save', SubmitType::class, [
                    'label' => 'Update',
                    'attr' => ['class' => 'btn btn-primary mt-3'],
                ])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager(); //Manager klaarmaken
                $entityManager->flush(); //Opslaan
                return $this->redirectToRoute('article_list'); //Redirect naar de naam van de route
        }

        return $this->render('articles/edit.html.twig', [
                'form' => $form->createView(),
            ]);
    }

    //Route voor het showen van een specifiek artikel. ID word meegegeven in de URL (Zoals je kan zien in de route)
    //We moeten deze onder de new zetten, anders ziet hij 'new' als een id

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function showArticle($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('articles/show.html.twig', [
                'article' => $article,
            ]);
    }

    /**
     * @Route("/article/delete/{id}")
     * Method({"DELETE"})
     */
    public function delete($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id); //Artikel met correcte ID zoeken
            $entityManager = $this->getDoctrine()->getManager(); //Manager klaarmaken
            $entityManager->remove($article); //Klaarzetten om te verwijderen
            $entityManager->flush(); //Bevestigen
            $response = new Response();
        $response->send();
    }
}
