<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 26.02.2019
 * Time: 14:10
 */

namespace Admin\Controller;

use Admin\Entity\News;
use Admin\Entity\Resident;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\NewsForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class NewsController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * News manager.
     * @var Admin\Service\NewsManager
     */
    private $newsManager;


    /**
     * Constructor.
     */
    public function __construct($entityManager, $newsManager)
    {
        $this->entityManager = $entityManager;
        $this->newsManager = $newsManager;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(News::class)
            ->findAllNews();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'news' => $paginator,
            'fromQuery' => $fromQuery
        ]);
    }

    public function viewAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Find a resident with such ID.
        $news = $this->entityManager->getRepository(News::class)
            ->find($id);

        if ($news == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'news' => $news
        ]);
    }

    public function addAction()
    {
        $res_id = $this->params()->fromQuery('res_id', '');
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create flat form
        $form = new NewsForm('create', $this->entityManager, null,$resident);

        // Check if flat has submitted the form
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $form->setData($data);

            // Validate form
            if($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Add news.
                $news = $this->newsManager->addNews($data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/news/";
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['image']) && $files['image']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['image']['name'], $dest.$news->getId().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('anews',
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

        $news = $this->entityManager->getRepository(News::class)
            ->find($id);

        if ($news == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $resident = $this->entityManager->getRepository(Resident::class)
            ->getResidentList();
        // Create news form
        $form = new NewsForm('update', $this->entityManager, $news, $resident);

        // Check if news has submitted the form
        if ($this->getRequest()->isPost()) {

            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            $form->setData($data);

            // Validate form
            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                $this->newsManager->updateNews($news, $data);

                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/news/";
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['image']) && $files['image']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['image']['name'], $dest.$news->getId().".jpeg");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('anews',
                    ['action'=>'index']);
            }
        } else {

            $form->setData(array(
                'res_id'=>$news->getResId(),
                'tittle'=>$news->getTittle(),
                'description'=>$news->getDescription(),
                'date'=>$news->getDate(),
            ));
        }

        return new ViewModel(array(
            'news' => $news,
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

        $news = $this->entityManager->getReference(News::class, $id);

        // Remove it and flush
        $this->entityManager->remove($news);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('anews', ['action'=>'index']);
    }

}