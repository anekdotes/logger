<?php

/*
 * This file is part of the Logger package.
 *
 * (c) Anekdotes Communication inc. <info@anekdotes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

use Anekdotes\Logger\Drivers\ConsoleDriver;
use Anekdotes\Logger\Drivers\FileDriver;
use Anekdotes\Logger\Log;
use PHPUnit_Framework_TestCase;

class LogTest extends PHPUnit_Framework_TestCase
{
    //Tests the instantion of Drivers
  public function testSetAndGetDriver()
  {
      $conDriver = new ConsoleDriver();
      Log::setDriver($conDriver);
      $this->assertEquals($conDriver, Log::getDriver());
  }

  //Tests logging an info message
  public function testLogInfo()
  {
      Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
      $testData = ['date' => date('Y-m-d H:i:s', time()), 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN', 'level' => 'INFO', 'test' => 'data', 'me' => 'you'];
      Log::info(['test' => 'data', 'me' => 'you']);
      $file = fopen('tmp/test.log', 'r');
      $value = fread($file, filesize('tmp/test.log'));
      fclose($file);
      unlink('tmp/test.log');
      $this->assertJsonStringEqualsJsonString($value, json_encode($testData));
  }

  //Tests logging an info message
  public function testLogError()
  {
      Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
      $testData = ['date' => date('Y-m-d H:i:s', time()), 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN', 'level' => 'ERROR', 'test' => 'data', 'me' => 'you'];
      Log::error(['test' => 'data', 'me' => 'you']);
      $file = fopen('tmp/test.log', 'r');
      $value = fread($file, filesize('tmp/test.log'));
      fclose($file);
      unlink('tmp/test.log');
      $this->assertJsonStringEqualsJsonString($value, json_encode($testData));
  }

  //Tests logging an info message
  public function testLogWarning()
  {
      Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
      $testData = ['date' => date('Y-m-d H:i:s', time()), 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN', 'level' => 'WARNING', 'test' => 'data', 'me' => 'you'];
      Log::warn(['test' => 'data', 'me' => 'you']);
      $file = fopen('tmp/test.log', 'r');
      $value = fread($file, filesize('tmp/test.log'));
      fclose($file);
      unlink('tmp/test.log');
      $this->assertJsonStringEqualsJsonString($value, json_encode($testData));
  }

  //Tests logging an info message
  public function testLogSuccess()
  {
      Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
      $testData = ['date' => date('Y-m-d H:i:s', time()), 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN', 'level' => 'SUCCESS', 'test' => 'data', 'me' => 'you'];
      Log::success(['test' => 'data', 'me' => 'you']);
      $file = fopen('tmp/test.log', 'r');
      $value = fread($file, filesize('tmp/test.log'));
      fclose($file);
      unlink('tmp/test.log');
      $this->assertJsonStringEqualsJsonString($value, json_encode($testData));
  }
}
