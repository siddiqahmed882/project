<main>
  <div class="wrapper wrapper--narrow">

    <?php if (isset($server_error)) : ?>
      <p class="alert alert--danger">
        <?= $server_error ?>
      </p>
    <?php endif; ?>

    <header class="mb-2 text-center">
      <h1>SignUp</h1>
    </header>

    <form action="/user/sign_up" enctype="multipart/form-data" method="POST">

      <!--  generate hidden input fields for formData -->
      <?php foreach ($formData as $key => $value) : ?>
        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>" />
      <?php endforeach; ?>

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

      <div class="form-group mb-1">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required />
      </div>

      <button type="submit" class="btn btn-primary btn--block">Submit</button>

    </form>

    <p>Already have an account? <a href="/user/login">Sign in instead</a></p>
  </div>
</main>