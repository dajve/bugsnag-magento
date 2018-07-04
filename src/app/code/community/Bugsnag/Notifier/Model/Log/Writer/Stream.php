<?php
class Bugsnag_Notifier_Model_Log_Writer_Stream extends Zend_Log_Writer_Stream
{
    /**
     * @param $event
     */
    protected function _write($event)
    {
        $notifier = new Bugsnag_Notifier_Model_Observer();

        $severity = 'info';
        switch ($event['priority']) {
            case Zend_Log::EMERG:
            case Zend_Log::ALERT:
            case Zend_Log::CRIT:
                $severity = 'fatal';
                break;

            case Zend_Log::ERR:
                $severity = 'error';
                break;

            case Zend_Log::WARN:
                $severity = 'warning';
                break;

            default :
                $severity = 'info';
                break;
        }

        $notifier->fireException($event['message'], $severity);

        parent::_write($event);
    }
}