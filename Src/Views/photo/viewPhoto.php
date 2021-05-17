<div class="container">
    <div class="row">
        <?php
        //echo '<pre>'.var_dump($photos).'</pre>';
        foreach ($photos as $photo) {
            echo '<div class="col-sm-8 col-md-4 mx-auto mb-3">
                <div class="card-group"><a href = "index.php?entite=photo&action=voir&id=' . $photo->id . '">
                <div class="card">
                <img class="card-img-top" src="' . $photo->name_file . '" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">' . $photo->title_photo . '</h5>
                <div class="card-footer"><small class="text-muted">Postée le ' . $photo->post_at . '</small></div>
                </div>
                </div></div></div></a>';
        }
        ?>
    </div>
</div>