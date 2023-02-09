<main>
  <div class="wrapper">
    <?php if (isset($server_error)) : ?>
      <p class="alert alert--danger">
        <?= $server_error ?>
      </p>
    <?php endif; ?>
    <header class="flex justify-between mb-2">
      <h1><?= $title ?></h1>
      <a href="/task/create" class="btn btn-primary">Create Task</a>
    </header>
    <?php if (count($tasks) == 0) : ?>
      <p class="text-center">No Tasks Found</p>
    <?php else : ?>
      <table class="tasks-table">
        <thead>
          <th>Id</th>
          <th>Title</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Priority</th>
          <th>Assigned By</th>
          <th>Status</th>
          <th>View</th>
        </thead>
        <tbody>
          <?php foreach ($tasks as $task) : ?>
            <tr>
              <td><?= $task['id'] ?></td>
              <td><?= $task['title'] ?></td>
              <td><?= $task['start_date'] ?></td>
              <td><?= $task['due_date'] ?></td>
              <td><?= $task['priority'] ?></td>
              <td><?= $task['assigned_by'] ?></td>
              <td><?= $task['status'] ?></td>
              <td><a href="/task/view?id=<?= $task['id'] ?>">View</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

</main>