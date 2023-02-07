<?php
require_once("model/db.php");
require_once("controllers/UserController.php");
require_once("controllers/TaskController.php");

$current_url = $_SERVER["PATH_INFO"] ?? "/";
$request_method = $_SERVER["REQUEST_METHOD"] ?? null;

// if $current_url == "/":
// check if user is logged in ? "redirect to home page" : login


function render_view($view, $params = [])
{
  foreach ($params as $key => $value) {
    $$key = $value;
  }
  global $course_id;
  ob_start();
  include_once("view/$view.php");
  $content = ob_get_clean(); // content variable is to be used in _layout
  include_once("view/_layout.php");
}


switch ($current_url) {
  case "/user/create":
    if ($request_method == "GET")
      User::getUserInfoForm();
    break;

  case "/user/store":
    if ($request_method == "POST")
      User::storeUserInfo();
    break;

  case "/user/sign_up":
    if ($request_method == "GET")
      User::getSignUpForm();
    break;

  case "/task/create":
    if ($request_method == "GET")
      TaskController::getCreateTaskForm();
    break;

  case "/task/store":
    if ($request_method == "GET")
      TaskController::storeTaskData();
    break;

  default:
    $error = "Route Not Found. <br /> URL: $current_url <br /> Request Method: $request_method";
    render_view("error", [
      "error" => $error
    ]);
}
