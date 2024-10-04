<!-- app-Header -->
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="index.html">
                <img src="<?= PUBLIC_PATH ?>/images/brand/icon-white.png" class="header-brand-img desktop-logo" alt="logo" style="max-height:36px;">
                <img src="<?= PUBLIC_PATH ?>/images/brand/icon-dark.png" class="header-brand-img light-logo1" alt="logo" style="max-height:36px;">
            </a>
            <!-- LOGO -->
            <div class="main-header-center ms-3 d-none d-lg-block">
                <form action="<?= \App\Helpers\Helper::route("/") ?>" method="GET">
                    <input type="text" class="form-control" id="typehead" name="search" placeholder="Ürünler içerisinde ara...">
                    <button class="btn px-0 pt-2" type="submit"><i class="fe fe-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-lg-none d-flex">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Ara....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FULL-SCREEN -->
                        <div class="dropdown d-flex">
                            <a class="nav-link icon full-screen-link nav-link-bg">
                                <i class="fe fe-minimize fullscreen-button"></i>
                            </a>
                        </div>
                        <!-- END FULL-SCREEN -->
                    </div>
                </div>

                <div class="dropdown d-flex profile-1">
                    <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                        <?php
                        if (\App\Helpers\AuthHelpers::getUserInfo()['image'] != "") {
                        ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode(\App\Helpers\AuthHelpers::getUserInfo()['image']) ?>" alt="profile-user" class="avatar  profile-user brround cover-image">
                        <?php
                        } else {
                        ?>
                            <img src="<?= PUBLIC_PATH ?>/images/users/empty.jpg" alt="profile-user" class="avatar profile-user brround cover-image">
                        <?php
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-0 fs-14 fw-semibold">
                                    <?= \App\Helpers\AuthHelpers::getUserFullname(); ?>
                                </h5>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item" href="<?= \App\Helpers\Helper::route("/profile") ?>">
                            <i class="dropdown-icon fe fe-user"></i> Profil
                        </a>

                        <a class="dropdown-item" href="<?= \App\Helpers\Helper::route("/auth/logout") ?>">
                            <i class="dropdown-icon fe fe-alert-circle"></i> Çıkış Yap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>