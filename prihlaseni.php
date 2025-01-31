<?php
    require __DIR__.'/vendor/autoload.php';
    use PhpPkg\EasyTpl\EasyTemplate;

    require_once 'db.php';

    // overit id, text

    // TODO: prihlasovani
    $email = htmlspecialchars($_POST["email"]);
    $heslo = $_POST["heslo"];


    $query = $db->prepare('SELECT * FROM uzivatele WHERE email = :email');
    $query->execute([":email" => $email]);

    // TODO: neexistujici uzivatel
    $uzivatel = $query->fetchAll(PDO::FETCH_ASSOC)[0];

    if (password_verify($heslo, $uzivatel['heslo'])) {
      session_start();
      $_SESSION['prihlaseny_uzivatel_id'] = $uzivatel['id'];
      $_SESSION['prihlaseny_uzivatel_email'] = $uzivatel['email'];
    }

    header("Location: index.php");

    // $et = EasyTemplate::new();