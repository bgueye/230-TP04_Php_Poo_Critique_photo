<?php //var_dump($_SERVER); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-8 col-md-9 mx-auto">
      <div class="card mb-3">
        <img class="card-img-top" src="<?= $photo->name_file ?>" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title text-center"><?= $photo->title_photo ?></h5>
          <small class="text-muted">Publiée le <?= $photo->post_at ?></small>
            <?php if (!empty($_SESSION['login']) && $_SESSION['id'] === $photo->id_user) { ?>
              <a href="index.php?entite=photo&action=delatePhoto&id=<?= $photo->id ?>" class="badge btn-danger">Supprimer</a>
            <?php } ?>
          <div class="card-footer">
          <?php foreach ($comments as $comment){ ?>
          
            <div class="card mb-2">
              <div class="card-body">
                <p style="margin-top: 0;" class="card-text">Publié par <strong><?= $comment->pseudo ?></strong><br><small class="text-muted"> le : <?= $comment->create_at ?></small></p>
                <p style="margin-top: 0;" class="card-text">Commentaire : <?= $comment->comment ?></p>
                <?php if (!empty($_SESSION['login']) && $_SESSION['login'] === $comment->login) { ?>
                  <a class="badge btn-danger" href="index.php?entite=photo&action=delateComment&id=<?= $comment->id ?>">Supprimer</a>
                <?php } ?>
              </div>
            </div>
          <?php
          }
          ?>
          </div>


        </div>
      </div>
    </div>
    <?php if (!empty($_SESSION['login'])) {
      echo '
    <div class="col-sm-3">
    <p>Ajoutez un commentaire</p>
    <div class="card">
    <form action="#" method="post">
      <label for="pseudo">Pseudo</label>
      <input type="text" name="pseudo" id="pseudo" value="' . $_SESSION['pseudo'] . '" class="form-control">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="' . $_SESSION['login'] . '" class="form-control">
      <label for="contenu">Message :</label>
      <textarea name="contenu" id="contenu" class="form-control"></textarea>
      <button class="badge btn-primary btn-sm">Envoyer</button>
    </form>
    </div>
    </div>';
    } ?>
  </div>
</div>
</div>