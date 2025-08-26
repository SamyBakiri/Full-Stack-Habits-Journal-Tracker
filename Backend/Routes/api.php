<?php

use Core\Router;
use App\Controllers\UserController;
use App\Controllers\Habit_logsController;
use App\Controllers\HabitController;
use App\Controllers\JournalController;


$router = new Router();

//user api endpoints
$router->get("/users", [UserController::class, "index"]);
$router->get("/users/{id}", [UserController::class, "show"]);
$router->post("/users", [UserController::class, "store"]);
$router->put("/users/{id}", [UserController::class, "update"]);
$router->delete("/users/{id}", [UserController::class, "destroy"]);

//habit api endpoints 
$router->get("/habits", [HabitController::class, "index"]);
$router->get("/habits/{id}", [HabitController::class, "show"]);
$router->get("/users/{id}/habits", [HabitController::class, "allByUser"]);
$router->post("/users/{id}/habits", [HabitController::class, "store"]);
$router->put("/habits/{id}", [HabitController::class, "update"]);
$router->delete("/habits/{id}", [HabitController::class, "destroy"]);

//habit_logs api endpoints
$router->get("/habitlogs", [Habit_logsController::class, "index"]);
$router->get("/habits/{id}/habitlog", [Habit_logsController::class, "show"]);
$router->get("/habits/{id}/habitlogs", [Habit_logsController::class, "allByHabit"]);
$router->post("/habits/{id}/habitlogs", [Habit_logsController::class, "store"]);
$router->put("/habits/{id}/habitlogs", [Habit_logsController::class, "update"]);
$router->delete("/habits/{id}/habitlogs", [Habit_logsController::class, "destroy"]);

//journal api endpoints
$router->get("/journals", [JournalController::class, "index"]);
$router->get("/users/{id}/journal", [JournalController::class, "show"]);
$router->get("/users/{id}/journals", [JournalController::class, "allByUser"]);
$router->post("/users/{id}/journals", [JournalController::class, "store"]);
$router->put("/users/{id}/journals", [JournalController::class, "update"]);
$router->delete("/users/{id}/journals", [JournalController::class, "destroy"]);


