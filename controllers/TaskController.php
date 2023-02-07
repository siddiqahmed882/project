<?php
require_once('model/User.php');
require_once('model/Task.php');

class TaskController
{

  public static function getCreateTaskForm()
  {
    $users = getAllUsers();
    View::render("task/create", [
      "users" => $users
    ]);
  }

  public static function storeTaskData()
  {
    $errors = [];
    $formData = [
      "title" => filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "description" => filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "start_date" => filter_input(INPUT_POST, "start_date", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "due_date" => filter_input(INPUT_POST, "due_date", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "priority" => filter_input(INPUT_POST, "priority", FILTER_SANITIZE_NUMBER_INT),
      "assigned_to" => filter_input(INPUT_POST, "assigned_to", FILTER_SANITIZE_NUMBER_INT),
      "assigned_by" => $_SESSION["user"]["id"],
      "status" => "pending",
    ];

    if (empty($formData["title"])) {
      $errors["title"] = "Title is required";
    }

    if (empty($formData["description"])) {
      $errors["description"] = "Description is required";
    }

    if (empty($formData["start_date"])) {
      $errors["start_date"] = "Start date is required";
    }

    // start date can not be less than current date
    if (strtotime($formData["start_date"]) < strtotime(date("Y-m-d"))) {
      $errors["start_date"] = "Start date can not be less than current date";
    }

    if (empty($formData["due_date"])) {
      $errors["due_date"] = "Due date is required";
    }

    // due date can not be less than start date
    if (strtotime($formData["due_date"]) < strtotime($formData["start_date"])) {
      $errors["due_date"] = "Due date can not be less than start date";
    }

    if (empty($formData["assigned_to"])) {
      $errors["assigned_to"] = "Please select a user";
    }

    if (empty($formData["priority"])) {
      $errors["priority"] = "Please select a priority";
    }


    if (count($errors) > 0) {
      $users = getAllUsers();
      return View::render("task/create", [
        "errors" => $errors,
        "formData" => $formData,
        "users" => $users
      ]);
    }

    $result = createTask($formData);

    if ($result !== true) {
      $users = getAllUsers();
      return View::render("task/create", [
        "users" => $users,
        "server_error" => $result,
        "formData" => $formData
      ]);
    }
  }
}
