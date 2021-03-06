<?php
/**
 * YAWIK
 *
 * @copyright (c) 2013-2104 Cross Solution (http://cross-solution.de)
 * @license   GPLv3
 */

namespace Organizations\Repository;

use Core\Repository\AbstractRepository;
use Core\Entity\EntityInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Organization extends AbstractRepository
{
    /**
     * Find a organizations by an name
     * 
     * @param String $name
     * @return \Organizations\Entity\Organization
     */
    public function findbyName($name, $create = false) {
        $organizations = array();
        $query = $this->dm->createQueryBuilder("Organizations\Entity\OrganizationName")->hydrate(false)->field('name')->equals($name)->select("_id");
        $result = $query->getQuery()->execute()->toArray(false);
        if (empty($result)) {
            // create
            $repositoryNames = $this->dm->getRepository("Organizations\Entity\OrganizationName");
            $entityName = $repositoryNames->create();
            $entityName->setName($name);
            $entity = $this->create();
            $entity->setOrganizationName($entityName);
            $this->store($entity);
            $organizations = array($entity);
        }
        else {
            $idName = $result[0]['_id'];
            $organizations = $this->findBy(array('organizationName' => $idName));
        }
        return $organizations; 
    }
    
    public function findbyRef($ref, $create = true) {
        $entity = $this->findOneBy(array('externalId' => $ref));
        if (empty($entity)) {
            $entity = $this->create();
            $entity->setExternalId($ref);
        }
        return $entity;
    }
}