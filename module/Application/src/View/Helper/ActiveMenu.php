<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This view helper class adds active class if $action equals to URL action
 */
class ActiveMenu extends AbstractHelper
{
    public function render($action)
    {
        $action_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (ctype_digit(substr($action_url, -1))) {
            $pos = strrpos($action_url, '/');
            $str = substr($action_url, 0, $pos);
            $pos = strrpos($str, '/');
            $str = substr($str, 0, $pos);
        } else $str = $action_url;

        if ("/" . $action == $str)
            return " class=\"active\"";
        else
            return "";
    }
}