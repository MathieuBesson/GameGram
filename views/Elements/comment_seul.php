<div class="card mb-5">
    <div class="card-header">
        <h6 class="card-title">Le <?= date('d/m/Y', strtotime($comment->created)); ?> par <?= $comment->User->pseudo; ?></h6>
        <p><?= $comment->content ?></p>
    </div>
    <div class="card-body">
        <div class="col col-sm-8">
            <h5 class="card-title"><?= $post->title; ?></h5>
            <p class="card-text"><?= substr($html->toHtml($post->content), 0, 100); ?>...</p>
        </div>
    </div>
    <div class="card-footer mt-3">
        <?= $html->button('Voir le post', ['dir' => 'posts', 'page' => 'post', 'options' => ['id' => $post->id]], ['color' => SUCCESS, 'class' => 'btn-sm']); ?>
    </div>
</div>