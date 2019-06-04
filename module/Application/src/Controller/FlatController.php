<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 15.02.2019
 * Time: 15:01
 */

namespace Application\Controller;

use Admin\Entity\Commertial;
use Admin\Entity\Resident;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Admin\Entity\Flat;
use Admin\Entity\Mortgage;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class FlatController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Searh flat manager.
     * @var Flat\Service\SearchFlatManager
     */
    private $searchFlatManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager, $searchFlatManager)
    {
        $this->entityManager = $entityManager;
        $this->searchFlatManager = $searchFlatManager;
    }

    public function onDispatch(MvcEvent $e)
    {
        // Вызываем метод базового класса onDispatch() и получаем ответ
        $response = parent::onDispatch($e);

        $ajax = $this->params()->fromQuery('ajax', false);

        if (!$ajax) {
            $this->layout('layout/layout_second');
        }
        if ($ajax) {
            $this->layout('layout/mini_layout');
        }

        // Возвращаем ответ
        return $response;
    }

    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);
        $this->searchFlatManager->init("ClientListSearch");


        if ($this->getRequest()->isPost()) {
            $data = $formData = $this->params()->fromPost();
            $this->searchFlatManager->saveSearch($data);
        } else {
            $filter = $this->searchFlatManager->getSearch();

            if (count($filter) == 0 || intval($this->params()->fromQuery('reset', 0)) == 1) {
                $formData = ['size' => '', 'price_min' => '', 'price_max' => '', 'square_min' => '', 'square_max' => '', 'floor' => '', 'year' => '', 'resident' => '', 'metro' => '', 'region' => ''];
                $this->searchFlatManager->saveSearch($formData);
            }
            else {
                $formData = $filter;
                $this->searchFlatManager->saveSearch($formData);
            }
        }

        $filter = $this->searchFlatManager->getSearch();

        $fromQuery = $this->params()->fromQuery();
        if (isset($fromQuery['page'])) unset($fromQuery['page']);

        $filter = array_merge($filter, $fromQuery);
        $formData = array_merge($formData, $fromQuery);
        $query = $this->entityManager->getRepository(Flat::class)
            ->findAllFlat($filter);
        $count = count($query->execute());

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(6);
        $paginator->setCurrentPageNumber($page);

