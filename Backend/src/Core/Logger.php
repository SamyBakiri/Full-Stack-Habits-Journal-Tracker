<?php
namespace App\Core;

class Logger {
    private static $logFile;

    public static function init($filePath = null) {
        // Default location → HABIT-TRACKER-V2/storage/logs/app.log
        if ($filePath === null) {
            $filePath = __DIR__ . '/../../storage/logs/app.log';
        }

        self::$logFile = $filePath;

        // Make sure the logs folder exists
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    public static function log($level, $message, $context = []) {
        if (!self::$logFile) {
            self::init(); // Initialize with default path if not set
        }

        // Format date and log message
        $time = date("Y-m-d H:i:s");
        $formatted = "[$time] [$level] $message";

        // If there's extra data, add it as JSON
        if (!empty($context)) {
            $formatted .= ' | ' . json_encode($context);
        }

        // Append to file
        file_put_contents(self::$logFile, $formatted . PHP_EOL, FILE_APPEND);
    }

    public static function info($message, $context = []) {
        self::log("INFO", $message, $context);
    }

    public static function warning($message, $context = []) {
        self::log("WARNING", $message, $context);
    }

    public static function error($message, $context = []) {
        self::log("ERROR", $message, $context);
    }
}
