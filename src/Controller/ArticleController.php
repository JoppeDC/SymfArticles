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

    class ArticleController {
        /**
         * @Route("/")

         */
        public function index(){
            return new Response('<html><body>Hello</body></html>');
        }
    }