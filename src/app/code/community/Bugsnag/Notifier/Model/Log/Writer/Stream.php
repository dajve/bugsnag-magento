<?php
class Bugsnag_Notifier_Model_Log_Writer_Stream extends Zend_Log_Writer_Stream
{
  protected function _write($event)
  {
    if(Mage::getStoreConfig("dev/Bugsnag_Notifier/native_logs")) {

      if ($event['priority'] <= Zend_Log::WARN) {
        Mage::helper('notifier')->sendMessage($event);
      }

    }

  }
}