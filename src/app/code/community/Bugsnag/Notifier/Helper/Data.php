<?php
class Bugsnag_Notifier_Helper_Data extends Mage_Core_Helper_Abstract
{

  public function sendMessage($event)
  {
    $notifier = new Bugsnag_Notifier_Model_Observer();
    $notifier->fireException($event['message']);
  }

}
