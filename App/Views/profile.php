<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Profil Düzenle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Adminler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Düzenle</li>
                    </ol>
                </div>
            </div>

            <?php
            $image = base64_encode($params["admin"]['image']);
            ?>

            <div class="row ">
                <div class="col-xl-6">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/profile/update") ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group col-xl-6">
                                    <label for="image" class="form-label">Fotoğrafınız</label>
                                    <input type="file" class="dropify" name="image" id="image" accept="image/png, image/jpeg, image/jpg, image/webp, image/gif" data-default-file="data:image/jpeg;base64,<?= $image ?>" data-bs-height="180" />
                                </div>
                                <div class="form-group">
                                    <label for="name" class="form-label">Adınız</label>
                                    <input class="form-control" placeholder="Adınız" type="text" name="name" id="name" value="<?= $params["admin"]["name"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="surname" class="form-label">Soyadınız</label>
                                    <input class="form-control" placeholder="Soyadınız" type="text" name="surname" id="surname" value="<?= $params["admin"]["surname"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">E-Posta Adresiniz</label>
                                    <input class="form-control" placeholder="E-Posta Adresiniz" type="email" name="email" id="email" value="<?= $params["admin"]["email"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Yeni Şifreniz</label>
                                    <span class="text-warning">Şifrenizi değiştirmek istemiyorsanız bu alanı boş bırakın!</span>
                                    <input class="form-control" placeholder="Admin Şifresi" type="password" name="password" id="password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success w-100">Düzenle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>