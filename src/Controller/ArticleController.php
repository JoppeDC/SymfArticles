<?php
/**
 * Created by PhpStorm.
 * User: JopkePC
 * Date: 31/08/2018
 * Time: 11:18
 */
    namespace App\Controller;
    use App\Entity\Article;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    class ArticleController extends Controller{

        //Routes kunnen ofwel hier ofwel in de routes.yaml geconfigureerd worden
        /**
         * @Route("/", name="article_list")
         */
        public function index(){
            $articles = $this->getDoctrine()->getRepository(Article::class)->findAll(); //Alle articles uit de db halen
            return $this->render('articles/index.html.twig', array(
                'articles' => $articles
            ));
        }

        //Route voor het showen van een specifiek artikel. ID word meegegeven in de URL (Zoals je kan zien in de route)
        /**
         * @Route("/article/{id}", name="article_show")
         */
        public function showArticle($id){
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            return $this->render('articles/show.html.twig', array(
                'article' => $article
            ));
        }

        //Tijdelijke functie voor articles in te vullen
//        /**
//         * @Route("/article/save")
//         */
//        public function save(){
//            $entityManager = $this->getDoctrine()->getManager();
//
//            $article = new Article();
//            $article->setTitle('This is the second article');
//            $article->setBody('In our second article we will...');
//
//            $entityManager->persist($article); //Persist zegt dat we iets uitendelijk willen opslaan
//            $entityManager->flush(); //Hier gaan we het effectief opslaan
//
//            return new Response('Saved an article with the id of ' . $article->getId());
//        }
    }