//        $formData = $this->checkData($formData);

        return new ViewModel([
            'data' => $formData,
            'flats' => $paginator,
            'fromQuery' => $fromQuery,
            'count' => $count
        ]);
    }

    public function ajaxFlatsAction()
    {
    $page = $this->params()->fromQuery('page', 1);
    $this->searchFlatManager->init("ClientListSearch");

    if ($this->getRequest()->isPost()) {
        $data = $formData = $this->params()->fromPost();
        $this->searchFlatManager->saveSearch($data);
    } else {
        $filter = $this->searchFlatManager->getSearch();

        if (count($filter) == 0 || intval($this->params()->fromQuery('reset', 0)) == 1) {
            $formData = ['size' => '', 'price_min' => '', 'price_max' => '', 'square_min' => '', 'square_max' => '', 'floor' => '', 'year' => '', 'resident' => '', 'metro' => '', 'region' => ''];
            $this->searchFlatManager->saveSearch($formData);
        }
        else {
            $formData = $filter;
            $this->searchFlatManager->saveSearch($formData);
        }
    }

    $filter = $this->searchFlatManager->getSearch();

    $fromQuery = $this->params()->fromQuery();
    if (isset($fromQuery['page'])) unset($fromQuery['page']);

    $filter = array_merge($filter, $fromQuery);
    $formData = array_merge($formData, $fromQuery);
    $query = $this->entityManager->getRepository(Flat::class)
        ->findAllFlat($filter);
    $count = count($query->execute());

    $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
    $paginator = new Paginator($adapter);
    $paginator->setDefaultItemCountPerPage(6);
    $paginator->setCurrentPageNumber($page);

    $view = new ViewModel([
        'flats' => $paginator,
        'fromQuery' => $fromQuery,
        'count' => $count,
        'data' => $formData
    ]);

    $view->setTerminal(true);

    return $view;
}

    public function viewAction()
    {
//        $this->layout('layout/layout_view');

        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id < 1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Find a resident with such ID.
        $flat = $this->entityManager->getRepository(Flat::class)
            ->find($id);

        if ($flat == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $mortgages = $this->entityManager->getRepository(Mortgage::class)
            ->findAll();

        return new ViewModel([
            'flat' => $flat,
            'banks' => $mortgages
        ]);
    }

    public function favoritesAction()
    {
//        $this->layout('layout/layout_view');
        $flats = $commertials = array();
        $flats_fav = $commertials_fav = false;
        if (isset($_COOKIE['favorites']))
            $flats_fav = $_COOKIE['favorites'];
        if (isset($_COOKIE['favorites-com']))
            $commertials_fav = $_COOKIE['favorites-com'];
        if ($flats_fav) {
            $flats_fav = explode(";", $flats_fav); // array of flats
            $flats = $this->entityManager->getRepository(Flat::class)
                ->findById($flats_fav);
        }
        if ($commertials_fav) {
            $commertials_fav = explode(';', $commertials_fav);
            $commertials = $this->entityManager->getRepository(Commertial::class)->findById($commertials_fav);
        }

        return new ViewModel([
            'flats' => $flats,
            'commertials' =>$commertials
        ]);
    }

    public function pdfAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Find a flat with such ID.
        $flat = $this->entityManager->getRepository(Flat::class)
            ->find($id);
        $res = $this->entityManager->getRepository(Resident::class)->find($flat->getResId());

        $pdf = new \tFPDF();

        $pdf->AddFont('DejaVu','','DejaVuSansCondensed-Bold.ttf',true);
        $pdf->SetFont('DejaVu','',14);

        $pdf->AddPage();
//        $pdf->Cell( 145, 40, $pdf->Image(ROOT_PATH."/public/main/images/content/logo.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
        $pdf->Cell( 0, 3, "+7999999999", 0, 2, 'R', false );
        $pdf->Cell( 0, 3, "ЖК ".$res->getName(), 0, 2, 'C', false );

        $pdf->SetFont('DejaVu','',12);
        $pdf->Cell( 0, 10, "metr-restate.ru", 0, 1, 'R', false );
        $pdf->Line(0, 30, 220, 30);

        $flat_txt = $flat->getSizeTxt();

        $pdf->Cell( 0, 30, "$flat_txt №".$flat->getNumber(), 0, 1, 'C', false );
        $pdf->Cell( 45, 0, "Площадь: ".$flat->getSquare(), 0, 0, 'L', false );
        $pdf->Cell( 45, 0, "Комнат: ".$flat->getSizeAsString(), 0, 0, 'L', false );
        $pdf->Cell( 35, 0, "Этаж: ".$flat->getFloor(), 0, 0, 'L', false );
        $pdf->Cell( 35, 0, "Сдача: ".$flat->getYear(), 0, 0, 'L', false );
        $pdf->Cell( 35, 0, "Цена: ".$flat->getPrice(), 0, 1, 'L', false );

        $pdf->Cell( 100, 0, $pdf->Image(ROOT_PATH."/public".$flat->getPlan(), $pdf->GetX(), $pdf->GetY()+10, 100), 0, 0, 'L', false );
//        $pdf->Cell( 100, 0, $pdf->Image(ROOT_PATH."/public/".$flat->getEtagPlanImage(), 100, $pdf->GetY()+30, 100), 0, 0, 'L', false );

        $pdf->Ln(100);
//        $pdf->Cell( 100, 0, $pdf->Image(ROOT_PATH."/public/main/images/forpdf/".$flat->getHousing().".jpg", $pdf->getX()+50, $pdf->getY()+10, 100), 0, 0, 'L', false);

        $pdf->Ln(100);
        $pdf->SetFont('DejaVu','',16);
        $pdf->Cell( 0, 20, "Офис продаж", 0, 1, 'C', false );
        $pdf->SetFont('DejaVu','',12);
        $pdf->Cell( 0, 0, "г. Петрозаводск", 0, 1, 'C', false );

        $pdf->Output();
    }

    private function checkData($data)
    {
        if (!isset($data['price_min_com'])) $data['price_min_com'] = '';
        if (!isset($data['price_max_com'])) $data['price_max_com'] = '';
        if (!isset($data['square_min_com'])) $data['square_min_com'] = '';
        if (!isset($data['square_max_com'])) $data['square_max_com'] = '';
        if (!isset($data['year_com'])) $data['year_com'] = '';
        if (!isset($data['resident_com'])) $data['resident_com'] = '';

        if (!isset($data['price_min'])) $data['price_min'] = '';
        if (!isset($data['price_max'])) $data['price_max'] = '';
        if (!isset($data['square_min'])) $data['square_min'] = '';
        if (!isset($data['square_max'])) $data['square_max'] = '';
        if (!isset($data['year'])) $data['year'] = '';
        if (!isset($data['resident'])) $data['resident'] = '';
        if (!isset($data['floor'])) $data['floor'] = '';
        if (!isset($data['size'])) $data['size'] = '';

        return $data;
    }

}