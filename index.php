<?php
require_once("model/db.php");
require_once("controllers/UserController.php");
require_once("controllers/TaskController.php");

$current_url = $_SERVER["PATH_INFO"] ?? "/";
$request_method = $_SERVER["REQUEST_METHOD"] ?? null;

session_start();

if (!isset($_SESSION["user"]) && $current_url != "/user/sign_up" && $current_url != "/user/login" && $current_url != "/user/store" && $current_url != "/user/create") {
  header("Location: /user/login");
  exit;
}

if (isset($_SESSION["user"]) && ($current_url == "/user/login" || $current_url == "/user/sign_up" || $current_url == "/user/create")) {
  header("Location: /");
  exit;
}

switch ($current_url) {
  case "/":
    if ($request_method == "GET")
      TaskController::getTaskList();
    break;

    // User Routes

  case "/user/info":
    if ($request_method == "GET")
      User::getUserInfoView();
    break;

  case "/user/create":
    if ($request_method == "GET")
      User::getUserInfoForm();
    break;

  case "/user/store":
    if ($request_method == "POST")
      User::processUserInfoForm();
    break;

  case "/user/sign_up":
    if ($request_method == "GET")
      User::getSignUpForm();
    elseif ($request_method == "POST")
      User::storeUser();
    break;

  case "/user/login":
    if ($request_method == "GET")
      User::getLoginForm();
    elseif ($request_method == "POST")
      User::login();
    break;

  case "/user/logout":
    if ($request_method == "POST")
      User::logout();
    break;

  case "/user/me":
    if ($request_method == "GET")
      User::getUserInfoView();
    break;

    // Task Routes

  case "/task":
    if ($request_method == "GET")
      TaskController::getTaskList();
    break;

  case "/task/create":
    if ($request_method == "GET")
      TaskController::getCreateTaskForm();
    break;

  case "/task/store":
    if ($request_method == "POST")
      TaskController::storeTaskData();
    break;

  case "/task/list":
    if ($request_method == "GET")
      TaskController::getTaskList();
    break;

  case "/task/list/late":
    if ($request_method == "GET")
      TaskController::getLateTaskList();
    break;

  case "/task/list/pending":
    if ($request_method == "GET")
      TaskController::getPendingTaskList();
    break;

  case "/task/list/active":
    if ($request_method == "GET")
      TaskController::getActiveTaskList();
    break;

  case "/task/view":
    if ($request_method == "GET")
      TaskController::getTaskView();
    break;

  case "/task/update":
    if ($request_method == "POST")
      TaskController::updateTask();
    break;

  case "/error":
    $error = $_SESSION["error"];
    if ($request_method == "GET")
      View::render("error", [
        "error" => $error
      ]);
    break;

  default:
    $error = "Route Not Found. <br /> URL: $current_url <br /> Request Method: $request_method";
    View::render("error", [
      "error" => $error
    ]);
}
