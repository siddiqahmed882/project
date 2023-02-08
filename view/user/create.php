<main>

  <div class="wrapper wrapper--narrow">

    <?php if (isset($server_error)) : ?>
      <p class="alert alert--danger">
        <?= $server_error ?>
      </p>
    <?php endif; ?>

    <header class="mb-2 text-center">
      <h1>User Information</h1>
    </header>

    <form action="/user/store" enctype="multipart/form-data" method="POST">

      <div class="form-group mb-1">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="<?= isset($errors["name"]) ? 'input-error' : '' ?>" value="<?= $formData["name"] ?? '' ?> " required />
        <?php if (isset($errors["name"])) : ?>
          <span class="error"><?= $errors["name"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="cnic">Identity Number</label>
        <input type="text" name="cnic" id="cnic" class="<?= isset($errors["cnic"]) ? 'input-error' : '' ?>" value="<?= $formData["cnic"] ?? '' ?> " required>
        <?php if (isset($errors["cnic"])) : ?>
          <span class="error"><?= $errors["cnic"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="nationality">Nationality</label>
        <input type="text" name="nationality" id="nationality" class="<?= isset($errors["nationality"]) ? 'input-error' : '' ?>" value="<?= $formData["nationality"] ?? '' ?> " required>
        <?php if (isset($errors["nationality"])) : ?>
          <span class="error"><?= $errors["nationality"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="<?= isset($errors["address"]) ? 'input-error' : '' ?>" value="<?= $formData["address"] ?? '' ?> " required>
        <?php if (isset($errors["address"])) : ?>
          <span class="error"><?= $errors["address"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="mobile_number">Mobile Number</label>
        <input type="tel" name="mobile_number" id="mobile_number" class="<?= isset($errors["mobile_number"]) ? 'input-error' : '' ?>" value="<?= $formData["mobile_number"] ?? '' ?> " required>
        <?php if (isset($errors["mobile_number"])) : ?>
          <span class="error"><?= $errors["mobile_number"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" class="<?= isset($errors["email"]) ? 'input-error' : '' ?>" value="<?= $formData["email"] ?? '' ?>" required>
        <?php if (isset($errors["email"])) : ?>
          <span class="error"><?= $errors["email"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="profile_photo">Profile Photo</label>
        <input type="file" accept="image/*" name="profile_photo" class="<?= isset($errors["profile_photo"]) ? 'input-error' : '' ?>" id="profile_photo" required>
        <?php if (isset($errors["profile_photo"])) : ?>
          <span class="error"><?= $errors["profile_photo"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="education">Education</label>
        <input type="text" name="education" id="education" class="<?= isset($errors["education"]) ? 'input-error' : '' ?>" value="<?= $formData["education"] ?? '' ?> " required>
        <?php if (isset($errors["education"])) : ?>
          <span class="error"><?= $errors["education"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="training">Training</label>
        <input type="text" name="training" id="training" class="<?= isset($errors["training"]) ? 'input-error' : '' ?>" value="<?= $formData["training"] ?? '' ?> " required>
        <?php if (isset($errors["training"])) : ?>
          <span class="error"><?= $errors["training"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="work_experience">Working Experience</label>
        <input type="number" name="work_experience" id="work_experience" class="<?= isset($errors["work_experience"]) ? 'input-error' : '' ?>" value="<?= $formData["work_experience"] ?? '' ?> " required>
        <?php if (isset($errors["work_experience"])) : ?>
          <span class="error"><?= $errors["work_experience"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-2">
        <label for="cv">CV</label>
        <input type="file" accept=".doc,.docx,.pdf" name="cv" id="cv" class="<?= isset($errors["cv"]) ? 'input-error' : '' ?>" required>
        <?php if (isset($errors["cv"])) : ?>
          <span class="error"><?= $errors["cv"] ?></span>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary btn--block">Submit</button>
    </form>
  </div>
</main>