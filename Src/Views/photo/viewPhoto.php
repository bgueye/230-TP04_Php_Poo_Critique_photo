<?php

foreach ($photos as $photo) {
    echo '<div class="card-group"><a href = "index.php?entite=photo&action=voir&id=' . $photo->id . '">
       <div class="card">
        <img class="card-img-top" src="' . $photo->name_file . '" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">' . $photo->title_photo . '</h5>
            <p class="card-text"><small class="text-muted">Postée le ' . $photo->post_at . '</small></p>
        </div>
        </div></a></div>';
}
    