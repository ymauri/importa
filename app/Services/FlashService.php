<?php

namespace App\Services;

class FlashService
{

    public $msg;
    public $level;

    function __construct()
    {
        $this->msg = "";
        $this->level = 'info';
    }

    public function info($message = null)
    {
        return $this->message($message, 'info');
    }

    public function success($message = null)
    {
        return $this->message($message, 'success');
    }

    public function error($message = null)
    {
        return $this->message($message, 'danger');
    }

    public function warning($message = null)
    {
        return $this->message($message, 'warning');
    }

    public function message($message = null, $level = null)
    {
        session()->forget(['flash_message_notification', 'flash_level_notification']);
        if (!is_null($message))
            $this->msg = $message;
        $this->level = $level;
        return $this->flash();
    }

    protected function flash()
    {
        session(['flash_message_notification' => $this->msg]);
        session(['flash_level_notification' => $this->level]);
        return $this;
    }
}

