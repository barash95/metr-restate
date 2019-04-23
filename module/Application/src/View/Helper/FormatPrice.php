<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This view helper class displays flat price with space as separator for thousands
 */
class FormatPrice extends AbstractHelper
{
  public function render($price){
    return number_format($price, 0, ".", " ");
  }
}