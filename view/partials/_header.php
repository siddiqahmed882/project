<header class="main-header">
  <div class="wrapper">
    <div class="flex justify-between align-center">
      <div class="logo">LOGO</div>
      <div class="web-title">Team Management Application</div>
      <nav class="primary-nav">
        <ul class="primary-nav__items flex align-center">
          <li class="primary-nav__item"><a href="" class="primary-nav__link">About</a></li>
          <li class="primary-nav__item"><a href="" class="primary-nav__link">Contact</a></li>
          <?php if (isset($user)) : ?>
            <form action="/user/logout" class="inline-form" method="POST">
              <button class="btn btn-secondary--inverse">Logout</button>
            </form>
          <?php endif ?>
        </ul>
      </nav>
    </div>
  </div>
</header>