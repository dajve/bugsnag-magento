<?php
class Bugsnag_Notifier_Model_Log_Writer_Stream extends Zend_Log_Writer_Stream
{
    /**
     * @param $event
     */
    protected function _write($event)
    {
        $logNativeLogs = Mage::getStoreConfigFlag('dev/Bugsnag_Notifier/native_logs');
        $logToFiles = !$logNativeLogs || ($logNativeLogs && Mage::getStoreConfigFlag('dev/Bugsnag_Notifier/logs_to_files'));

        if ($logNativeLogs) {
            $notifier = new Bugsnag_Notifier_Model_Observer();

            $severity = 'info';
            switch ($event['priority']) {
                case Zend_Log::EMERG:
                case Zend_Log::ALERT:
                case Zend_Log::CRIT:
                case Zend_Log::ERR:
                    $severity = 'error';
                    break;

                case Zend_Log::WARN:
                    $severity = 'warning';
                    break;
            }

            if (false === $notifier->sendCustomMessage($event['message'], $severity)) {
                $logToFiles = true;
            }
        }

        if ($logToFiles) {
            parent::_write($event);
        }
    }
}