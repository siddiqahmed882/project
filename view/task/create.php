<main>

  <div class="wrapper wrapper--narrow">

    <?php if (isset($server_error)) : ?>
      <p class="alert alert--danger">
        <?= $server_error ?>
      </p>
    <?php endif; ?>

    <header class="mb-2 text-center">
      <h1>Create Task</h1>
    </header>

    <form action="/task/store" enctype="multipart/form-data" method="POST">

      <div class="form-group mb-1">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="<?= isset($errors["title"]) ? 'input-error' : '' ?>" value="<?= $formData["title"] ?? '' ?> " required />
        <?php if (isset($errors["title"])) : ?>
          <span class="error"><?= $errors["title"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="<?= isset($errors["description"]) ? 'input-error' : '' ?>"><?= $formData["description"] ?? '' ?></textarea>
        <?php if (isset($errors["description"])) : ?>
          <span class="error"><?= $errors["description"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="<?= isset($errors["start_date"]) ? 'input-error' : '' ?>" value="<?= $formData["start_date"] ?? '' ?>" min="<?php echo date('Y-m-d'); ?>" required />
        <?php if (isset($errors["start_date"])) : ?>
          <span class="error"><?= $errors["start_date"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <label for="due_date">End Date</label>
        <input type="date" name="due_date" id="due_date" class="<?= isset($errors["due_date"]) ? 'input-error' : '' ?>" value="<?= $formData["due_date"] ?? '' ?>" min="<?php echo date('Y-m-d'); ?>" required />
        <?php if (isset($errors["due_date"])) : ?>
          <span class="error"><?= $errors["due_date"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <fieldset>
          <legend>Priority</legend>
          <div class="radio-group">
            <input type="radio" name="priority" id="low" value="1">
            <label for="low">Low</label>
          </div>
          <div class="radio-group">
            <input type="radio" name="priority" id="medium" value="2">
            <label for="medium">Medium</label>
          </div>
          <div class="radio-group">
            <input type="radio" name="priority" id="high" value="3">
            <label for="high">High</label>
          </div>
        </fieldset>
        <?php if (isset($errors["priority"])) : ?>
          <span class="error"><?= $errors["priority"] ?></span>
        <?php endif; ?>
      </div>


      <div class="form-group mb-2">
        <label for="assigned_to">Please select a user for the task</label>
        <select name="assigned_to" id="assigned_to">
          <option value="" selected disabled>Users</option>
          <?php foreach ($users as $user) : ?>
            <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
          <?php endforeach; ?>
        </select>
        <?php if (isset($errors["assigned_to"])) : ?>
          <span class="error"><?= $errors["assigned_to"] ?></span>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary btn--block">Submit</button>
    </form>

  </div>

</main>