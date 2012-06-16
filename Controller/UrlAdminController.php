<?php

namespace Striide\TinyurlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UrlAdminController extends Controller
{
  public function indexAction()
  {
    $entities = $this->getDoctrine()->getEntityManager()->getRepository('StriideTinyurlBundle:Url')->findLatest();
    return $this->render('StriideTinyurlBundle:UrlAdmin:index.html.twig',
                          array(
                            'entities' => $entities
                          )
                        );
  }
  public function showSlugAction($slug)
  {
    $entity = $this->getDoctrine()->getEntityManager()->getRepository('StriideTinyurlBundle:Url')->findOneBy(array('short' => $slug));
    return $this->render('StriideTinyurlBundle:UrlAdmin:show.html.twig', array('entity' => $entity));
  }
  public function showIdAction($id)
  {
    $entity = $this->getDoctrine()->getEntityManager()->getRepository('StriideTinyurlBundle:Url')->findOneBy(array('id' => $id));
    return $this->render('StriideTinyurlBundle:UrlAdmin:show.html.twig', array('entity' => $entity));
  }
}
