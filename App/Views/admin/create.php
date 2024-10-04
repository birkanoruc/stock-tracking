<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Admin Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Adminler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ekle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-6">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/admin/store") ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="form-label">Admin Adı</label>
                                    <input class="form-control" placeholder="Admin Adı" type="text" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="surname" class="form-label">Admin Soyadı</label>
                                    <input class="form-control" placeholder="Admin Soyadı" type="text" name="surname" id="surname">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Admin E-Posta Adresi</label>
                                    <input class="form-control" placeholder="Admin E-Posta Adresi" type="email" name="email" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Admin Şifresi</label>
                                    <input class="form-control" placeholder="Admin Şifresi" type="password" name="password" id="password">
                                </div>
                                <div class="form-group">
                                    <label for="permission" class="form-label">Admin İzinleri</label>
                                    <?php
                                    foreach (PERMISSIONS as $key => $value) {
                                    ?>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="permissions[]" value="<?= $key ?>">
                                            <span class="custom-control-label"><?= $value ?></span>
                                        </label>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success w-100">Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>