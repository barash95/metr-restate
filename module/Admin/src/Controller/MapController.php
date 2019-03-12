<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:12
 */

namespace Admin\Controller;

use Admin\Entity\Map;
use Admin\Entity\Resident;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\MapForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class MapController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Flat manager.
     * @var Admin\Service\mapManager
     */
    private $mapManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $mapManager)
    {
        $this->entityManager = $entityManager;
        $this->mapManager = $mapManager;
    }


    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);
        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(Map::class)
            ->findAllMap();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        return new ViewModel([
            'maps' => $paginator,
            'fromQuery' => $fromQuery
        ]);
    }

    public function addAction()
    {
        $res_id = $this->params()->fromQuery('res_id', '');
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create flat form
        $form = new MapForm('create', $this->entityManager, null,$resident);

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

                // Add flat.
                $map = $this->mapManager->addMap($data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('mapping',
                    ['action'=>'index']);
            }
        } else {
            $data['res_id'] = $res_id;

            $form->setData($data);
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

        $map = $this->entityManager->getRepository(Map::class)
            ->find($id);

        if ($map == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create map form
        $form = new MapForm('update', $this->entityManager, $map, $resident);

        // Check if map has submitted the form
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = $request->getPost()->toArray();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                $this->mapManager->updateMap($map, $data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('mapping',
                    ['action'=>'index']);
            }
        } else {

            $form->setData(array(
                'res_id'=>$map->getResId(),
                'x_pos'=>$map->getX(),
                'y_pos'=>$map->getY(),
            ));
        }

        return new ViewModel(array(
            'map' => $map,
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

        $map = $this->entityManager->getReference(Map::class, $id);

        // Remove it and flush
        $this->entityManager->remove($map);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('mapping', ['action'=>'index']);
    }

}