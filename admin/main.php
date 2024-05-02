<?php

class Main
{
  static function Active()
  {
    require_once plugin_dir_path(BASE_FILE) . 'Database/Tables/Table.php';
    new Table();
  }
  static function Desactive()
  {
  }
}
