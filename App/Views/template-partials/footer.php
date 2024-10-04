</div>
<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                Copyright © <span id="year"></span> <a href="https://www.birkanoruc.com.tr" target="_blank">Birkan Oruç</a>. Tüm hakları saklıdır.
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER CLOSED -->
</div>


<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JQUERY JS -->
<script src="<?= PUBLIC_PATH ?>/js/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?= PUBLIC_PATH ?>/plugins/bootstrap/js/popper.min.js"></script>
<script src="<?= PUBLIC_PATH ?>/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- TypeHead js -->
<script src="<?= PUBLIC_PATH ?>/plugins/bootstrap5-typehead/autocomplete.js"></script>
<script src="<?= PUBLIC_PATH ?>/js/typehead.js"></script>

<!-- FILE UPLOADES JS -->
<script src="<?= PUBLIC_PATH ?>/plugins/fileuploads/js/fileupload.js"></script>
<script src="<?= PUBLIC_PATH ?>/plugins/fileuploads/js/file-upload.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="<?= PUBLIC_PATH ?>/plugins/p-scroll/perfect-scrollbar.js"></script>

<!-- SIDE-MENU JS -->
<script src="<?= PUBLIC_PATH ?>/plugins/sidemenu/sidemenu.js"></script>

<!-- SIDEBAR JS -->
<script src="<?= PUBLIC_PATH ?>/plugins/sidebar/sidebar.js"></script>

<!-- Color Theme js -->
<script src="<?= PUBLIC_PATH ?>/js/themeColors.js"></script>

<!-- Sticky js -->
<script src="<?= PUBLIC_PATH ?>/js/sticky.js"></script>

<!-- CUSTOM JS -->
<script src="<?= PUBLIC_PATH ?>/js/custom.js"></script>

<!-- Custom-switcher -->
<script src="<?= PUBLIC_PATH ?>/js/custom-swicher.js"></script>

<!-- Switcher js -->
<script src="<?= PUBLIC_PATH ?>/switcher/js/switcher.js"></script>

<script>
    $(document).ready(function() {

        if ($('input[name^="attributes["]').length === 0) {
            var i = $(".attributesCount").length;
        } else {
            var sonInput = $('input[name^="attributes["]').last();
            var nameDegeri = sonInput.attr('name');
            var numara = nameDegeri.match(/\[(.*?)\]/)[1];
            var i = numara;
            i++
        }
        $("#addAttiributes").click(function() {
            var temp = '<div class="row">' +
                '<div class="col-xl-5">' +
                '<label class="form-label">Ürün Özellik Adı</label>' +
                '<input class="form-control attributesCount" type="text" name="attributes[' + i + '][name]">' +
                '</div>' +
                '<div class="col-xl-5">' +
                '<label class="form-label">Ürün Özellik Değeri</label>' +
                '<input class="form-control" type="text" name="attributes[' + i + '][value]">' +
                '</div>' +
                '<div class="form-group col-xl-2">' +
                '<label for="deleteAttributes" class="form-label">Sil</label>' +
                '<button type="button" class="btn btn-danger w-100 text-light" id="deleteAttributes"><i class="fa fa-trash"></i></button>' +
                '</div>' +
                '</div>';
            $("#attiributesDiv").append(temp);
            i++;
        });

        $("body").on("click", "#deleteAttributes", function() {
            $(this).closest(".row").remove();
        });
    });


    $(document).ready(function() {

        if ($('input[name^="products["]').length === 0) {
            var i = $(".productCount").length;
        } else {
            var sonInput = $('input[name^="products["]').last();
            var nameDegeri = sonInput.attr('name');
            var numara = nameDegeri.match(/\[(.*?)\]/)[1];
            var i = numara;
        }

        $("#addProduct").click(function() {
            $.ajax({
                url: "/order/products",
                dataType: "json",
                success: function(result) {
                    var temp = '<div class="row">' +
                        '<div class="form-group col-xl-4">' +
                        '<label class="form-label">Ürün Adı</label>' +
                        '<select class="form-control form-select productCount" data-bs-placeholder="Ürün Seç" name="products[' + i + '][id]">';
                    $.each(result, function(key, value) {
                        temp += '<option value="' + value.id + '">' + value.name + '</option>';
                    });

                    temp += '</select>' +
                        '</div>' +
                        '<div class="form-group col-xl-3">' +
                        '<label class="form-label">Ürün Adedi</label>' +
                        '<input class="form-control" type="number" name="products[' + i + '][quantity]">' +
                        '</div>' +
                        '<div class="form-group col-xl-3">' +
                        '<label class="form-label">Ürün Birim Fiyatı</label>' +
                        '<input class="form-control" type="number" step="0.01" name="products[' + i + '][price]">' +
                        '</div>' +
                        '<div class="form-group col-xl-2">' +
                        '<label for="deleteProduct" class="form-label">Sil</label>' +
                        '<button type="button" class="btn btn-danger w-100 text-light" id="deleteProduct"><i class="fa fa-trash"></i></button>' +
                        '</div>' +
                        '</div>';
                    $("#productsDiv").append(temp);
                }
            });
            i++;
        });

        $("body").on("click", "#deleteProduct", function() {
            $(this).closest(".row").remove();
        });
    });
</script>
</body>

</html>