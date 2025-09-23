<?php
namespace App\Core;

use Helper\Response;
use Throwable;

class ErrorHandler {
    public static function register() {
        // Register logger first
        Logger::init();
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    // Warnings
    public static function handleError($severity, $message, $file, $line) {
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }

    public static function handleException(Throwable $e) {
        // Log the exception
        Logger::error($e->getMessage(), [
            "file" => $e->getFile(),
            "line" => $e->getLine(),
            "trace" => $e->getTraceAsString()
        ]);

        // Return clean JSON response
        Response::jsonResponse(500, [
            "status" => "error",
            "message" => "Internal Server Error"
        ]);
    }
    // Fatal errors
    public static function handleShutdown() {  
        $error = error_get_last();
        if ($error !== null) {
            Logger::error("Fatal Error: {$error['message']}", [
                "file" => $error['file'],
                "line" => $error['line']
            ]);

            Response::jsonResponse(500, [
                "status" => "error",
                "message" => "Something went wrong. Please try again later."
            ]);
        }
    }
}
