<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2104 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

/** ActionController of Core */
namespace Cv\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Main Action Controller for the application.
 * Responsible for displaying the home site.  
 *
 */
class ManageController extends AbstractActionController
{
    
    /**
     * Home site
     *
     */
    public function indexAction()
    { }
    
    public function formAction()
    {
        $services = $this->getServiceLocator();
        $repositories = $services->get('repositories');
        $cvs          = $repositories->get('Cv');
        $form = $services->get('FormElementManager')->get('CvForm');
        
        if ($this->request->isPost()) {
            $id = $this->params()->fromPost('id');
            if (empty($id)) {
                $entity = $cvs->create();
            } else {
                $entity = $cvs->find($id);
            }
            $form->bind($entity);
            $form->setData($this->request->getPost());
            $valid = $form->isValid();
            if ($valid) {
                $entity->setUser($this->auth()->getUser());
                $repositories->store($entity);
                return array(
                    'isSaved' => true,
                );
            }
            
            exit;    
        }
        
        return array(
            'form' => $form
        );
    }
    
    public function saveAction()
    {
        
    }
    
}
