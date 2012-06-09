<?php

namespace Striide\TinyurlBundle\Service;

use Striide\TinyurlBundle\Entity\Url;

class TinyurlService
{
  protected $doctrine,
            $logger,
            $router = null,
            $minLength = 6;

  public function __construct($doctrine,$logger,$router)
  {
    $this->doctrine = $doctrine;
    $this->logger = $logger;
    $this->router = $router;
  }
  public function setMinLength($length)
  {
    $this->minLength = $length;
  }
  public function trackClick($short)
  {
    // track the click for the short
    $conn = $this->doctrine->getEntityManager()->getConnection();

    $conn->beginTransaction();
    try
    {
      $conn->executeUpdate("UPDATE striide_tinyurl SET clicks = clicks + 1 WHERE short = ?", array($short));
      $conn->commit();
    }
    catch (Exception $e)
    {
      $conn->rollback();
    }
  }

  public function getShort($uri)
  {
    $repo = $this->doctrine->getEntityManager()->getRepository('StriideTinyurlBundle:Url');
    $url = $repo->findOneBy(array('uri' => $uri));

    if(!empty($url))
    {
      return $this->router->generate('StriideTinyurlBundle_url', array('short' => $url->getShort()));
    }

    while(true)
    {
      $short = $this->doShrinking($uri,$this->minLength++);

      $url = $repo->findOneBy(array('short' => $short));

      if(empty($url))
      {
        break;
      }
    }

    $this->save($short,$uri);
    $new_url = $this->router->generate('StriideTinyurlBundle_url', array('short' => $short));

    return $new_url;
  }

  protected function doShrinking($uri, $length)
  {
    $url = md5($uri);
    $urlHash = '';

    do {
      $hash = $urlHash .= $url;
      $hash = pack('H*', $hash);

      $hash = base64_encode($hash);

      $hash = str_replace(array('+', '/', '='), array('', '', ''), $hash);
    } while (strlen($hash) < $length);

    $str = substr($hash, 0, $length);
    return $str;
  }


  public function getUrl($short)
  {
    // doctrine
    $repo = $this->doctrine->getEntityManager()->getRepository('StriideTinyurlBundle:Url');
    $url = $repo->findOneBy(array('short' => $short));

    return $url;
  }

  /**
   * @param string $short tinyurl
   * @param string $uri uri
   */
  protected function save($short, $uri)
  {
    $entity = new Url();
    $entity->setShort($short);
    $entity->setUri($uri);

    $em = $this->doctrine->getEntityManager();
    $em->persist($entity);
    $em->flush();
  }
}
