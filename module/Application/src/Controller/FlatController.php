<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 15.02.2019
 * Time: 15:01
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FlatController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function viewAction()
    {
        return new ViewModel();
    }

    public function favoritesAction()
    {
        return new ViewModel();
    }

    public function pdfAction()
    {
        return new ViewModel();
    }

}