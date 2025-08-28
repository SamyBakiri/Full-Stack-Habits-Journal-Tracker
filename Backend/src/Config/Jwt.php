<?php
return[
    "secret" => $_ENV["JWT_SECRET"],
    "algo" => $_ENV["JWT_ALGO"],
    "expiry" => $_ENV["JWT_EXPIRY"]
];