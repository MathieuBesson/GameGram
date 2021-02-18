<div class="card mb-5" id="post_<?= $post->id; ?>">
    <div class="card-header">

        <div class="row">
            <div class="col-8">
                Le <?= date('d/m/Y', strtotime($post->created)); ?> par <?= $post->User->pseudo; ?>
            </div>
            <div class="col-2">
                <?= $post->nbLikes; ?>
                <img src="assets/img/icons/Rating.svg" style="height: 24px;" />
            </div>
            <div class="col-2">
                <?php include('./views/Elements/like.php'); ?>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col col-sm-8">
                <h5 class="card-title"><?= $post->title; ?></h5>
                <p class="card-text"><?= $html->toHtml($post->content); ?></p>
            </div>
            <div class="col col-sm-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title"><?= $post->Game->name; ?></h6>
                        <img src="<?= $Design->icon($post->Game->family_id); ?>" />
                        <span class="badge bg-success"><?= $post->Game->Family->name; ?></span> - <span class="badge bg-success"><?= $post->Game->Platform->name; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer mt-3">
        <?= $html->button('Voir le post', ['dir' => 'posts', 'page' => 'post', 'options' => ['id' => $post->id]], ['color' => SUCCESS, 'class' => 'btn-sm']); ?>
    </div>
</div>