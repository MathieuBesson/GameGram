<div class="starter-template text-center mt-5 px-3">
	<h1>Mon Compte</h1>
	<p class="lead">Remplir le formulaire pour modifier vos informations</p>
</div>

<div class="row justify-content-center">
	<div class="col col-sm-8 col-lg-4">
	<?php
	
	$form = new BootstrapForm('Modification compte', 'User', METHOD_POST);

	$form->addInput('username',	TYPE_EMAIL, 	['label' => 'Adresse mail', 'placeholder' => 'Pour spammer ta boite mail chaque jour', 'value' => $Auth->User->username]);
	$form->addInput('password', TYPE_PASSWORD, 	['label' => 'Mot de passe', 'placeholder' => '8 caractères minimum']);
	$form->addInput('pseudo', 	TYPE_TEXT, 		['label' => 'Pseudo', 'placeholder' => 'Quelque chose d\'unique, qui te caractérise !', 'value' => $Auth->User->pseudo]);
	$form->addInput('nb_jeux', 	TYPE_NUMBER, 	['label' => 'Nombre de jeux', 'min' => 0, 'max' => 1000, 'step' => 1, 'placeholder' => 'Pour savoir quel joueur tu es', 'value' => $Auth->User->nb_games]);
	
	$form->setSubmit('Modifier', ['color' => WARNING]);
	
	echo $form->form();
	?>
	</div>
</div>