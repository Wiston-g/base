<?php

/*
Plugin Name: Base
Plugin URI: https://wisdising.com 
Description: La descripcion 
Version: 0.0.1
Requires at least: 6.5.2
Requires PHP: 8.2.12
Author: Wiston Jair Gonzalez
Author URl: https://wisdising.com 
License: MIT

*/


if (!defined('ABSPATH')) exit;

define("BASE_FILE", __FILE__); //Este archivo 
define("BASE_PLUGIN_DIR", plugin_dir_path(BASE_FILE)); // Devuelve hasta la carpeta plugin
define("BASE_PLUGIN_URL", plugin_dir_url(BASE_FILE));
define("BASE_PLUGIN_NAME", "BASE");
define("BASE_QUANTITY_ELEMENT", 12);

require_once BASE_PLUGIN_DIR . "/admin/main.php";
register_activation_hook(BASE_FILE, array("main", 'Active'));
register_deactivation_hook(BASE_FILE, array("main", 'Desactive'));


add_action('admin_menu', 'crear_menu');

function crear_menu()
{
  add_menu_page(
    'Stock', //titulo de la pagina
    'Stock Menu', //Titulo del menu
    'manage_options', //Quirn lo puede ver
    plugin_dir_path(__FILE__) . 'admin/stock_list.php', //slug
    null, //funcion que se llama
    plugin_dir_url(__FILE__) . 'admin/img/icon.svg', //imagen
    '1', //en que posicion del menu estara
  );
}

function EnqueueBootstrap($hook)
{
  if ($hook != 'base/admin/stock_list.php') {
    return;
  }
  wp_enqueue_script('bootstrapJS', plugins_url('admin/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
  wp_enqueue_style('bootstrapCSS', plugins_url('admin/bootstrap/css/bootstrap.min.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'EnqueueBootstrap');

function EnqueueStockJS($hook)
{
  if ($hook != 'base/admin/stock_list.php') {
    return;
  }
  wp_enqueue_script('StockJS', plugins_url('admin/js/stock_list.js', __FILE__), array('jquery'));
}

add_action('admin_enqueue_scripts', 'EnqueueStockJS');
