<?php
/**
 * Created by PhpStorm.
 * User: JopkePC
 * Date: 31/08/2018
 * Time: 11:18
 */
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    class ArticleController extends Controller{
        /**
         * @Route("/")

         */
        public function index(){
            return $this->render('articles/index.html.twig');
        }
    }