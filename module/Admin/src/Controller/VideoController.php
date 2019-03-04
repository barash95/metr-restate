<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:12
 */

namespace Admin\Controller;

use Admin\Entity\Video;
use Admin\Entity\Resident;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\VideoForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class VideoController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Flat manager.
     * @var Admin\Service\videoManager
     */
    private $videoManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $videoManager)
    {
        $this->entityManager = $entityManager;
        $this->videoManager = $videoManager;
    }


    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);
        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(Video::class)
            ->findAllVideo();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        return new ViewModel([
            'videos' => $paginator,
            'fromQuery' => $fromQuery
        ]);
    }

    public function addAction()
    {
        $res_id = $this->params()->fromQuery('res_id', '');
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create flat form
        $form = new VideoForm('create', $this->entityManager, null,$resident);

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
                $video = $this->videoManager->addVideo($data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('video',
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

        $video = $this->entityManager->getRepository(Video::class)
            ->find($id);

        if ($video == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create video form
        $form = new VideoForm('update', $this->entityManager, $video, $resident);

        // Check if video has submitted the form
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = $request->getPost()->toArray();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                $this->videoManager->updateVideo($video, $data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('video',
                    ['action'=>'index']);
            }
        } else {

            $form->setData(array(
                'res_id'=>$video->getResId(),
                'tittle'=>$video->getTittle(),
                'link'=>$video->getLink(),
                'date'=>$video->getDate()
            ));
        }

        return new ViewModel(array(
            'video' => $video,
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

        $video = $this->entityManager->getReference(Video::class, $id);

        // Remove it and flush
        $this->entityManager->remove($video);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('video', ['action'=>'index']);
    }

}