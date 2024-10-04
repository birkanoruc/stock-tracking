<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Müşteri Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Müşteriler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ekle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-6">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/customer/store") ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-gruop">
                                        <label for="name" class="form-label">Müşteri Adı</label>
                                        <input class="form-control" placeholder="Müşteri Adı" type="text" name="name" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="surname" class="form-label">Müşteri Soyadı</label>
                                        <input class="form-control" placeholder="Müşteri Soyadı" type="text" name="surname" id="surname">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Müşteri E-Posta Adresi</label>
                                        <input class="form-control" placeholder="Müşteri E-Posta Adresi" type="email" name="email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Müşteri Telefon Numarası</label>
                                        <input class="form-control" placeholder="Müşteri Telefon Numarası" type="phone" name="phone" id="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="form-label">Müşteri Adresi</label>
                                        <textarea class="form-control" placeholder="Müşteri Adresi" type="text" name="address" id="address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="form-label">Müşteri Notu</label>
                                        <textarea class="form-control" placeholder="Müşteri Notu" type="text" name="note" id="note"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" class="form-label">Müşteri Şirketi</label>
                                        <input class="form-control" placeholder="Müşteri Şirketi" type="text" name="company" id="company">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success w-100">Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>