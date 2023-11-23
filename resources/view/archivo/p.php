
<section class="wrapper style3 container special-alt">
                <div class="col-4 col-12-small">
                    <div class="input-container">
                        <i class="fas fa-dollar-sign icon-input"></i>
                        <input type="text" id="form_1_precio" placeholder="Precio" name="precio" value="" maxlength="20"
                            required="" autocomplete="off">
                    </div>
                </div>
            </section>



<script>
    $('#form_1_precio').keyup(function() {
        $(this).val(formatMoney($(this).val()));
    });

    function formatMoney($input) {

        $input = parseInt($input.toString().replace(/\D/g, ''), 10);
        $input = $input.toLocaleString();
        return $input;
    }
    </script>


