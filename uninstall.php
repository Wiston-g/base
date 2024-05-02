<?php
if (!defined('WP_UNINSTALL_PLUGIN')) die();
function uninstall()
{
}
register_deactivation_hook(__FILE__, 'uninstall');
