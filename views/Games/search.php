<div class="starter-template text-center mt-5 px-3">
	<h1>Rerchercher</h1>
</div>
<div class="row justify-content-center">
	<div class="col col-md-6">
		<p class="lead text-center mb-5">Votre tri affiche <strong></strong> gamex de la base de données</p>
		<p class="text-center">
			<?php
                $form = new BootstrapForm('search', 'Game', METHOD_GET);
                $form->addInput('name',	TYPE_TEXT, ['label' => 'Champs de recherche', 'placeholder' => 'Call of...']);
                $form->addInput('platform_id',	TYPE_SELECT, ['label' => 'Plateforme', 'data' => $_platforms, 'empty' => 'Toutes les plateformes', 'class' => 'select2']);
                $form->addInput('publisher_id',	TYPE_SELECT, ['label' => 'Editeur', 'data' =>  $_publishers, 'empty' => 'Tous les éditeurs', 'class' => 'select2']);
                $form->addInput('family_id',	TYPE_SELECT, ['label' => 'Genre', 'data' => $_families, 'empty' => 'Tous les genres', 'class' => 'select2']);
                $form->addInput('note',	TYPE_RADIO, ['data' => [0 => 'Toutes les notes', 6 => '6+', 7 => '7+', 8 => '8+', 9 => '9+'], 'checked' => 0]);

                $form->setSubmit('Rechercher', ['color' => SUCCESS, 'class' => 'mt-4']);
                echo $form->form();
			?>
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
					</div>
				</div>

			<?php endforeach; ?>
		</div>
</div>