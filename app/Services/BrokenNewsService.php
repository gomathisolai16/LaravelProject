<?php

namespace App\Services;

use App\Mail\BrokenNewsAlert;
use Illuminate\Support\Facades\Mail;
use Log;

/**
 * Class BrokenNewsService
 * @package App\Services
 */
class BrokenNewsService {
  /**
   * Notify by email pre-configured recipient with
   * attached broken XML file
   * 
   * @param string $file
   * @param string $name
   */
  public static function notify($file, $name, $isS3Storage = false) {
    $recipient = config('app.broken_news_recipient');
    $response = Mail::to($recipient)->send(new BrokenNewsAlert($file, $name, $isS3Storage));
    if ($response) {
      Log::info('Notification email for broken news ' . $name . ' was sent successfully.');
    } else {
      Log::error("Couldn't send notification email for broken news " . $name . '.');
    }
  }
}
