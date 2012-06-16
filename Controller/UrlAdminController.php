<?php

namespace Striide\TinyurlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UrlAdminController extends Controller
{
  public function indexAction()
  {
    $page = 1;
    $request = $this->get('request');
    if ($request->query->get('page'))
    {
      $page = $request->query->get('page');
      $page = intval($page);

      if ($page < 1)
      {
        $page = 1;
      }
    }

    $entities = $this->getDoctrine()->getEntityManager()->getRepository('StriideTinyurlBundle:Url')->findAllLimit($page);
    return $this->render('StriideTinyurlBundle:UrlAdmin:index.html.twig',
                          array(
                            'entities' => $entities,
                            'page' => $page,
                            'show_pager' => true
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
