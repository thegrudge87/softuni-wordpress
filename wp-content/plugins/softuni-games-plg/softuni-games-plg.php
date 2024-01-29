<?php

/**
 * Plugin Name:       SoftUni Games
 * Description:       A custom Plugin for the "WordPress for Developers – ноември 2023" course
 * Version:           0.1.0-beta
 * Requires at least: 5.9
 * Requires PHP:      7.3
 * Author:            Dimitar Marinov
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       softuni-games-plg
 * Domain Path:       /languages
 */

require 'includes/class-sup-games.php';
require 'includes/class-cpt-games.php';

use SUP_Games\SUP_Games as SUP_Games;

$plugin = new SUP_Games();