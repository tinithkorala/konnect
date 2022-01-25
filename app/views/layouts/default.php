<?php use Config\Config;
use Core\Session; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initials-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
          rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>app/css/partials/styles.css?v=<?= Config::get('version'); ?>"/>
    <link rel="stylesheet" href="<?= ROOT ?>app/css/partials/toast.css?v=<?= Config::get('version'); ?>"/>
    <script type="text/javascript" src="<?= ROOT ?>app/js/toast.js"></script>
    <title><?= $this->getSiteTitle(); ?></title>
</head>
<body>
<?php
$alert = Session::displaySessionAlerts();
if ($alert) {
    $alerts = Session::get('session_alerts');
    $type = $alerts["type"];
    $message = $alerts["message"];
    $title = $alerts["title"];
    echo "<script>triggerToast('{$type}', '{$title}' ,'{$message}');</script>";
    Session::delete('session_alerts');
}
?>
<?php $this->content('content'); ?>
</body>
</html>
