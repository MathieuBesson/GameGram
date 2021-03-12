<div class="starter-template text-center mt-5 px-3">
	<h1>Page de suggestion de jeux</h1>
</div>
<div class="row justify-content-center">
	<div class="row d-flex justify-content-between">
		<?php foreach ($_games as $game) : ?>
			<div class="card m-3 col-5">
				<div class="card-body">
					<span class="badge bg-success float-end"><?= $game->year; ?></span>
					<h5 class="card-title"><?= ucfirst($game->name) ?> </h5>
					<p class="card-text">Note du public : <strong><?= $game->note; ?></strong>/10</p>
					<?= $html->button('Voir le jeu', ['dir' => 'games', 'page' => 'one', 'options' => ['id' => $game->id]], ['color' => SUCCESS, 'class' => 'btn-sm']); ?>
					
					<?php
					if(in_array($game->id, $_collection)){
						echo '<p class="mt-3"><i>Je dans la collection</i></p>';
					} else {
						$form = new BootstrapForm('add to collection', 'Collection', METHOD_POST);
						$form->addInput('game_id', TYPE_HIDDEN, ['value' => $game->id]);
						$form->setSubmit('Ajouter à ma collection', ['color' => WARNING]);
						echo $form->form();
					}
					?>
				</div>
			</div>

		<?php endforeach; ?>
	</div>
</div>