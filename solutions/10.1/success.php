<?php

session_start();

echo "Hallo," . ucwords($_SESSION['user']) . "!";
echo "Vielen Dank für deine Registrierung!";

session_destroy();
