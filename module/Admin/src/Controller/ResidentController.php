<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 18.02.2019
 * Time: 17:12
 */

namespace Admin\Controller;

use Admin\Entity\Flat;
use Admin\Entity\House;
use Admin\Entity\Resident;
use Admin\Entity\Video;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form\ResidentForm;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class ResidentController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Flat manager.
     * @var Admin\Service\ResidentManager
     */
    private $residentManager;

    /**
     * Flat manager.
     * @var Admin\Service\FlatManager
     */
    private $flatManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $residentManager, $flatManager)
    {
        $this->entityManager = $entityManager;
        $this->residentManager = $residentManager;
        $this->flatManager = $flatManager;
    }


    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $query = $this->entityManager->getRepository(Resident::class)
            ->findAllResident();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        return new ViewModel([
            'residents' => $paginator,
            'fromQuery' => $fromQuery
        ]);
    }

    public function addAction()
    {

        // Create flat form
        $form = new ResidentForm('create', $this->entityManager);

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


                $resident = $this->residentManager->addResident($data);

                // copy uploaded files to new location
                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/resident/".$resident->getId();
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['complex']) && $files['complex']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['complex']['name'], $dest."/complex.jpeg");
                }
                if (isset($files['complex1']) && $files['complex1']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['complex1']['name'], $dest."/complex1.png");
                }
                if (isset($files['complex2']) && $files['complex2']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['complex2']['name'], $dest."/complex2.png");
                }
                if (isset($files['complex3']) && $files['complex3']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['complex3']['name'], $dest."/complex3.png");
                }

                // Redirect to "view" page
                return $this->redirect()->toRoute('resident',
                    ['action'=>'view', 'id'=>$resident->getId()]);
            }
        }

        return new ViewModel([
            'form' => $form
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
        $resident = $this->entityManager->getRepository(Resident::class)
            ->find($id);

        $housing = $this->entityManager->getRepository(House::class)->getHouseByResId($id);
        $video = $this->entityManager->getRepository(Video::class)->getByResId($id);

        if ($resident == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        return new ViewModel([
            'resident' => $resident,
            'housing' => $housing,
            'videos' => $video
        ]);
    }

    public function editAction()
    {

        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $resident = $this->entityManager->getRepository(Resident::class)
            ->find($id);

        if ($resident == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Create resident form
        $form = new ResidentForm('update', $this->entityManager, $resident);

        // Check if resident has submitted the form
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

                // Update the flat.
                $this->residentManager->updateResident($resident, $data);

                // copy uploaded files to new location
                $files = $request->getFiles()->toArray();
                $dest = ROOT_PATH."/public/data/resident/".$resident->getId();
                if (!is_dir($dest)) mkdir($dest);
                if (isset($files['complex']) && $files['complex']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['complex']['name'], $dest."/complex.jpeg");
                }
                if (isset($files['complex1']) && $files['complex1']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['complex1']['name'], $dest."/complex1.png");
                }
                if (isset($files['complex2']) && $files['complex2']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['complex2']['name'], $dest."/complex2.png");
                }
                if (isset($files['complex3']) && $files['complex3']['name']>''){
                    rename(ROOT_PATH."/public/data/upload/".$files['complex3']['name'], $dest."/complex3.png");
                }
                // Redirect to "view" page
                return $this->redirect()->toRoute('resident',
                    ['action'=>'view', 'id'=>$resident->getId()]);
            }
        } else {

            $form->setData(array(
                'name'=>$resident->getName(),
                'tittle'=>$resident->getTittle(),
                'link' => $resident->getLink(),
                'description'=>$resident->getDescription(),
                'tittle1'=>$resident->getTittle1(),
                'description1'=>$resident->getDescription1(),
                'tittle2'=>$resident->getTittle2(),
                'description2'=>$resident->getDescription2(),
                'tittle3'=>$resident->getTittle3(),
                'description3'=>$resident->getDescription3(),
                'metro'=>$resident->getMetro(),
                'housing'=>$resident->getHousing(),
                'address'=>$resident->getAddress(),
                'total_flat'=>$resident->getTotalFlat(),
                'state'=>$resident->getState(),
            ));
        }

        return new ViewModel(array(
            'resident' => $resident,
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

        $resident = $this->entityManager->getReference(Resident::class, $id);

        // Remove it and flush
        $this->entityManager->remove($resident);
        $this->entityManager->flush();

        // Redirect to "view" page
        return $this->redirect()->toRoute('resident', ['action'=>'index']);
    }

    public function parseAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        if($id == -1){
            $resident = $this->entityManager->getRepository(Resident::class)->getResidentList();
            foreach($resident as $res)
                $message[] = $this->parser($res['id']);
        } else $message[] = $this->parser($id);

        return new ViewModel(array(
            'message' => $message
        ));
    }

    protected function parser($id){
        $resident = $this->entityManager->getRepository(Resident::class)->find($id);
        $res_id = $resident->getId();
        $link = $resident->getLink();

        $info = simplexml_load_file($link);
        $info = json_decode(json_encode((array)$info), TRUE);

        $dest = ROOT_PATH."/public/data/resident/".$res_id;
        if (!is_dir($dest)) mkdir($dest);
        $list_flats = $this->entityManager->getRepository(Flat::class)->getFlatList($res_id);
        foreach ($list_flats as $flat)
            $old_flats[$flat['ex_id']] = $flat['id'];

        $flats = $info['flats']['flat'];
        $i = 0;
        if (is_array($flats)) {
            foreach ($flats as $flat) {
                $i++;
                if($i == 100) break;
                $flat['res_id'] = $res_id;
                $new_flat = $this->flatManager->addOrUpdateFlat($flat);

                if(is_array($new_flat)) $new_flat = $new_flat[0];

                //file_put_contents($dest.'/flat'.$new_flat->getExId().'.jpeg', file_get_contents($flat['plan']));

                if(!copy($flat['plan'],$dest.'/flat'.$new_flat->getId().'.jpeg')){
                    $errors= error_get_last();
                    $message[] =  "Не удалось скопировать {$flat['plan']} :  {$errors['type']} - {$errors['message']}<br>";
                } else $message[] = "<a href='/flats/view/{$new_flat->getId()}'>Квартира {$new_flat->getId()}</a><br>";
                if (isset($old_flats[$flat['ex_id']])) unset($old_flats[$flat['ex_id']]);
            }
        }
        foreach ($old_flats as $flat){
            $remove_flat = $this->entityManager->getReference(Flat::class, $flat);
            $this->entityManager->remove($remove_flat);
            $this->entityManager->flush();
            if(!unlink($dest.'/flat'.$flat.'.jpeg')) error_clear_last () ;
        }

        return $message;
    }
}