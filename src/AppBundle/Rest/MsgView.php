<?php

namespace AppBundle\Rest;

use FOS\RestBundle\View\View;

class MsgView extends View {
  private $msg;
  
  /**
   * @return string
   */
  function getMsg() {
    return $this->msg;
  }
  
  /**
   * @param string $msg
   *
   * @return MsgView
   */
  function setMsg($msg) {
    $this->msg = $msg;
    
    return $this;
  }
}
