<?php

use Ravand\Core\Router\AdminRouter as Router;
use Ravand\Controllers\ControlPanelController;

$icon = RAVAND_URL . "/assets/svg/admin-menu-icon.svg";

add_menu_page(
    __("Ravand Admin Panel", "ravand"),
    __("Ravand", "ravand"),
    "manage_options",
    "ravand",
    Router::makeCallback(ControlPanelController::class,"view",[
        // Additional Middlewares
    ],"control-panel"),
    $icon,
    55
);

