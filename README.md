# Anekdotes Logger 

[![Latest Stable Version](https://poser.pugx.org/anekdotes/logger/v/stable)](https://packagist.org/packages/anekdotes/logger)
[![Build Status](https://travis-ci.org/anekdotes/logger.svg?branch=master)](https://travis-ci.org/anekdotes/logger)
[![codecov.io](https://codecov.io/github/anekdotes/logger/coverage.svg)](https://codecov.io/github/anekdotes/logger?branch=master)
[![StyleCI](https://styleci.io/repos/57247052/shield?style=flat)](https://styleci.io/repos/57247052)
[![License](https://poser.pugx.org/anekdotes/logger/license)](https://packagist.org/packages/anekdotes/logger)
[![Total Downloads](https://poser.pugx.org/anekdotes/logger/downloads)](https://packagist.org/packages/anekdotes/logger)

A library that provides an easy way to upload files to the server simply by using configurations.

## Installation

Install via composer into your project:

    composer require anekdotes/logger

## Basic Usage

To use the logger, call its namespace and build a context array.

    use Anekdotes\Logger\Log;
    Log::info(array("message" => "toaster","user_identification" => "4N3K");

## Logging Drivers

The system logs to the PHP console by default. Setting a different driver will change its behavior

### File Driver

To log to files, a FileDriver must be set. 

    use Anekdotes\Logger\Log;
    use Anekdotes\Logger\Drivers\FileDriver;
    //Set Driver and use it
    Log::setDriver(new FileDriver('logname','tmp/logs/toaster.log');
    Log::info(array("message" => "toaster","user_identification" => "4N3K");

### Console Driver

Logs a file to the PHP Console. Used by default, but this can be used if another driver was previously set

    use Anekdotes\Logger\Log;
    use Anekdotes\Logger\Drivers\FileDriver;
    //Set Driver and use it
    Log::setDriver(new ConsoleDriver()); 
    Log::info(array("message" => "toaster","user_identification" => "4N3K");

