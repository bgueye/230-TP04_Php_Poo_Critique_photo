<?php //var_dump($photo); ?>
<div class="card mb-3">
    <img class="card-img-top" src="<?= $photo->name_file ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?= $photo->title_photo ?></h5>
    <p class="card-text"><small class="text-muted">Last updated <?= $photo->post_at ?></small></p>
  </div>
</div>
