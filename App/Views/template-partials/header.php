<!doctype html>
<html lang="tr" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Admin Paneli - Birkanoruc.com.tr">
    <meta name="author" content="Birkan ORUÇ">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= PUBLIC_PATH ?>/images/brand/favicon.ico">

    <!-- TITLE -->
    <title>Admin Paneli - Birkanoruc.com.tr</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<?= PUBLIC_PATH ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
    <link href="<?= PUBLIC_PATH ?>/css/style.css" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="<?= PUBLIC_PATH ?>/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="<?= PUBLIC_PATH ?>/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="<?= PUBLIC_PATH ?>/switcher/css/switcher.css" rel="stylesheet">
    <link href="<?= PUBLIC_PATH ?>/switcher/demo.css" rel="stylesheet">

    <!-- SWEET-ALERT JS -->
    <script src="<?= PUBLIC_PATH ?>/plugins/sweet-alert/sweetalert.min.js"></script>
</head>

<body class="app sidebar-mini ltr light-mode">
    <?php if (\App\Helpers\Session::has("statu")) {
        foreach (\App\Helpers\Helper::flashDataView("statu") as $key => $value) {
            if ($key == "title") {
                $notificationTitle = $value;
            } else if ($key == "text") {
                $notificationText = $value;
            } else {
                $notificationType = $value;
            }
        }
        print "<script>swal({title: '" . $notificationTitle . "', text: '" . $notificationText . "', type: '" . $notificationType . "', confirmButtonText: 'Kapat' })</script>";
    }
    ?>
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="<?= PUBLIC_PATH ?>/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">