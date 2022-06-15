<?php

define("RAVAND", true);

// Directories
define("RAVAND_ROOT", dirname(__DIR__));
define("RAVAND_ASSETS", RAVAND_ROOT . "./assets");
define("RAVAND_PLUGIN_FILE", RAVAND_ROOT . "/index.php");
define("RAVAND_URL", plugin_dir_url(RAVAND_PLUGIN_FILE));
define("RAVAND_BASE", plugin_basename(RAVAND_ROOT));

// API Options
define("RAVAND_API_PREFIX", "ravand");
define("RAVAND_API_VERSION", "v1");
