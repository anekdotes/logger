<?php
/*
 * This file is part of the Logger package.
 *
 * (c) Anekdotes Communication inc. <info@anekdotes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Anekdotes\Logger;

use Anekdotes\Logger;

/**
 * Static implementation of the Logger.
 */
class Log
{
  /**
   * The Driver used to write the Log messages.
   *
   * @var Drivers\DriverInterface
   */
  private static $driver;


  /**
   * Contains a function to be called on Error messages
   *
   * @var \Closure
   */
  private static $OnErrorHandler;

  /**
   * Contains a function to be called on Critical messages
   *
   * @var \Closure
   */
  private static $OnCriticalHandler;

  /**
   * Sets the Logger's driver.
   *
   * @param Drivers\DriverInterface  $driver  The driver to set.
   */
  public static function setDriver($driver)
  {
      self::$driver = $driver;
  }

  /**
   * Obtain the current driver used for logging.
   *
   * @return  Drivers\DriverInterface  The driver used for logging
   */
  public static function getDriver()
  {
      return self::$driver;
  }

  /**
   * Set the function to be executed when an error message is logged
   *
   * @param  \Closure  $handler  Function to be set
   */
  public static function setErrorHandler($handler){
    self::$OnErrorHandler = $handler;
  }

  /**
   * Set the function to be executed when a critical message is logged
   *
   * @param  \Closure  $handler  Function to be set
   */
  public static function setCriticalHandler($handler){
    self::$OnCriticalHandler = $handler;
  }

  /**
   * Constant representing the level to display in WARN log messages.
   */
  const WARN = 'WARNING';
  /**
   * Constant representing the level to display in INFO log messages.
   */
  const INFO = 'INFO';
  /**
   * Constant representing the level to display in ERROR log messages.
   */
  const ERROR = 'ERROR';
  /**
   * Constant representing the level to display in SUCCESS log messages.
   */
  const SUCCESS = 'SUCCESS';
  /**
   * Constant representing the level to display in CRITICAL log messages.
   */
  const CRITICAL = 'CRITICAL';

  /**
   * Generic function to write and store a basic log message.
   *
   * Exemple use of the function:
   *
   * Log::log("Toaster","INFO",array("nb_toasts" => 2)), called on the page /url will return the following message:
   *
   * [2016-03-28 10:13:36] sitebase.WARNING: 2016-03-28 10:13:36 | INFO | 127.0.0.1 	/url : Toaster 		nb_toasts	=> 2  [] []
   *
   * @param  string          $message  Contains the basic message included in the log.
   * @param  mixed           $level    The intensity level of the message. Generally uses the constant levels {WARN, INFO, ERROR, SUCCESS}, but can also be a custom string level.
   * @param  \string[string] $context  An array containing key->value pairs to be stored with the log message.
   */
  public static function log($level, $context = [])
  {
      if (self::$driver === null) {
          $driver = new ConsoleDriver();
      } else {
          $driver = self::$driver;
      }

      $remote_addr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'REMOTE_ADDR_UNKNOWN';
      $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'REQUEST_URI_UNKNOWN';

    // Format the date and time
    $date = date('Y-m-d H:i:s', time());

    // Build message
    $finalMessage = ['date' => $date, 'level' => $level, 'remote_addr' => $remote_addr, 'request_uri' => $request_uri];
      if (is_array($context)) {
          foreach ($context as $key => $value) {
              $finalMessage[$key] = $value;
          }
      }
      $finalMessage = json_encode($finalMessage);

      self::$driver->write($finalMessage, $level == self::ERROR);
  }

  /**
   * Write an error log message.
   *
   * @param  string          $message  Contains the basic message included in the log.
   * @param  \string[string]  $context  An array containing key->value pairs to be stored with the log message.
   */
  public static function error($context = [])
  {
      self::log(self::ERROR, $context);
      if(self::$OnErrorHandler InstanceOf \Closure){
        call_user_func(self::$OnErrorHandler);
      }
  }

  /**
   * Write a warning log message.
   *
   * @param  string           $message  Contains the basic message included in the log.
   * @param  \string[string]  $context  An array containing key->value pairs to be stored with the log message.
   */
  public static function warn($context = [])
  {
      self::log(self::WARN, $context);
  }

  /**
   * Write an info log message.
   *
   * @param  string           $message  Contains the basic message included in the log.
   * @param  \string[string]  $context  An array containing key->value pairs to be stored with the log message.
   */
  public static function info($context = [])
  {
      self::log(self::INFO, $context);
  }

  /**
   * Write a success log message.
   *
   * @param  string           $message  Contains the basic message included in the log.
   * @param  \string[string]  $context  An array containing key->value pairs to be stored with the log message.
   */
  public static function success($context = [])
  {
      self::log(self::SUCCESS, $context);
  }

  /**
   * Write a critical log message.
   *
   * @param  string           $message  Contains the basic message included in the log.
   * @param  \string[string]  $context  An array containing key->value pairs to be stored with the log message.
   */
  public static function critical($context = [])
  {
      self::log(self::CRITICAL, $context);
      if(self::$OnCriticalHandler InstanceOf \Closure){
        call_user_func(self::$OnCriticalHandler);
      }
  }
}
