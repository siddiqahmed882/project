<?php

function getAllUsers()
{
  global $db;

  try {
    $query = "SELECT * FROM users";

    $statement = $db->prepare($query);

    $statement->execute();

    $users = $statement->fetchAll();

    return $users;
  } catch (PDOException $e) {
    return $e->getMessage();
  } finally {
    $statement->closeCursor();
  }
}

function save_user_info($formData)
{
  global $db;

  try {
    $query = "INSERT INTO users (name, cnic, nationality, address, mobile_number, email, profile_photo, education, training, work_experience, cv, username, password, member_id) Values (:name, :cnic, :nationality, :address, :mobile_number, :email, :profile_photo, :education, :training, :work_experience, :cv, :username, :password, :member_id)";

    $statement = $db->prepare($query);

    $statement->bindValue(":name", $formData["name"]);
    $statement->bindValue(":cnic", $formData["cnic"]);
    $statement->bindValue(":nationality", $formData["nationality"]);
    $statement->bindValue(":address", $formData["address"]);
    $statement->bindValue(":mobile_number", $formData["mobile_number"]);
    $statement->bindValue(":email", $formData["email"]);
    $statement->bindValue(":profile_photo", $formData["profile_photo"]);
    $statement->bindValue(":education", $formData["education"]);
    $statement->bindValue(":training", $formData["training"]);
    $statement->bindValue(":work_experience", (int)$formData["work_experience"]);
    $statement->bindValue(":cv", $formData["cv"]);
    $statement->bindValue(":username", $formData["username"]);
    $statement->bindValue(":password", $formData["password"]);
    $statement->bindValue(":member_id", $formData["member_id"]);

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

// get user by username
function get_user_by_username($username)
{
  global $db;

  try {
    $query = "SELECT * FROM users WHERE username = :username";

    $statement = $db->prepare($query);

    $statement->bindValue(":username", $username);

    $statement->execute();

    $user = $statement->fetch();

    // check if user exists
    if ($user) {
      return [
        "user" => $user,
        "error" => false,
      ];
    } else {
      return [
        "user" => null,
        "error" => "User does not exist",
      ];
    }
  } catch (PDOException $e) {
    return [
      "user" => null,
      "error" => $e->getMessage(),
    ];
  } finally {
    $statement->closeCursor();
  }
}


function get_user_by_id($id)
{
  global $db;

  try {
    $query = "SELECT * FROM users WHERE id = :id";

    $statement = $db->prepare($query);

    $statement->bindValue(":id", $id);

    $statement->execute();

    $user = $statement->fetch();

    if ($user) {
      return [
        "user" => $user,
        "error" => false,
      ];
    } else {
      return [
        "user" => null,
        "error" => "User does not exist",
      ];
    }
  } catch (PDOException $e) {
    return $e->getMessage();
  } finally {
    $statement->closeCursor();
  }
}

// get tasks for a specific user
function get_user_tasks($id)
{
  global $db;

  try {
    $query = "SELECT * FROM tasks WHERE assigned_to = :id";

    $statement = $db->prepare($query);

    $statement->bindValue(":id", $id);

    $statement->execute();

    $tasks = $statement->fetchAll();

    return $tasks;
  } catch (PDOException $e) {
    return $e->getMessage();
  } finally {
    $statement->closeCursor();
  }
}
