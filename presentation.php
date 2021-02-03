<?php
include('loader.php');

$html = new Bootsrap('Acceuil', 'Prsentation de ' . APP_NAME . ' !', 'fr');

// Start DOM HTML
echo $html->startDOM();

// Menu 
$html->addMenu('Presentation', 'presentation.php');
$html->addMenu('Jeux', 'jeux.php');
$html->addMenu('Inscription', 'inscription.php');
$html->setDisplayResearch(false);

echo $html->menu();


// Main content
echo $html->startMain();
?>


<div class="starter-template text-center py-5 px-3">
    <h1>Présentation du réseau ! </h1>
    <p class="lead">Lucas ipsum dolor sit amet grievous owen wedge padmé sith solo ewok dantooine skywalker skywalker. Kit kashyyyk yavin darth. Lobot twi'lek wampa antilles lars jar chewbacca solo. Obi-wan calamari mon jar solo mara dagobah. Obi-wan jinn skywalker bespin skywalker ackbar. Solo solo wicket antilles mace boba. Fett darth lando moff amidala. Fisto mustafar leia binks mandalore. Mon tatooine moff antilles ben wampa vader moff calrissian. Leia dagobah ewok lando. Boba padmé calamari binks r2-d2 darth skywalker mace.

Calrissian jade mandalore padmé lando baba darth hutt solo. Ventress hoth baba kenobi. Palpatine lobot kit mon. Qui-gonn mace dooku windu obi-wan. Cade dagobah r2-d2 yoda hoth obi-wan. Mandalorians darth ewok mustafar kenobi. Twi'lek windu wookiee owen padmé amidala leia. Moff maul antilles r2-d2 obi-wan ackbar. Maul jabba darth organa organa dooku. Mon padmé endor luke organa boba darth. Moff organa sidious darth ventress kit dooku hutt darth. Yoda alderaan darth maul calamari. Binks sith jabba grievous mara.

Kamino antilles leia solo chewbacca wedge. Darth mon yoda grievous. Jade darth qui-gon lando jinn kenobi vader ben. Mace dantooine solo skywalker yavin owen mara mothma obi-wan. Mothma boba mon wedge padmé hutt organa organa mon. Darth chewbacca antilles antilles yavin vader ackbar bothan kamino. Twi'lek c-3p0 mothma mon mara amidala lando lobot calrissian. Maul yoda k-3po calamari padmé chewbacca moff mon. Alderaan kamino ventress obi-wan. Jango kamino jango antilles skywalker wookiee mace. Anakin yoda kashyyyk jinn calamari.

Hoth skywalker lando mothma antilles leia wicket ewok. Bothan sidious gamorrean ackbar. Mandalorians thrawn qui-gonn darth skywalker baba. Ventress calamari kessel solo. Fett tatooine hutt ewok solo. Ackbar jinn yoda moff chewbacca organa antilles. Antilles windu skywalker moff mon skywalker hutt. Yoda mara kenobi antilles jar. Mon lobot antilles darth. Jade skywalker skywalker calamari cade darth anakin darth wedge. Endor sith lars moff ahsoka binks jango tatooine. Jinn calrissian darth darth.

Jade utapau mon grievous calamari jinn. Calrissian darth leia jade solo han. Hutt zabrak chewbacca ponda hutt antilles ewok. Sidious jade amidala dantooine. Antilles moff calamari gamorrean qui-gonn ben darth. Bespin baba anakin mace dagobah mara. Dooku secura jinn fett darth fett antilles jabba antilles. Bespin ventress anakin tatooine yavin qui-gon jawa baba jango. Jade calrissian darth darth antilles solo. Darth mon moff hutt skywalker solo. Wampa kashyyyk chewbacca windu ewok darth solo organa anakin.</p>
</div>


<?php
echo $html->endMain();

// End DOM HTML
echo $html->endDOM();
