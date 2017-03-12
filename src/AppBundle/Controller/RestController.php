<?php

namespace AppBundle\Controller;

use AppBundle\Rest\MsgView;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

class RestController extends FOSRestController {  
  /**
   * @param object $data
   * @param number $statusCode
   *
   * @return MsgView
   */
  function view($data = null, $statusCode = null, array $headers = array()) {
    return (new MsgView())->setData($data)->setStatusCode($statusCode);
  }
  
  /**
   * @param View $view
   *
   * @return Response
   */
  function handleView(View $view) {
    if ($view instanceof MsgView) {
      $originalData = $view->getData();
      $data = array(
        'data' => $originalData,
        'msg' => $view->getMsg()
      );
      
      $view->setData($data);
      $response = parent::handleView($view);
      $view->setData($originalData);
      
      return $response;
    }
    
    return parent::handleView($view);
  }
  
  /**
   * @param string $tplName
   * @param array $parameters
   *
   * @return string
   */
  function msg($tplName, $parameters = array()) {
    return call_user_func_array(
      'sprintf',
      array_merge(
        array($this->get('translator')->trans($tplName)), 
        $parameters
      )
    );
  }
}
