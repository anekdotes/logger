# Anekdotes Logger 

[![Latest Stable Version](https://poser.pugx.org/anekdotes/logger/v/stable)](https://packagist.org/packages/anekdotes/logger)
[![Build Status](https://travis-ci.org/anekdotes/logger.svg?branch=master)](https://travis-ci.org/anekdotes/logger)
[![codecov.io](https://codecov.io/github/anekdotes/logger/coverage.svg)](https://codecov.io/github/anekdotes/logger?branch=master)
[![StyleCI](https://styleci.io/repos/57247052/shield?style=flat)](https://styleci.io/repos/57247052)
[![License](https://poser.pugx.org/anekdotes/logger/license)](https://packagist.org/packages/anekdotes/logger)
[![Total Downloads](https://poser.pugx.org/anekdotes/logger/downloads)](https://packagist.org/packages/anekdotes/logger)

Allows logging of JSON messages, to easily be integrated in a static class.

## Installation

Install via composer into your project:

    composer require anekdotes/logger

## Basic Usage

To use the logger, call its namespace and build a context array.

    use Anekdotes\Logger\Log;
    Log::info(["message" => "toaster","user_identification" => "4N3K"]);

## Logging Drivers

The system logs to the PHP console by default. Setting a different driver will change its behavior

### File Driver

To log to files, a FileDriver must be set. 

    use Anekdotes\Logger\Log;
    use Anekdotes\Logger\Drivers\FileDriver;
    //Set Driver and use it
    Log::setDriver(new FileDriver('logname','tmp/logs/toaster.log'));
    Log::info(["message" => "toaster","user_identification" => "4N3K"]);

### Console Driver

Logs a file to the PHP Console. Used by default, but this can be used if another driver was previously set

    use Anekdotes\Logger\Log;
    use Anekdotes\Logger\Drivers\FileDriver;
    //Set Driver and use it
    Log::setDriver(new ConsoleDriver()); 
    Log::info(["message" => "toaster","user_identification" => "4N3K"]);

## Handlers

You can use handlers to have the logger run additional tasks on error and critical logs. Handlers are Anonymous functions that are set by using their accessors. 

    $data = ["data" => "data"];
    $functionThatLogsIntoDatabase = function () use ($data) { //Log $data in the database };
    Log::setErrorHandler($functionThatLogsIntoDatabase);
    Log::error($data);

The handlers can also use the data that will be provided to the logfile and send it to the Closure.

    $data = ["data" => "data"];
    $functionThatLogsIntoDatabase = function ($LogData) { //Log $LogData in the DB. Note the LogData is the exact output that will be saved to a file. It is in JSON Format. }
    Log::setCriticalHandler($functionThatLogsIntoDatabase);
    Log::critical($data);

## Logging Levels

You can use the following levels of logging as calls:

    Log::info([]);
    Log::success([]);
    Log::warn([]);
    Log::error([]);
    Log::critical([]);

