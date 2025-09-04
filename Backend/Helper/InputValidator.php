<?php
namespace Helper;

use Helper\Response;

class InputValidator {
    public static function validate($data, $rules) {
        $validated = [];

        foreach ($rules as $field => $type) {
            // Check if field exists & is not empty
            if (!array_key_exists($field, $data) || $data[$field] === '' || $data[$field] === null) {
                Response::jsonResponse(400, [
                    "status" => "error",
                    "message" => "$field is required"
                ]);
            }

            // Clean value
            $value = is_string($data[$field]) ? trim($data[$field]) : $data[$field];

            switch ($type) {
                case "int":
                    self::isInteger($field, $value);
                    $validated[$field] = (int) $value;
                    break;

                case "string":
                    self::isString($field, $value);
                    $validated[$field] = $value;
                    break;
                
                case "email":
                    self::isValidEmail($field, $value);
                    $validated[$field] = strtolower($value); 
                    break;

                case "date":
                    self::isValidDate($field, $value);
                    $validated[$field] = $value;
                    break;

                case "time":
                    self::isValidTime($field, $value);
                    $validated[$field] = $value;
                    break;

                default:
                    $validated[$field] = $value;
            }
        }

        return $validated;
    }

    private static function isString($field, $value) {
        if (!is_string($value) || trim($value) === '') {
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "$field must be a non-empty string"
            ]);
        }
    }

    private static function isInteger($field, $value) {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "$field must be an integer"
            ]);
        }
    }

    private static function isValidEmail($field, $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "$field must be a valid email address"
            ]);
        }
    }

    private static function isValidDate($field, $value) {
        $date = \DateTime::createFromFormat('Y-m-d', $value);
        if (!($date && $date->format('Y-m-d') === $value)) {
            Response::jsonResponse(400, [
                "status" => "error",
                "message" => "$field must be a valid date in YYYY-MM-DD"
            ]);
        }
    }

    private static function isValidTime($field, $value) {
    $time = \DateTime::createFromFormat('H:i:s', $value);
    if (!($time && $time->format('H:i:s') === $value)) {
        Response::jsonResponse(400, [
            "status" => "error",
            "message" => "$field must be a valid time in HH:MM:SS (24-hour format)"
        ]);
    }
}

}
