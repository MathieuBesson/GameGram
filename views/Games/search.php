<div class="starter-template text-center mt-5 px-3">
	<h1>Rerchercher</h1>
</div>
<div class="row justify-content-center">
	<div class="col col-md-6">
		<p class="lead text-center mb-5">Votre tri affiche <strong> <?= count($_games) ?></strong> jeux de la base de données</p>
		<p class="text-center">
			<?php
			$form = new BootstrapForm('search', 'Game', METHOD_GET);
			$form->addInput('name',	TYPE_TEXT, ['label' => 'Champs de recherche', 'placeholder' => 'Call of...', 'value' => $_search_name]);
			$form->addInput('platform_id',	TYPE_SELECT, ['label' => 'Plateforme', 'data' => $_platforms, 'empty' => 'Toutes les plateformes', 'class' => 'select2', 'value' => $_search_platform_id]);
			$form->addInput('publisher_id',	TYPE_SELECT, ['label' => 'Editeur', 'data' =>  $_publishers, 'empty' => 'Tous les éditeurs', 'class' => 'select2', 'value' => $_search_publisher_id]);
			$form->addInput('family_id',	TYPE_SELECT, ['label' => 'Genre', 'data' => $_families, 'empty' => 'Tous les genres', 'class' => 'select2', 'value' => $_search_family_id]);
			$form->addInput('note',	TYPE_RADIO, ['data' => [0 => 'Toutes les notes', 6 => '6+', 7 => '7+', 8 => '8+', 9 => '9+'], 'checked' => $_search_note_id]);

			$form->setSubmit('Rechercher', ['color' => SUCCESS, 'class' => 'mt-4']);
			echo $form->form();
			?>
			<?= $html->button('Voir mes suggestions', ['dir' => 'games', 'page' => 'suggest'], ['color' => PRIMARY, 'class' => 'mt-4']); ?>
		</p>
	</div>
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