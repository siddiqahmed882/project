<main>
  <div class="wrapper wrapper--narrow">

    <?php if (isset($server_error)) : ?>
      <p class="alert alert--danger">
        <?= $server_error ?>
      </p>
    <?php endif; ?>

    <header class="mb-2 text-center">
      <h1>SignIn</h1>
    </header>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">

      <div class="form-group mb-1">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="<?= isset($errors["username"]) ? 'input-error' : '' ?>" value="<?= $formData["username"] ?? '' ?>" required />
        <?php if (isset($errors["username"])) : ?>
          <span class="error"><?= $errors["username"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="<?= isset($errors["password"]) ? 'input-error' : '' ?>" required />
        <?php if (isset($errors["password"]) || isset($errors["confirm_password"])) : ?>
          <span class="error"><?= $errors["password"] ?? $errors["confirm_password"] ?></span>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary btn--block">Submit</button>

    </form>

    <p>Don't have an account? <a href="/user/create">Sign up instead</a></p>
  </div>
</main>