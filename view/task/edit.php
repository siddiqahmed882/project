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

    <form action="/task/update" enctype="multipart/form-data" method="POST">

      <input type="hidden" name="task_id" value="<?= $task["id"] ?? '' ?>" />

      <div class="form-group mb-1">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $task["title"] ?? '' ?>" readonly />
      </div>

      <div class="form-group mb-1">
        <label for="description">Description</label>
        <textarea name="description" id="description" readonly><?= $task["description"] ?? '' ?></textarea>
      </div>

      <div class="form-group mb-1">
        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" value="<?= $task["start_date"] ?? '' ?>" readonly />
      </div>

      <div class="form-group mb-1">
        <label for="due_date">End Date</label>
        <input type="date" name="due_date" id="due_date" value="<?= $task["due_date"] ?? '' ?>" readonly />
      </div>

      <div class="form-group mb-1">
        <fieldset>
          <legend>Priority</legend>
          <div class="radio-group">
            <input type="radio" name="priority" id="low" value="1" <?php if (isset($task["priority"]) && $task["priority"] == 1) : ?> checked <?php endif; ?> disabled />
            <label for="low">Low</label>
          </div>
          <div class="radio-group">
            <input type="radio" name="priority" id="medium" value="2" <?php if (isset($task["priority"]) && $task["priority"] == 2) : ?> checked <?php endif; ?> disabled />
            <label for="medium">Medium</label>
          </div>
          <div class="radio-group">
            <input type="radio" name="priority" id="high" value="3" <?php if (isset($task["priority"]) && $task["priority"] == 3) : ?> checked <?php endif; ?> disabled />
            <label for="high">High</label>
          </div>
        </fieldset>
        <?php if (isset($errors["priority"])) : ?>
          <span class="error"><?= $errors["priority"] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-1">
        <fieldset>
          <legend>Status</legend>
          <div class="radio-group">
            <input type="radio" name="status" id="pending" value="pending" <?= !$assigned_to_me ? 'disabled' : null ?> <?php if (isset($task["status"]) && $task["status"] == "pending") : ?> checked <?php endif; ?> />
            <label for="pending">Pending</label>
          </div>
          <div class="radio-group">
            <input type="radio" name="status" id="active" value="active" <?= !$assigned_to_me ? 'disabled' : null ?> <?php if (isset($task["status"]) && $task["status"] == "active") : ?> checked <?php endif; ?> />
            <label for="active">Active</label>
          </div>
          <div class="radio-group">
            <input type="radio" name="status" id="completed" value="completed" <?= !$assigned_to_me ? 'disabled' : null ?> <?php if (isset($task["status"]) && $task["status"] == "completed") : ?> checked <?php endif; ?> />
            <label for="completed">Completed</label>
          </div>
          <div class="radio-group">
            <input type="radio" name="status" id="late" value="late" <?= !$assigned_to_me ? 'disabled' : null ?> <?php if (isset($task["status"]) && $task["status"] == "late") : ?> checked <?php endif; ?> />
            <label for="late">Late</label>
          </div>
        </fieldset>
      </div>


      <div class="form-group mb-2">
        <label for="assigned_to">Please select a user for the task</label>
        <select name="assigned_to" id="assigned_to" disabled>
          <option value="" selected disabled>Users</option>
          <?php foreach ($users as $user) : ?>
            <option value="<?= $user['id'] ?>" <?php if (isset($task["assigned_to"]) && $task["assigned_to"] == $user['id']) : ?> selected <?php endif; ?>><?= $user['name'] ?></option>
          <?php endforeach; ?>
        </select>
        <?php if (isset($errors["assigned_to"])) : ?>
          <span class="error"><?= $errors["assigned_to"] ?></span>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary btn--block" <?php if (!$assigned_to_me) : ?> disabled <?php endif; ?>>Submit</button>
    </form>

  </div>

</main>