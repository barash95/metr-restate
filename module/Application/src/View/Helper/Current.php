<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This view helper class adds active class if $action equals to URL action
 */
class Current extends AbstractHelper
{
  public function render(){
      $link = [
          '/favorites' => 'inside-page',
          '/contacts' => 'inside-page',
          '/about' => 'inside-page',
          '/flat/view' => 'header-smoll product_header',
          '/flat' => 'inside-page choce-p',
          '/commertial' => 'inside-page choce-p',
          '/map' => 'inside-page',
          '/complex/view' => 'header-smoll'
      ];

      $action_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      if (ctype_digit(substr($action_url, -1))) {
          $pos = strrpos($action_url, '/');
          $str = substr($action_url, 0, $pos);
      } else $str = $action_url;

    if (isset($link[$str]))
        return $link[$str];
    else return "";
  }
}