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
 * Interface to be used by all Logging Drivers. Allows the logger to write its message in the desired driver.
 */
interface DriverInterface
{
    /**
   * Function that writes the log message.
   *
   * @param  string   $message  Message that needs to be output
   * @param  bool  $error    If the log message is considered an error, for logging purposes
   */
  public function write($message, $error = false);
}
