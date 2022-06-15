<?php

declare(strict_types=1);

namespace App\Controller;

class Login implements Controller
{
    public function render()
    {
        echo '
            <h1>Connexion</h1>
            <form method="post" action="">
                <label for="username">Nom d\'utilisateur : </label>
                <input type="text" name="username" id="username" /> <br />
                <label style="display: inline-block; margin-top: 10px;" for="admin">Connexion en tant qu\'administrateur : </label>
                <input type="checkbox" name="admin" id="admin" />
                <input style="display: block; margin-top: 10px;" type="submit" value="Connexion" />
            </form>
        ';

        if (isset($_POST['username'])) {
            $_SESSION['username'] = htmlspecialchars($_POST['username']);

            if (isset($_POST['admin'])) {
                $_SESSION['admin'] = htmlspecialchars($_POST['admin']);
            }

            header('location: /');
        }
    }
}
