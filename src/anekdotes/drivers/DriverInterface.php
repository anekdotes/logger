<?php
/*
 * This file is part of the Logger package.
 *
 * (c) Anekdotes Communication inc. <info@anekdotes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Anekdotes\Logger\Drivers;

/**
 * Interface that outputs log messages in a CLI (console line Interface)
 */
class ConsoleDriver implements DriverInterface {

  /**
   * Function that writes the log message.
   * Writes the message in the console
   * @param  string   $message  Message that needs to be output in the console
   * @param  boolean  $error    If the log message is considered an error, for logging purposes
   */
  public function write($message, $error = false) {
    $stream = fopen('php://' . ($error ? 'stderr' : 'stdout'), 'a');
    fwrite($stream, $message);
    fclose($stream);
  }

}
