<?php
require 'middleware/middleware.php';

$user = Middleware::verifyToken();

echo json_encode($user);
