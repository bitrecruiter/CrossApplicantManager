<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2104 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

/** Applications entities */
namespace Applications\Entity;

use Auth\Entity\Info;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Auth\Entity\InfoInterface;
use Core\Entity\Hydrator\EntityHydrator;
use Core\Entity\Hydrator\Strategy\FileCopyStrategy;

/**
 * Holds the contact informations including the optional photo of the applicant.
 * 
 * @author Carsten Bleek <bleek@cross-solution.de>
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 * @ODM\EmbeddedDocument
 */
class Contact extends Info {

    /**
     * profile image of an application.
     * 
     * As contact image is stored as an {@link Applications\Entity\Attachment} it must be 
     * redeclared here.
     * 
     * @var \Core\Entity\FileInterface
     * @ODM\ReferenceOne(targetDocument="Attachment", simple=true, nullable=true, cascade={"persist", "update", "remove"}, orphanRemoval=true)
     */
    protected $image;
    
    /**
     * Creates a Contact
     * 
     * @param InfoInterface|null $userInfo
     * @uses inherit()
     */
    public function __construct(InfoInterface $userInfo = null)
    {
        if ($userInfo) {
            $this->inherit($userInfo);
        }
    }
    
    /**
     * Inherit data from an {@link UserInfoInterface}.
     * 
     * Copies the user image to an application attachment.
     * 
     * @param UserInfoInterface $info
     * @return \Applications\Entity\Contact
     */
    public function inherit(InfoInterface $info)
    {
        $hydrator      = new EntityHydrator();
        $imageStrategy = new FileCopyStrategy(new Attachment());
        
        $hydrator->addStrategy('image', $imageStrategy);
        
        $data = $hydrator->extract($info);
        $hydrator->hydrate($data, $this);
        
        return $this;
    }
    
}

?>