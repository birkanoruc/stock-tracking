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
    <title>Giriş Yap - Birkanoruc.com.tr</title>

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

<body class="app sidebar-mini ltr login-img">
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
    <div class="">

        <div id="global-loader">
            <img src="<?= PUBLIC_PATH ?>/images/loader.svg" class="loader-img" alt="Loader">
        </div>

        <div class="page">
            <div class="">
                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form action="<?= \App\Helpers\Helper::route(url: "/auth/attemp") ?>" method="POST" class="login100-form validate-form">
                            <span class="login100-form-title pb-5">
                                Giriş Ekranı
                            </span>
                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 form-control ms-0" type="email" placeholder="E-Posta" name="email">
                            </div>
                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 form-control ms-0" type="password" placeholder="Şifre" name="password">
                            </div>

                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-primary">
                                    Giriş Yap
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JQUERY JS -->
    <script src="<?= PUBLIC_PATH ?>/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="<?= PUBLIC_PATH ?>/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= PUBLIC_PATH ?>/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="<?= PUBLIC_PATH ?>/js/show-password.min.js"></script>

    <!-- GENERATE OTP JS -->
    <script src="<?= PUBLIC_PATH ?>/js/generate-otp.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="<?= PUBLIC_PATH ?>/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="<?= PUBLIC_PATH ?>/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="<?= PUBLIC_PATH ?>/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="<?= PUBLIC_PATH ?>/js/custom-swicher.js"></script>

    <!-- Switcher js -->
    <script src="<?= PUBLIC_PATH ?>/switcher/js/switcher.js"></script>

</body>

</html>