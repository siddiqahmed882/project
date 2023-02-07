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

function getAllTasks()
{
  global $db;

  try {
    $query = "SELECT * FROM tasks";

    $statement = $db->prepare($query);

    $statement->execute();

    $tasks = $statement->fetchAll();

    return $tasks;
  } catch (PDOException $e) {
    return $e->getMessage();
  } finally {
    $statement->closeCursor();
  }
}


function getTaskById($id)
{
  global $db;

  try {
    $query = "SELECT * FROM tasks WHERE id = :id";

    $statement = $db->prepare($query);

    $statement->bindValue(":id", $id);

    $statement->execute();

    $task = $statement->fetch();

    return $task;
  } catch (PDOException $e) {
    return $e->getMessage();
  } finally {
    $statement->closeCursor();
  }
}