<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BrokenNews
 * @package App\Mail
 */
class BrokenNewsAlert extends Mailable {
  use Queueable, SerializesModels;

  public $file;
  public $fileName;
  public $isS3Storage;

  /**
   * Constructor function
   * 
   * @param string $file
   * @param string $fileName
   */
  public function __construct($file, $fileName, $isS3Storage) {
    $this->file = $file;
    $this->fileName = $fileName;
    $this->isS3Storage = $isS3Storage;
  }

  public function build() {
    $emailBuilder = $this->from(env('MAIL_EMAIL'))
      ->subject('NewsConnect Broken News Alert')
      ->view('partials.mail._brokenNewsNotify');
    if ($this->isS3Storage) {
      $emailBuilder->attachData($this->file, $this->fileName, [
        'mime' => 'application/xml'
      ]);
    } else {
      $emailBuilder->attach($this->file, [
        'as' => $this->fileName
      ]);
    }
    return $emailBuilder;
  }
}
