<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

class VerbListener {
  /**
   * @param GetResponseEvent $event
   */
  public function onKernelRequest(GetResponseEvent $event) {
    $request = $event->getRequest();

    if (HttpKernel::MASTER_REQUEST === $event->getRequestType() 
      && $request->getMethod() === 'GET') {
        
      $realMethod = $request->query->get('_method');  
      
      if (in_array($realMethod, array('LINK'))) {
        $request->setMethod($realMethod);
      }
    }
  }
}
