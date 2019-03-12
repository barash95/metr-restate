<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 15.02.2019
 * Time: 15:41
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NewsController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function viewAction()
    {
        return new ViewModel();
    }
}