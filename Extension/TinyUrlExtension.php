<?php

namespace Striide\TinyurlBundle\Extension;

class TinyUrlExtension extends \Twig_Extension
{
  private $tinyurl_service;
  public function setTinyUrlService($service)
  {
   $this->tinyurl_service = $service;
  }

  /**
   *
   */
  public function __construct()
  {
  }

  public function getFilters()
  {
    return array(
      'tinyUrl'  => new \Twig_Filter_Method($this, 'tinyUrl'),
    );
  }

  /**
   * @param string $uri a uri to be shrunk
   * @return string
   */
  public function tinyUrl($uri)
  {
    return $this->tinyurl_service->getShort($uri);
  }

  /**
   *
   */
  public function getName()
  {
    return 'striide_tinyurl_twig_extension';
  }

}
