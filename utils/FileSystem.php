<?php

class FileSystem
{

  // function to upload file
  public static function uploadFile($file, $folder)
  {
    $path = "public/uploads/" . $folder . "/";
    $filename = $file["name"];
    $tmp_name = $file["tmp_name"];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $new_filename = self::generateRandomFilename($ext);
    $destination = $path . $new_filename;
    if (move_uploaded_file($tmp_name, $destination)) {
      return $new_filename;
    } else {
      return false;
    }
  }

  // function to delete file
  public static function deleteFile($filename, $folder)
  {
    $path = "public/uploads/" . $folder . "/";
    $destination = $path . $filename;
    if (file_exists($destination)) {
      unlink($destination);
      return true;
    } else {
      return false;
    }
  }


  public static function generateRandomFilename($ext)
  {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $pattern = substr(str_shuffle($chars), 0, 8);
    return $pattern . "." . $ext;
  }
}
