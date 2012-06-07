<?php

namespace Striide\TinyurlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('StriideTinyurlBundle:Default:index.html.twig', array('name' => $name));
    }
}
