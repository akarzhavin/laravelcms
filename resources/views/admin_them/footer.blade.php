</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="/js/app.js"></script>

<script>
    //Кнопка добавления нового поля для загрузки картинок Products
    function addNewImg () {
        var key = $('.imgKey').length;
        $('.imgKey').last().after('<div class="form-group form-row align-items-center imgKey"><input name="images_main" value="' + key + '" type="radio"><label for="images[' + key + '][file]" class="col-md-1 col-xs-2">New image</label> <label class="custom-file"><input id="" name="images[' + key + '][file]" class="custom-file-input" onclick="nameImgProduct()" type="file"> <span class="custom-file-control"></span></label> <label for="images[' + key + '][order]">Order</label> <input name="images[' + key + '][order]" value="0" id="images[' + key + '][order]" class="form-control col-md-2 col-xs-3" type="number"> <img src="" alt="placeholder"></div>');
    }
    //Добавляет путь картинки к input в Products
    function nameImgProduct() {
        $('.custom-file-input').on('change', function () {
            $(this).next('.custom-file-control').addClass("selected").html($(this).val());
        })
    }

    //Features оключение полей при определённом включенном поле (тест)
    $("#awesome").change(function() {
        if($(this).val() == 'CheckSingle') {
            $('#awesomee').attr('disabled', true);
        } else {
            $('#awesomee').attr('disabled', false);
        }
    });

    //Features добавление полей вариантов
    function addNewVariable () {
        var key = $('.quantityVariable').length;
        $('.quantityVariableTr').last().after('<tr class="quantityVariableTr"><td><input name="values[' + key +'][value]" value="" class="form-control quantityVariable" type="text"></td></tr>');
    }
</script>

</body>
</html>