<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="<?= SITE_URL ?>">
                <img src="<?= PUBLIC_PATH ?>/images/brand/icon-white.png" class="header-brand-img desktop-logo" alt="logo" style="max-height:36px;">
                <img src="<?= PUBLIC_PATH ?>/images/brand/icon-white.png" class="header-brand-img toggle-logo" alt="logo">
                <img src="<?= PUBLIC_PATH ?>/images/brand/icon-dark.png" class="header-brand-img light-logo" alt="logo">
                <img src="<?= PUBLIC_PATH ?>/images/brand/icon-dark.png" class="header-brand-img light-logo1" alt="logo" style="max-height:36px;">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <a class="side-menu__item has-link" data-bs-toggle="slide" href="<?= SITE_URL ?>"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">Ana Sayfa</span></a>

                <?php
                if (\App\Middlewares\Auth::isPermission(0)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-puzzle-piece"></i>
                            <span class="side-menu__label">Kategoriler</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Kategoriler</a></li>
                            <li><a href="<?= SITE_URL ?>/category" class="slide-item">Kategori Listesi</a></li>
                            <li><a href="<?= SITE_URL ?>/category/create" class="slide-item">Kategori Ekle</a></li>
                        </ul>
                    </li>
                <?php
                }
                if (\App\Middlewares\Auth::isPermission(1)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-university"></i>
                            <span class="side-menu__label">Kasalar</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Kasalar</a></li>
                            <li><a href="<?= SITE_URL ?>/cash" class="slide-item">Kasa Listesi</a></li>
                            <li><a href="<?= SITE_URL ?>/cash/create" class="slide-item">Kasa Ekle</a></li>
                        </ul>
                    </li>
                <?php
                }
                if (\App\Middlewares\Auth::isPermission(2)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-product-hunt"></i>
                            <span class="side-menu__label">Ürünler</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Ürünler</a></li>
                            <li><a href="<?= SITE_URL ?>/product" class="slide-item">Ürün Listesi</a></li>
                            <li><a href="<?= SITE_URL ?>/product/create" class="slide-item">Ürün Ekle</a></li>
                            <li><a href="<?= SITE_URL ?>/product/import" class="slide-item">Ürün İçe Aktar</a></li>
                        </ul>
                    </li>
                <?php
                }
                if (\App\Middlewares\Auth::isPermission(3)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-users"></i>
                            <span class="side-menu__label">Müşteriler</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Müşteriler</a></li>
                            <li><a href="<?= SITE_URL ?>/customer" class="slide-item">Müşteri Listesi</a></li>
                            <li><a href="<?= SITE_URL ?>/customer/create" class="slide-item">Müşteri Ekle</a></li>
                        </ul>
                    </li>
                <?php
                }
                if (\App\Middlewares\Auth::isPermission(4)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-shopping-bag"></i>
                            <span class="side-menu__label">Stoklar</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Stoklar</a></li>
                            <li><a href="<?= SITE_URL ?>/stock" class="slide-item">Stok Listesi</a></li>
                            <li><a href="<?= SITE_URL ?>/stock/create" class="slide-item">Stok Ekle</a></li>
                        </ul>
                    </li>
                <?php
                }
                if (\App\Middlewares\Auth::isPermission(5)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-id-card"></i>
                            <span class="side-menu__label">Faturalar</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Faturalar</a></li>
                            <li><a href="<?= SITE_URL ?>/invoice" class="slide-item">Fatura Listesi</a></li>
                            <li><a href="<?= SITE_URL ?>/invoice/create" class="slide-item">Fatura Ekle</a></li>
                        </ul>
                    </li>
                <?php
                }
                if (\App\Middlewares\Auth::isPermission(6)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-file"></i>
                            <span class="side-menu__label">Raporlar</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Raporlar</a></li>
                            <li><a href="<?= SITE_URL ?>/report/product" class="slide-item">Ürün Raporu</a></li>
                            <li><a href="<?= SITE_URL ?>/report/customer" class="slide-item">Müşteri Raporu</a></li>
                            <li><a href="<?= SITE_URL ?>/report/cash" class="slide-item">Kasa Raporu</a></li>
                            <li><a href="<?= SITE_URL ?>/report/invoice" class="slide-item">Fatura Raporu</a></li>
                            <li><a href="<?= SITE_URL ?>/report/date" class="slide-item">Tarih Bazlı Rapor</a></li>
                        </ul>
                    </li>
                <?php
                }
                if (\App\Middlewares\Auth::isPermission(8)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-shopping-cart"></i>
                            <span class="side-menu__label">Siparişler</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Siparişler</a></li>
                            <li><a href="<?= SITE_URL ?>/order" class="slide-item">Sipariş Listesi</a></li>
                            <li><a href="<?= SITE_URL ?>/order/create" class="slide-item">Sipariş Ekle</a></li>
                        </ul>
                    </li>
                <?php
                }
                if (\App\Middlewares\Auth::isPermission(7)) {
                ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa fa-user"></i>
                            <span class="side-menu__label">Adminler</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Adminler</a></li>
                            <li><a href="<?= SITE_URL ?>/admin" class="slide-item">Admin Listesi</a></li>
                            <li><a href="<?= SITE_URL ?>/admin/create" class="slide-item">Admin Ekle</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
</div>