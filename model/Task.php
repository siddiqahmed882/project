<?php

function createTask($formData)
{
  global $db;
  try {
    $query = "INSERT INTO tasks (title, description, start_date, due_date, priority, assigned_to, assigned_by, status) VALUES (:title, :description, :start_date, :due_date, :priority, :assigned_to, :assigned_by, :status)";

    $statement = $db->prepare($query);

    $statement->bindValue(":title", $formData["title"]);
    $statement->bindValue(":description", $formData["description"]);
    $statement->bindValue(":start_date", $formData["start_date"]);
    $statement->bindValue(":due_date", $formData["due_date"]);
    $statement->bindValue(":priority", $formData["priority"]);
    $statement->bindValue(":assigned_to", $formData["assigned_to"]);
    $statement->bindValue(":assigned_by", $formData["assigned_by"]);
    $statement->bindValue(":status", $formData["status"]);

    $statement->execute();

    if ($statement->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  } catch (PDOException $e) {
    return $e->getMessage();
  } finally {
    $statement->closeCursor();
  }
}

// get all task by user id
function getAllTasksByUserId($id)
{
  global $db;

  try {
    $query = "SELECT tasks.*, users.name, users.profile_photo FROM tasks JOIN users ON tasks.assigned_by = users.id WHERE tasks.assigned_to = :id";

    $statement = $db->prepare($query);

    $statement->bindValue(":id", $id);

    $statement->execute();

    $tasks = $statement->fetchAll();

    return [
      "tasks" => $tasks,
      "status" => "success",
    ];
  } catch (PDOException $e) {
    return [
      "status" => "error",
      "message" => $e->getMessage()
    ];
  } finally {
    $statement->closeCursor();
  }
}


// get all tasks for user where status is late
function getAllTasksForUserByStatus($id, $status)
{
  global $db;

  try {
    $query = "SELECT tasks.*, users.name, users.profile_photo FROM tasks JOIN users ON tasks.assigned_by = users.id WHERE tasks.assigned_to = :id AND tasks.status = :status";

    $statement = $db->prepare($query);

    $statement->bindValue(":id", $id);
    $statement->bindValue(":status", $status);

    $statement->execute();

    $tasks = $statement->fetchAll();

    return [
      "tasks" => $tasks,
      "status" => "success",
    ];
  } catch (PDOException $e) {
    return [
      "status" => "error",
      "message" => $e->getMessage()
    ];
  } finally {
    $statement->closeCursor();
  }
}


// get task by id
function getTaskById($id)
{
  global $db;

  try {
    $query = "SELECT tasks.*, users.name, users.profile_photo FROM tasks JOIN users ON tasks.assigned_by = users.id WHERE tasks.id = :id";

    $statement = $db->prepare($query);

    $statement->bindValue(":id", $id);

    $statement->execute();

    $task = $statement->fetch();

    return [
      "task" => $task,
      "status" => "success",
    ];
  } catch (PDOException $e) {
    return [
      "status" => "error",
      "message" => $e->getMessage()
    ];
  } finally {
    $statement->closeCursor();
  }
}


// update task status
function updateTaskStatus($id, $status)
{
  global $db;

  try {
    $query = "UPDATE tasks SET status = :status WHERE id = :id";

    $statement = $db->prepare($query);

    $statement->bindValue(":id", $id);
    $statement->bindValue(":status", $status);

    $statement->execute();

    if ($statement->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  } catch (PDOException $e) {
    return $e->getMessage();
  } finally {
    $statement->closeCursor();
  }
}
