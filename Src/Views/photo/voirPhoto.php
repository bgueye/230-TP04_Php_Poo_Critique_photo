<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <div class="card">
        <img class="card-img-top" src="<?= $photo->name_file ?>" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?= $photo->title_photo ?></h5>
          <p class="card-text"><small class="text-muted">Last updated <?= $photo->post_at ?></small></p>
        
        <?php foreach($comments as $comment){
          echo '<div class="card">
          <div class="card-body">
            <h5 class="card-title">'.$_SESSION['pseudo'].'</h5>
            <p class="card-text"><small class="text-muted">Publié le : '.$comment->post_at.'</small></p>
            <p class="card-text">Commentaire : '.$comment->comment.'</p>
          </div>
        </div>';
        }
        ?>
        
        
        
        </div>
      </div>
    </div>
    <?php if (!empty($_SESSION['login'])) {
      echo '
    <div class="col-sm-4">
    <div class="card">
    <form action="#" method="post">
      <label for="pseudo">Pseudo</label>
      <input type="text" name="pseudo" id="pseudo" value="'.$_SESSION['pseudo'].'" class="form-control">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="'.$_SESSION['login'].'" class="form-control">
      <label for="contenu">Message :</label>
      <textarea name="contenu" id="contenu" class="form-control"></textarea><hr>
      <button class="btn btn-primary btn-sm">Envoyer</button>
    </form>
    </div>
    </div>';
      } ?>
    </div>
  </div>
</div>