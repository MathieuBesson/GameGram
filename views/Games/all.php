<div class="starter-template text-center mt-5 px-3">
	<h1>Liste des jeux</h1>
	<p class="lead">Découvre la liste de jeux disponibles dans <?= NAME_APPLICATION ?> ! </p>
</div>
<div class="row justify-content-center">
	<div class="col col-md-6">
		<p class="lead text-center mb-5">Il y a actuellement <strong><?= count($_listOfGames); ?></strong> jeux dans la base de données</p>
		<?php

		$form = new BootstrapForm('Recherche', 'Games', METHOD_GET);

		$form->addInput('key_word',	TYPE_TEXT, ['label' => 'Champs de recherche', 'placeholder' => 'Call of...']);
		// $form->addInput('publisher', TYPE_SELECT, ['label' => 'Créateur']);
		// $form->addInput('plateform', TYPE_SELECT, ['label' => 'Plateform']);
		// $form->addInput('family', TYPE_SELECT, ['label' => 'Famille de jeu']);
		// $form->addInput('Note', TYPE_RADIO, ['label' => 'Adresse mail', 'placeholder' => 'Pour spammer ta boite mail chaque jour']);

		

		$form->setSubmit('Rechercher', ['color' => SUCCESS]);

		echo $form->form();
		?>
		<?php foreach ($_listOfGames as $jeu) : ?>
			<div class="card mb-2 mt-3 col-3 d-flex justify-content-between">
				<div class="card-body">
					<span class="badge bg-success float-end"><?= $jeu->year; ?></span>
					<h5 class="card-title"><?= ucfirst($jeu->name) ?> </h5>
					<p class="card-text">Note du public : <strong><?= $jeu->note; ?></strong>/10</p>
					<?= $html->button('Voir le jeu', ['dir' => 'games', 'page' => 'one', 'options' => ['id' => $jeu->id]], ['color' => SUCCESS, 'class' => 'btn-sm']); ?>
				</div>
			</div>

		<?php endforeach; ?>
	</div>
</div>

<!-- Recherche en fonction de : 


champs de texte -> Like 
Publisher -> Models 
Plateform 
Family 
Note -> Radio bootstrapForm

------- -> GamesViewController


Système de gestion de collection de jeux 
Système de suggestion de jeux 
-->