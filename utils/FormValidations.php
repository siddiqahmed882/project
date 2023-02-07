<?php
class FormValidations
{
  public static function validateCNIC($cnic)
  {
    $pattern = "/^[1-9][0-9]{10}$/";
    if (preg_match($pattern, $cnic)) {
      return true;
    } else {
      return false;
    }
  }

  public static function validatePhoneNumber($phone)
  {
    $pattern = "/^(05)[0-9]{8}$/";
    if (preg_match($pattern, $phone)) {
      return true;
    } else {
      return false;
    }
  }

  public static function validateEmail($email)
  {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (preg_match($pattern, $email)) {
      return true;
    } else {
      return false;
    }
  }
}
