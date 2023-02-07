<?php
class View
{
  public static function render($view, $params = [])
  {
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once("view/$view.php");
    $content = ob_get_clean();
    include_once("view/_layout.php");
  }
}
