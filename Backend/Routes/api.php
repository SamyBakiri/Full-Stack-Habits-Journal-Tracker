<?php

use App\Controllers\AuthController;
use App\Core\Router;
use App\Controllers\UserController;
use App\Controllers\Habit_logsController;
use App\Controllers\HabitController;
use App\Controllers\JournalController;


$router = new Router();

//Authentication api endpoints
$router->post("/auth/login", [AuthController::class, "login"], false, [
    "Email" => "email",
    "Password" => "string"
]);
$router->post("/auth/register", [AuthController::class, "register"], false, [
    "Email" => "email",
    "Password" => "string",
    "FirstName" => "string",
    "LastName" => "string"
]);

//user api endpoints

$router->get("/users", [UserController::class, "show"]);
$router->put("/users", [UserController::class, "update"], true , [
    "Email" => "email",
    "Password" => "string",
    "FirstName" => "string",
    "LastName" => "string"
]);
$router->delete("/users", [UserController::class, "destroy"]);

//habit api endpoints 
$router->get("/habits", [HabitController::class, "allByUser"]);
$router->get("/habits/{id}", [HabitController::class, "show"]);
$router->post("/habits",[HabitController::class, "store"], true, [
    "Name" => "string",
    "Description" => "string",
    "Start_Date" => "date",
    "Start_Time" => "time",
    "End_Time" => "time",
    "Importance" => "string",
    "Frequency" =>  "int"

]);
$router->put("/habits/{id}", [HabitController::class, "update"], true, [
    "Name" => "string",
    "Description" => "string",
    "Start_Date" => "date",
    "Start_Time" => "time",
    "End_Time" => "time",
    "Importance" => "string",
    "Frequency" =>  "int"
]);
$router->delete("/habits/{id}", [HabitController::class, "destroy"]);

//habit_logs api endpoints
$router->get("/habits/{id}/habitlog", [Habit_logsController::class, "show"]);
$router->get("/habits/{id}/habitlogs", [Habit_logsController::class, "allByHabit"]);
$router->post("/habits/{id}/habitlogs", [Habit_logsController::class, "store"], true, [
    "Status" => "string",
    "Note" => "string",
    "Mood" => "string",
    "Date" => "date",
    "Time" => "time"
]);
$router->put("/habits/{id}/habitlogs", [Habit_logsController::class, "update"], true, [
    "Status" => "string",
    "Note" => "string",
    "Mood" => "string",
    "Date" => "date",
    "Time" => "time"
]);
$router->delete("/habits/{id}/habitlogs", [Habit_logsController::class, "destroy"]);

//journal api endpoints
$router->get("/journals", [JournalController::class, "allByUser"]);
$router->get("/journal", [JournalController::class, "show"]);
$router->post("/journals", [JournalController::class, "store"], true, [
    "Date" => "date",
    "Journal" => "string"
]);
$router->put("/journals", [JournalController::class, "update"], true, [
    "Date" => "date",
    "Journal" => "string"
]);
$router->delete("/journals", [JournalController::class, "destroy"]);


