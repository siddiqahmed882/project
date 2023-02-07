<?php
require_once("View.php");
require_once("utils/FormValidations.php");
require_once("utils/FileSystem.php");
require_once("model/User.php");

class User
{
  // static function to display user info form
  public static function getUserInfoForm()
  {
    View::render("user/create");
  }

  // static function to process user info form submission
  public static function storeUserInfo()
  {
    $errors = [];

    $formData = [
      "name" => filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "cnic" => filter_input(INPUT_POST, "cnic", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "nationality" => filter_input(INPUT_POST, "nationality", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "address" => filter_input(INPUT_POST, "address", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "mobile_number" => filter_input(INPUT_POST, "mobile_number", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "email" => filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL),
      "profile_photo" => $_FILES["profile_photo"],
      "education" => filter_input(INPUT_POST, "education", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "training" => filter_input(INPUT_POST, "training", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "work_experience" => filter_input(INPUT_POST, "work_experience", FILTER_SANITIZE_NUMBER_FLOAT),
      "cv" => $_FILES["cv"],
    ];

    extract($formData);

    if (strlen($formData["name"]) < 3 || strlen($formData["name"]) > 50) {
      $errors += ["name" => "Name must be atleat 3 char long and max of 50"];
    }

    if (FormValidations::validateCNIC($formData["cnic"]) == false) {
      $errors += ["cnic" => "Invalid CNIC. CNIC Number starts with a digit between 1 and 9, followed by 10 more digits."];
    }

    if (empty($formData["nationality"])) {
      $errors += ["nationality" => "Nationality can not be empty"];
    }

    if (empty($formData["address"])) {
      $errors += ["address" => "Address can not be empty"];
    }

    if (FormValidations::validatePhoneNumber($formData["mobile_number"]) == false) {
      $errors += ["mobile_number" => "Invalid Mobile Number. Mobile Number starts with 05 and is followed by 8 more digits."];
    }

    if (FormValidations::validateEmail($formData["email"]) == false) {
      $errors += ["email" => "Invalid Email Address"];
    }

    if (empty($formData["profile_photo"])) {
      $errors += ["profile_photo" => "Profile Photo can not be empty"];
    }

    if (empty($formData["education"])) {
      $errors += ["education" => "Education can not be empty"];
    }

    if (empty($formData["training"])) {
      $errors += ["training" =>  "Training can not be empty"];
    }

    if (empty($formData["work_experience"])) {
      $errors += ["work_experience", "Work Experience can not be empty"];
    }

    if (empty($formData["cv"])) {
      $errors += ["cv" => "CV can not be empty"];
    }

    if (count($errors) > 0) {
      return View::render("user/create", ["errors" => $errors, "formData" => $formData]);
    }

    // store image and cv
    $profile_photo = FileSystem::uploadFile($formData["profile_photo"], "profile_photos");
    $cv = FileSystem::uploadFile($cv, "cvs");

    // store user info in database
    $res = save_user_info($formData);

    if ($res !== true) {
      FileSystem::deleteFile($formData["profile_photo"], "profile_photos");
      FileSystem::deleteFile($formData["cv"], "cvs");

      return View::render("user/create", ["server_error" => $res, "formData" => $formData]);
    }
  }

  // function to display sign up form
  public static function getSignUpForm()
  {
    View::render("user/sign_up");
  }

  // function to process sign up form submission
  public static function storeSignUpInfo()
  {
    $errors = [];

    $formData = [
      "username" => filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "password" => filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "confirm_password" => filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS),
      "member_id" => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
    ];

    if (strlen($formData["username"]) < 3 || strlen($formData["username"]) > 50) {
      $errors += ["name" => "Name must be atleat 3 char long and max of 50"];
    }
    // yahan aap check krlo username database me exist krta hai ya nhi

    if (strlen($formData["password"]) < 8 || strlen($formData["password"]) > 50) {
      $errors += ["password" => "Password must between 8 and 50 chars"];
    }

    if ($formData["password"] !== $formData["confirm_password"]) {
      $errors += ["confirm_password" => "Password do not match"];
    }

    if (count($errors) > 0) {
      return View::render("user/sign_up", ["errors" => $errors, "formData" => $formData]);
    }

    // store user info in database
    $res = save_user_info($formData);

    if ($res !== true) {
      return View::render("user/sign_up", ["server_error" => $res, "formData" => $formData]);
    }
  }
}
