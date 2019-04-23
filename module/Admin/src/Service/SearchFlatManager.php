<?php
namespace Admin\Service;

use Zend\Session\Container;
use Zend\Session\SessionManager;

/**
 * The SearchFlatManager service is responsible for saving/retrieving of search flat information
 */
class SearchFlatManager
{
  /**
   * Session manager.
   * @var Zend\Session\SessionManager
   */
  private $sessionManager;

  /**
   * Session manager.
   * @var Zend\Session\Container
   */
  private $sessionContainer;

  /**
   * Constructs the service.
   */
  public function __construct($sessionManager)
  {
    $this->sessionManager = $sessionManager;
    $this->sessionManager->rememberMe(60*60*24*30);
  }

  /**
   * init container here
   */
  public function init($searchForm = 'SearchForm'){
    $this->sessionContainer = new Container($searchForm, $this->sessionManager);
  }

  /**
   * save search form data to the session
   */
  public function saveSearch($formData)
  {
    if (!$this->sessionContainer) $this->init();

    $this->sessionContainer->formData = $formData;
  }

  /**
   * get search form data to the session
   * @return form data
   */
  public function getSearch($returnBack="/")
  {
    if (!$this->sessionContainer) $this->init();

    $this->sessionContainer->retrunBack = $returnBack;

    if(isset($this->sessionContainer->formData))
      return $this->sessionContainer->formData;
    else
      return array();
  }

  /**
   * get search form data to the session
   * @return form data
   */
  public function getReturnBack()
  {
    if (!$this->sessionContainer) $this->init();
    return $this->sessionContainer->retrunBack;
  }

  /**
   * reset fliter
   */
  public function resetSearch()
  {
    if (!$this->sessionContainer) $this->init();

    unset($this->sessionContainer->formData);
  }

}