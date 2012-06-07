<?php

namespace Striide\TinyurlBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Striide\TinyurlBundle\Entity\Url
 */
class Url
{
  public function __construct()
  {
    $this->created_at = new \DateTime();
    $this->clicks = 0;
  }

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $short
     */
    private $short;

    /**
     * @var string $uri
     */
    private $uri;

    /**
     * @var bigint $clicks
     */
    private $clicks;

    /**
     * @var datetime $created_at
     */
    private $created_at;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set short
     *
     * @param string $short
     */
    public function setShort($short)
    {
        $this->short = $short;
    }

    /**
     * Get short
     *
     * @return string
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * Set uri
     *
     * @param text $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * Get uri
     *
     * @return text
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set clicks
     *
     * @param bigint $clicks
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;
    }

    /**
     * Get clicks
     *
     * @return bigint
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
