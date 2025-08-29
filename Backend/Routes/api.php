<?php

use App\Controllers\AuthController;
use App\Core\Router;
use App\Controllers\UserController;
use App\Controllers\Habit_logsController;
use App\Controllers\HabitController;
use App\Controllers\JournalController;


$router = new Router();

//Authentication api endpoints
$router->post("/auth/login", [AuthController::class, "login"], false);
$router->post("/auth/register", [AuthController::class, "register"], false);

//user api endpoints
// $router->get("/users", [UserController::class, "index"]);
$router->get("/users", [UserController::class, "show"]);
// $router->post("/users", [UserController::class, "store"]);
$router->put("/users", [UserController::class, "update"]);
$router->delete("/users", [UserController::class, "destroy"]);

//habit api endpoints 
$router->get("/habits", [HabitController::class, "allByUser"]);
$router->get("/habits/{id}", [HabitController::class, "show"]);
$router->post("/habits",[HabitController::class, "store"]);
$router->put("/habits/{id}", [HabitController::class, "update"]);
$router->delete("/habits/{id}", [HabitController::class, "destroy"]);

//habit_logs api endpoints
// $router->get("/habitlogs", [Habit_logsController::class, "index"]);
$router->get("/habits/{id}/habitlog", [Habit_logsController::class, "show"]);
$router->get("/habits/{id}/habitlogs", [Habit_logsController::class, "allByHabit"]);
$router->post("/habits/{id}/habitlogs", [Habit_logsController::class, "store"]);
$router->put("/habits/{id}/habitlogs", [Habit_logsController::class, "update"]);
$router->delete("/habits/{id}/habitlogs", [Habit_logsController::class, "destroy"]);

//journal api endpoints
$router->get("/journals", [JournalController::class, "allByUser"]);
$router->get("/journal", [JournalController::class, "show"]);
$router->post("/journals", [JournalController::class, "store"]);
$router->put("/journals", [JournalController::class, "update"]);
$router->delete("/journals", [JournalController::class, "destroy"]);


