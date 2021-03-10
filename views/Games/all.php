<div class="starter-template text-center mt-5 px-3">
	<h1>Liste des jeux</h1>
	<p class="lead">Découvre la liste de jeux disponibles dans <?= NAME_APPLICATION ?> ! </p>
</div>
<div class="row justify-content-center">
	<div class="col col-md-6">
		<p class="lead text-center mb-5">Il y a actuellement <strong><?= count($_listOfGames); ?></strong> jeux dans la base de données</p>
		<p class="text-center">
			<?php
			if($Auth->logged){
				echo $html->button('Recherche', ['dir' => 'games', 'page' => 'search', ['color' => WARNING]]);
			}

			// $form = new BootstrapForm('Recherche', 'Games', METHOD_GET);

			// $form->addInput('key_word',	TYPE_TEXT, ['label' => 'Champs de recherche', 'placeholder' => 'Call of...']);		

			// $form->setSubmit('Rechercher', ['color' => SUCCESS]);

			// echo $form->form();
			?>
		</p>
		<div class="row d-flex justify-content-between">
			<?php foreach ($_listOfGames as $jeu) : ?>
				<div class="card m-3 col-5">
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
</div>