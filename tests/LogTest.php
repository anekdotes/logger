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
}
