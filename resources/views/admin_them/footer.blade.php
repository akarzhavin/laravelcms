</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="/js/app.js"></script>

<script>
    function addNewImg () {
        var key = $('.table-striped tr').length;
        $('.table-striped tr').eq(-2).after('<tr><th><input checked="checked" name="images_main" value="0" type="radio"></th> <td><div class="img-product-form"><img class="placeholder" src="/img/admin/add-image.png" alt=""> <input id="" name="images[' + key + '][file]" class="img-input" type="file"></div></td> <td><input name="images[' + key + '][order]" value="0" class="form-control" type="number"></td> <td><button type="button" onclick="$(this).parent(".form-group").remove();" class="btn btn-danger btn-img-product-form"><i aria-hidden="true" class="fa fa-minus-circle"></i></button></td></tr>');
    }
    //Products изменение картинки ajax
    $("table").delegate(".img-input", "change", function (event) {
        $(this).siblings('.placeholder').attr('src', URL.createObjectURL(event.target.files[0]));
    });

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
        $('.quantityVariableTr').last().after('<tr class="quantityVariableTr"><td><input name="values[' + key + '][value]" value="" class="form-control quantityVariable" type="text"></td></tr>');
    };
</script>

</body>
</html>