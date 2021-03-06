# Anekdotes Logger 

[![Latest Stable Version](https://poser.pugx.org/anekdotes/logger/v/stable)](https://packagist.org/packages/anekdotes/logger)
[![Build Status](https://travis-ci.org/anekdotes/logger.svg?branch=master)](https://travis-ci.org/anekdotes/logger)
[![License](https://poser.pugx.org/anekdotes/logger/license)](https://packagist.org/packages/anekdotes/logger)
[![Total Downloads](https://poser.pugx.org/anekdotes/logger/downloads)](https://packagist.org/packages/anekdotes/logger)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/63e2ec38eec4436fa92030393ede8a6b)](https://www.codacy.com/app/steve-gagnev4si/logger?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=anekdotes/logger&amp;utm_campaign=Badge_Grade)

Allows logging of JSON messages, to easily be integrated in a static class.

## Installation

Install via composer into your project:

    composer require anekdotes/logger

## Basic Usage

To use the logger, call its namespace and build a context array.

```php
    use Anekdotes\Logger\Log;
    Log::info(["message" => "toaster","user_identification" => "4N3K"]);
```

## Logging Drivers

The system logs to the PHP console by default. Setting a different driver will change its behavior

### File Driver

To log to files, a FileDriver must be set. 

```php
    use Anekdotes\Logger\Log;
    use Anekdotes\Logger\Drivers\FileDriver;
    //Set Driver and use it
    Log::setDriver(new FileDriver('logname','tmp/logs/toaster.log'));
    Log::info(["message" => "toaster","user_identification" => "4N3K"]);
```

### Console Driver

Logs a file to the PHP Console. Used by default, but this can be used if another driver was previously set

```php
    use Anekdotes\Logger\Log;
    use Anekdotes\Logger\Drivers\FileDriver;
    //Set Driver and use it
    Log::setDriver(new ConsoleDriver()); 
    Log::info(["message" => "toaster","user_identification" => "4N3K"]);
```

## Handlers

You can use handlers to have the logger run additional tasks on error and critical logs. Handlers are Anonymous functions that are set by using their accessors. 

```php
    $data = ["data" => "data"];
    $functionThatLogsIntoDatabase = function () use ($data) { 
      //Log $data in the database 
    };
    Log::setErrorHandler($functionThatLogsIntoDatabase);
    Log::error($data);
```

The handlers can also use the data that will be provided to the logfile and send it to the Closure.

```php
    $data = ["data" => "data"];
    $functionThatLogsIntoDatabase = function ($LogData) {
      //Log $LogData in the DB. Note the LogData is the exact output that will be saved to a file. It is in JSON Format. 
    };
    Log::setCriticalHandler($functionThatLogsIntoDatabase);
    Log::critical($data);
```

## Logging Levels

You can use the following levels of logging as calls:

```php
    Log::info([]);
    Log::success([]);
    Log::warn([]);
    Log::error([]);
    Log::critical([]);
```
