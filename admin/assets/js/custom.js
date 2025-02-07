












$(document).ready(function () {

    alertify.set('notifier', 'position', 'top-right');


    $(document).on('click', '.increment', function () {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue)) {
            var qtyVal = currentValue + 1;
            $quantityInput.val(qtyVal);
            productIncDec(productId, qtyVal);

        }

        window.location.reload();
    });


    $(document).on('click', '.decrement', function () {

        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue) && currentValue > 1) {
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            productIncDec(productId, qtyVal);

        }

        window.location.reload();
    });

    function productIncDec(prodId, qty) {


        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'productIncDec': true,

                'product_id': prodId,
                'quantity': qty

            },
            dataType: "json",
            success: function (response) {

                //var res =JSON.parse(response);
                //  console.log(response);
                if (response.status == 200) {
                    // window.location.reload();
                    $('#productArea').load(' #productContent');
                    alertify.success(response.message);

                } else {
                    alertify.error(response.message);
                }

            }

        });
    }




    //proceed to place order button click
    $(document).on('click', '.proceedToPlace', function () {
        console.log('proceedToPlace');
        var payment_mode = $('#payment_mode').val();
        var cphone = $('#cphone').val();
        console.log(cphone);
        if (payment_mode == '') {
            swal(" PLEASE ", "Select your payment method", "warning");
            return false;
        }

        if (cphone == '' && !$.isNumeric(cphone)) {
            swal(" PLEASE ", "Enter your Valid phone number", "warning");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'proceedToPlaceBtn': true,

                'cphone': cphone,
                'payment_mode': payment_mode

            },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    window.location.href = "orders-summery.php";

                } else if (response.status == 404) {
                    swal(response.message, response.message, response.status_type, {
                        buttons: {
                            catch: {
                                text: "Add Customer",
                                value: "catch"
                            },
                            cancel: "Cancel"
                        }
                    })
                        .then((value) => {
                            switch (value) {
                                case "catch":
                                    $('#c_phone').val(cphone);
                                    $('#addCustomerModal').modal('show');
                                    //  console.log('POP the customer add  model');
                                    break;
                                default:
                            }
                        });

                } else {
                    swal(response.message, response.message, response.status_type);
                }



            }
        });


    });



    //Add Customer  to customers table
    $(document).on('click', '.saveCustomer', function () {
        var c_name = $('#c_name').val();
        var c_phone = $('#c_phone').val();

        var c_email = $('#c_email').val();

        if (c_name != '' && c_phone != '') {

            if ($.isNumeric(c_phone)) {
                var data = {

                    'saveCustomerBtn': true,
                    'name': c_name,
                    'phone': c_phone,
                    'email': c_email,

                };

                $.ajax({
                    type: 'POST',
                    url: ' orders-code.php',
                    data: data,
                    dataType: "json",

                    success: function (response) {
                        if (response.status == 200) {
                            swal(response.message, response.message, response.status_type);
                            $('#addCustomerModal').modal('hide');
                        } else if (response.status == 422) {
                            swal(response.message, response.message, response.status_type);


                        }
                        else {
                            swal(response.message, response.message, response.status_type);

                        }


                    }

                });

            } else {

                swal("Please valid number", " ", "warning");

            }

        } else {

            swal("Please fill reauired fields", " ", "warning");

        }


    });


    // save order
    $(document).on('click', '#saveOrder', function () {
        console.log('clicked');
        $.ajax({

            type: "POST",
            url: "orders-code.php",
            data: {
                'saveOrder': true
            },
            dataType: "json",


            success: function (response) {

                if (response.status == 200) {
                    swal(response.message, response.message, response.status_type);
                    $('#orderPlaceSuccessMessage').text(response.message);
                    $('#orderSuccessModal').modal('show');




                } else {
                    swal(response.message, response.message, response.status_type);
                }
            }
        });
    });



});

