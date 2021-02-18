<?php
//5555555.M
class UsersProcessController extends Controller
{
    public $User;

    public function __construct()
    {
        parent::__construct();
        $this->User = new User();
    }

    public function inscriptionNewUser()
    {
        $validator = new Validator($_POST, ['dir' => 'users', 'page' => 'inscription']);

        $validator->validateEmail('username');
        $validator->validateLength('password', 8);
        $validator->validateLength('pseudo', 4);
        $validator->validateNumeric('nb_jeux');
        $validator->validateUnique('username', 'users.username');
        $validator->validateUnique('pseudo', 'users.pseudo');
        $validator->validatePassword('password', 8);
        $validator->crypt('password');
        $data = $validator->getData();

        $this->User->create(
            $data['username'],
            $data['password'],
            $data['pseudo'],
            $data['nb_jeux']
        );

        $this->Alert->setAlert('Compte créé avec succès !', ['color' => SUCCESS]);
        $this->Alert->redirect(['dir' => 'users', 'page' => 'connexion']);
    }

    public function connexion()
    {
        $validator = new Validator($_POST, ['dir' => 'users', 'page' => 'connexion']);
        $validator->validateEmail('username');
        $validator->validatePassword('password', 8);
        $validator->crypt('password');
        $data = $validator->getData();

        if (!$this->User->login($data['username'], $data['password'])) {
            $this->Alert->setAlert('Mauvaise combinaison login / mot de passe', ['color' => DANGER]);
            $this->Alert->redirect(['dir' => 'users', 'page' => 'connexion']);
        }

        $this->Auth->setUser($this->User->id);

        $this->Alert->setAlert('Welcome back ' . $this->Auth->User->pseudo . ' !', ['color' => SUCCESS]);
        $this->Alert->redirect(['dir' => 'posts', 'page' => 'feed']);
    }

    public function modificationCompte()
    {
        if (strlen($_POST['password']) === 0) {
            unset($_POST['password']);
        }

        $validator = new Validator($_POST, ['dir' => 'users', 'page' => 'mon_compte']);

        $validator->validateEmail('username');
        $validator->validateLength('pseudo', 4);
        $validator->validateNumeric('nb_jeux');


        if (isset($_POST['password'])) {
            $validator->validatePassword('password', 8);
            $validator->crypt('password');
        }

        $data = $validator->getData();

        if ($data['username'] !== $this->Auth->User->username) {
            $validator->validateUnique('username', 'users.username');
        }

        if ($data['pseudo'] !== $this->Auth->User->pseudo) {
            $validator->validateUnique('pseudo', 'users.pseudo');
        }

        $this->User->changeInformations(
            $this->Auth->User->id,
            [
                'username' => ['value' => $data['username'], 'type' => PDO::PARAM_STR],
                'password' => ['value' => $data['password'], 'type' => PDO::PARAM_STR],
                'pseudo' => ['value' => $data['pseudo'], 'type' => PDO::PARAM_STR],
                'nb_games' => ['value' => $data['nb_jeux'], 'type' => PDO::PARAM_STR],
            ]
        );

        $this->Alert->setAlert('Informations modifiées avec succès !', ['color' => SUCCESS]);
        $this->Alert->redirect(['dir' => 'users', 'page' => 'mon_compte']);
    }


    public function logout()
    {
        $this->Auth->logout();

        $this->Alert->setAlert('Déconnexion OK', ['color' => SUCCESS]);
        $this->Alert->redirect(['url' => 'index.php']);
    }
}
