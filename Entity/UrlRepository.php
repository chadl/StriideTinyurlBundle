<?php

namespace Striide\TinyurlBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UrlRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UrlRepository extends EntityRepository
{
    /**
   * @param int $limit
   * @param int $page
   */
  public function findAllLimit($page, $limit = 50)
  {
    $query = $this->getEntityManager()->createQuery('
					SELECT u
					FROM Striide\TinyurlBundle\Entity\Url u
          ORDER BY u.created_at DESC
				');
    $query->setFirstResult(($page * $limit) + 1 - $limit);
    $query->setMaxResults($limit);
    $query->useResultCache(true, 1, 'tinyurl_find_all');
    try
    {
      $urls = $query->getResult();
      return $urls;
    }
    catch(\Doctrine\ORM\NoResultException $e)
    {
      return null;
    }
  }

  /**
   *
   * @return Striide\TinyurlBundle\Entity\Url
   */
  public function findLatest($limit = 50)
  {
    $query = $this->getEntityManager()->createQuery('
					SELECT u
					FROM Striide\TinyurlBundle\Entity\Url u
          ORDER BY u.created_at DESC
				');
    $query->setMaxResults($limit);
    try
    {
      $urls = $query->getResult();
      return $urls;
    }
    catch(\Doctrine\ORM\NoResultException $e)
    {
      return null;
    }
  }
}
