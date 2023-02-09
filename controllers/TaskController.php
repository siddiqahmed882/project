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

    return header("Location: /");
  }

  public static function getTaskList()
  {
    $result = getAllTasksByUserId($_SESSION["user"]["id"]);
    if ($result["status"] === "success") {
      $tasks = $result["tasks"];
      $server_error = null;
    } else {
      $tasks = [];
      $server_error = $result["message"];
    }
    View::render("task/index", [
      "tasks" => $tasks,
      "title" => "Tasks",
      "server_error" => $server_error
    ]);
  }

  public static function getLateTaskList()
  {
    $result = getAllTasksForUserByStatus($_SESSION["user"]["id"], "late");
    if ($result["status"] === "success") {
      $tasks = $result["tasks"];
      $server_error = null;
    } else {
      $tasks = [];
      $server_error = $result["message"];
    }
    View::render("task/index", [
      "tasks" => $tasks,
      "title" => "Late Tasks",
      "server_error" => $server_error
    ]);
  }

  public static function getPendingTaskList()
  {
    $result = getAllTasksForUserByStatus($_SESSION["user"]["id"], "pending");
    if ($result["status"] === "success") {
      $tasks = $result["tasks"];
      $server_error = null;
    } else {
      $tasks = [];
      $server_error = $result["message"];
    }
    View::render("task/index", [
      "tasks" => $tasks,
      "title" => "Pending Tasks",
      "server_error" => $server_error
    ]);
  }

  public static function getActiveTaskList()
  {
    $result = getAllTasksForUserByStatus($_SESSION["user"]["id"], "active");
    if ($result["status"] === "success") {
      $tasks = $result["tasks"];
      $server_error = null;
    } else {
      $tasks = [];
      $server_error = $result["message"];
    }
    View::render("task/index", [
      "tasks" => $tasks,
      "title" => "Active Tasks",
      "server_error" => $server_error
    ]);
  }

  public static function getTaskView()
  {
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $result = getTaskById($id);


    if ($result["status"] === "success") {
      $task = $result["task"];
      $server_error = null;
      $assigned_to_me = $_SESSION["user"]["id"] === $result["task"]["assigned_to"];
    } else {
      $task = [];
      $server_error = $result["message"];
      $assigned_to_me = false;
    }

    View::render("task/edit", [
      "task" => $task,
      "users" => getAllUsers(),
      "server_error" => $server_error,
      "assigned_to_me" => $assigned_to_me,
    ]);
  }

  // update task status
  public static function updateTask()
  {
    $user_id = $_SESSION["user"]["id"];

    $task_id = filter_input(INPUT_POST, "task_id", FILTER_SANITIZE_NUMBER_INT);

    $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $task = getTaskById($task_id);

    if ($task["status"] === "success") {
      $task = $task["task"];
    } else {
      return header("Location: /");
    }

    if ($task["assigned_to"] !== $user_id) {
      $_SESSION["error"] = "You are not authorized to update this task";
      return header("Location: /error");
    }

    // if current date is greater than due date, set status to late
    if (strtotime(date("Y-m-d")) > strtotime($task["due_date"])) {
      $status = "late";
    }

    $result = updateTaskStatus($task_id, $status);

    return header("Location: /");
  }
}
