<?php

use App\Services\FlashService;

if (! function_exists('flash')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null  $message
     * @param  string  $level
     * @return App\Services\FlashNotifierService
     */
    function flash($message = null, $level = 'info')
    {
        $notifier = new FlashService();

        if (! is_null($message)) {
            return $notifier->message($message, $level);
        }

        return $notifier;
    }
}
