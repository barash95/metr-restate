<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:12
 */

namespace Admin\Controller;

use Admin\Entity\Mortgage;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\MortgageForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class MortgageController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Mortgage manager.
     * @var Admin\Service\MortgageManager
     */
    private $mortgageManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $mortgageManager)
    {
        $this->entityManager = $entityManager;
        $this->mortgageManager = $mortgageManager;
    }


    public function indexAction()
    {
        $mortgages = $this->entityManager->getRepository(Mortgage::class)
            ->findAll();

        return new ViewModel([
            'mortgages' => $mortgages,
        ]);
    }

    public function addAction()
    {
        $form = new MortgageForm('create', $this->entityManager, null);

        // Check if flat has submitted the form
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = $request->getPost()->toArray();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                $mortgage = $this->mortgageManager->addMortgage($data);
                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/mortgage/";
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['icon']) && $files['icon']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['icon']['name'], $dest.$mortgage->getId().'png');
                }
                // Redirect to "view" page
                return $this->redirect()->toRoute('mortgage',
                    ['action'=>'index']);
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function editAction()
    {

        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $mortgage = $this->entityManager->getRepository(Mortgage::class)
            ->find($id);

        if ($mortgage == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new MortgageForm('update', $this->entityManager, $mortgage);

        // Check if mortgage has submitted the form
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = $request->getPost()->toArray();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                $this->mortgageManager->updateMortgage($mortgage, $data);
                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/mortgage/";
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['icon']) && $files['icon']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['icon']['name'], $dest.$mortgage->getId().'png');
                }
                // Redirect to "view" page
                return $this->redirect()->toRoute('mortgage',
                    ['action'=>'index']);
            }
        } else {

            $form->setData(array(
                'name'=>$mortgage->getName(),
                'percent'=>$mortgage->getPercent(),
                'year'=>$mortgage->getYear(),
                'money'=>$mortgage->getMoney()
            ));
        }

        return new ViewModel(array(
            'mortgage' => $mortgage,
            'form' => $form
        ));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $mortgage = $this->entityManager->getReference(Mortgage::class, $id);

        // Remove it and flush
        $this->entityManager->remove($mortgage);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('mortgage', ['action'=>'index']);
    }

}