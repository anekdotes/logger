<?php

/*
 * This file is part of the Logger package.
 *
 * (c) Anekdotes Communication inc. <info@anekdotes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests;

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

    //Test Critical + Error Handler crashes. Try to log with Drivers not having handlers set.
    public function testEmptyHandlers()
    {
        Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
        Log::critical(['test' => 'data', 'me' => 'you']);
        Log::error(['test' => 'data', 'me' => 'you']);
        $this->assertTrue(true);
        unlink('tmp/test.log');
    }

    //Tests logging an info message
    public function testLogInfo()
    {
        //Setup Data
        Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
        $testData = ['date' => date('Y-m-d H:i:s', time()), 'level' => 'INFO',  'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN', 'test' => 'data', 'me' => 'you'];
        //Run Function
        Log::info(['test' => 'data', 'me' => 'you']);
        //Test Logging
        $file = fopen('tmp/test.log', 'r');
        $value = fread($file, filesize('tmp/test.log'));
        fclose($file);
        unlink('tmp/test.log');
        $this->assertEquals($value, json_encode($testData)."\n");
    }

    //Tests logging an info message. Also tests the Error handler
    public function testLogError()
    {
        //Setup Data
        Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
        $testData = ['date' => date('Y-m-d H:i:s', time()), 'level' => 'ERROR', 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN',  'test' => 'data', 'me' => 'you'];
        //Setup Error Handler
        $toaster = 'Not Result';
        Log::setErrorHandler(function ($data) use (&$toaster) {
            $toaster = $data;
        });
        //Run Function
        Log::error(['test' => 'data', 'me' => 'you']);
        //Test Error Handler
        $this->assertEquals($toaster, json_encode($testData));
        //Test Logging
        $file = fopen('tmp/test.log', 'r');
        $value = fread($file, filesize('tmp/test.log'));
        fclose($file);
        unlink('tmp/test.log');
        $this->assertEquals($value, json_encode($testData)."\n");
    }

    //Tests logging an info message
    public function testLogWarning()
    {
        //Setup Data
        Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
        $testData = ['date' => date('Y-m-d H:i:s', time()), 'level' => 'WARNING', 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN',  'test' => 'data', 'me' => 'you'];
        //Run Function
        Log::warn(['test' => 'data', 'me' => 'you']);
        //Test Logging
        $file = fopen('tmp/test.log', 'r');
        $value = fread($file, filesize('tmp/test.log'));
        fclose($file);
        unlink('tmp/test.log');
        $this->assertEquals($value, json_encode($testData)."\n");
    }

    //Tests logging an info message
    public function testLogSuccess()
    {
        //Setup Data
        Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
        $testData = ['date' => date('Y-m-d H:i:s', time()), 'level' => 'SUCCESS', 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN',  'test' => 'data', 'me' => 'you'];
        //Run Function
        Log::success(['test' => 'data', 'me' => 'you']);
        //Test Logging
        $file = fopen('tmp/test.log', 'r');
        $value = fread($file, filesize('tmp/test.log'));
        fclose($file);
        unlink('tmp/test.log');
        $this->assertEquals($value, json_encode($testData)."\n");
    }

    //Tests logging a critical message
    public function testLogCritical()
    {
        //Setup Data
        Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
        $testData = ['date' => date('Y-m-d H:i:s', time()), 'level' => 'CRITICAL', 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN',  'test' => 'data', 'me' => 'you'];
        //Setup Critical Handler
        $toaster = 'Not Result';
        Log::setCriticalHandler(function () use (&$toaster) {
            $toaster = 'Result';
        });
        //Run Function
        Log::critical(['test' => 'data', 'me' => 'you']);
        //Test Critical Handler
        $this->assertEquals($toaster, 'Result');
        //Test Logging
        $file = fopen('tmp/test.log', 'r');
        $value = fread($file, filesize('tmp/test.log'));
        fclose($file);
        unlink('tmp/test.log');
        $this->assertEquals($value, json_encode($testData)."\n");
    }

    //Test Console Driver (Which is default driver)
    //Note : As it is impossible to retrieve data from the stdout/stderr console, the only thing tested here is that the code does not crash. This does not test the actual behavior
    public function testConsoleDriver()
    {
        Log::error([]);
    }

    public function testwithNoHandler()
    {
        //Setup Data
        Log::setDriver(new FileDriver('Toaster', 'tmp/test.log'));
        $testData = ['date' => date('Y-m-d H:i:s', time()), 'level' => 'CRITICAL', 'remote_addr' => 'REMOTE_ADDR_UNKNOWN', 'request_uri' => 'REQUEST_URI_UNKNOWN',  'test' => 'data', 'me' => 'you'];
        //Run Function
        Log::critical(['test' => 'data', 'me' => 'you']);
        //Test Logging
        $file = fopen('tmp/test.log', 'r');
        $value = fread($file, filesize('tmp/test.log'));
        fclose($file);
        unlink('tmp/test.log');
        $this->assertEquals($value, json_encode($testData)."\n");
    }
}
