<main>
  <div class="wrapper wrapper--narrow">
    <div class="user-info-card">
      <div class="user-info__avatar">
        <img src="/public/uploads/profile_photos/<?= $user["profile_photo"] ?>" alt="avatar" alt="">
      </div>
      <form class="mb-2">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="<?= $user["name"] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="cnic">CNIC</label>
          <input type="text" class="form-control" id="cnic" name="cnic" value="<?= $user["cnic"] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= $user["email"] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="mobile_number">Mobile Number</label>
          <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?= $user["mobile_number"] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="education">Education</label>
          <input type="text" class="form-control" id="education" name="education" value="<?= $user["education"] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="training">Training</label>
          <input type="text" class="form-control" id="training" name="training" value="<?= $user["training"] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="work_experience">Work Experience</label>
          <input type="text" class="form-control" id="work_experience" name="work_experience" value="<?= $user["work_experience"] ?>" readonly>
        </div>
      </form>
      <!-- Link to download cv -->
      <a href="/public/uploads/cvs/<?= $user["cv"] ?>" download>Download CV</a>
    </div>
  </div>
</main>