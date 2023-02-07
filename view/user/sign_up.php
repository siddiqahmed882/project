<main>
  <div class="wrapper wrapper--narrow">
    <header class="mb-2 text-center">
      <h1>User Information</h1>
    </header>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
      <div class="form-group mb-1">
        <label for="">Username</label>
        <input type="text" name="username" required>
      </div>
      <div class="form-group mb-1">
        <label for="">Password</label>
        <input type="password" name="password" required>
      </div>
      <div class="form-group mb-2">
        <label for="">Confirm Password</label>
        <input type="password" name="confirm_password" required>
      </div>
      <button type="submit" class="btn btn-primary btn--block">Submit</button>
    </form>
  </div>
</main>