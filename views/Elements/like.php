 <?php
    // Like ou pas
    if ($post->liked) {
        // Post liké, bouton "unlike"
        $form = new BootstrapForm('Nouveau Unlike', 'Post', METHOD_POST);

        $form->addInput('post_id', TYPE_HIDDEN, ['value' => $post->id]);
        $form->setSubmit('Unlike', ['color' => DANGER, 'class' => 'btn-sm float-end']);

        echo $form->form();
    } else {
        // Post non liké, bouton "like"
        $form = new BootstrapForm('Nouveau Like', 'Post', METHOD_POST);

        $form->addInput('post_id', TYPE_HIDDEN, ['value' => $post->id]);
        $form->setSubmit('Like', ['color' => SUCCESS, 'class' => 'btn-sm float-end']);

        echo $form->form();
    }
?>