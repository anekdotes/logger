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

use Monolog\Logger;

/**
 * Saves the Log message in a file system
 *
 * Currently uses Monolog as a file logger
 * @link https://github.com/Seldaek/monolog
 */
class FileDriver implements DriverInterface {

  /**
   * Monolog Object used to write log messages in files
   * @var \Monolog\Logger
   */
  protected $logger;

  /**
   * Instatiates the driver with its Monolog file Logger
   * @param \Monolog\Logger $logger Monolog File Logger
   */
  public function __construct(Logger $logger) {
    $this->logger = $logger;
  }

  /**
   * Uses the Monolog file Logger to write a log message in a file
   * @param  string   $message  Message that needs to be output
   * @param  boolean  $error    If the log message is considered an error, for logging purposes
   */
  public function write($message, $error = false) {
    if (!$error) {
      $this->logger->addWarning($message);
    } else {
      $this->logger->addError($message);
    }
  }

}
