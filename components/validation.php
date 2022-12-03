<script src="./assets/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(() => {
        $('#email').on('focusout', function(e) {
            var email = $('#email').val();
            $.ajax({
                url: "checkemail.php",
                type: "POST",
                data: {
                    "submit_data": 1,
                    "email_id": email,
                },
                success: function(res) {
                    if (res == '') {
                        enableButton();
                        $("#email-error").html('');
                    } else {
                        $("#email-error").html(res);
                        disableButton();
                    }
                }
            })
        })

        $('#nicno').on('focusout', function(e) {
            var nicno = $('#nicno').val();
            $.ajax({
                url: "components/checknic.php",
                type: "POST",
                data: {
                    "submit_nic": 1,
                    "nic_id": nicno,
                },
                success: function(res) {
                    if (res == '') {
                        enableButton();
                        $("#nicno-error").html('');
                    } else {
                        $("#nicno-error").html(res);
                        disableButton();
                    }
                }
            })
        })

    })

    cimg = 'cimg';
    pimg = 'pimg';
    var ext = ['png', 'jpg', 'jpeg'];
    $(`#${cimg}`).on('click', () => {
        var error = '';
        $(`#${cimg}`).change((e) => {
            if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                error += (`<b>Invalid !</b> ${e.target.files[0].name}. Please upload image of given formate (png, jpeg , jpg)`);
            } else {
                error = '';
            }

            if (error) {
                $(`#${cimg}-error`).html(error);
                disableButton();
            } else {
                $(`#${cimg}-error`).html('');
                enableButton();
            }
        })
    })
    $(`#${pimg}`).on('click', () => {
        var error = '';
        $(`#${pimg}`).change((e) => {
            if (e.target.files[0].type !== 'image/png' && e.target.files[0].type !== 'image/jpeg' && e.target.files[0].type !== 'image/jpg') {
                error += (`<b>Invalid !</b> ${e.target.files[0].name}. Please upload image of given formate (png, jpeg , jpg)`);
            } else {
                error = '';
            }

            if (error) {
                $(`#${pimg}-error`).html(error);
                disableButton();
            } else {
                $(`#${pimg}-error`).html('');
                enableButton();
            }
        })
    })

    //------------ Password Show or hide ---------------
    function hideorshow(val) {
        if ($(`#${val}`).attr('type') == 'password') {
            $(`#${val}`).attr('type', 'text');
        } else {
            $(`#${val}`).attr('type', 'password');
        }
    }

    //-------------------------------------------------
    //--------------- Form validation ---------------//
    // ------------------------------------------------

    var ptrn = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    var nameptrn = /^(?=.{4,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;
    var emailPtrn = /([a-z|0-9]+@gmail\.com|@yahoo\.com|@email\.com|@hotmail\.com)$/i;
        var phonePtrn = /^(?:7|0|(?:\+94))[-]{1}[0-9]{2}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/;
        var nicPtrn = /^([0-9]{9}[x|X|v|V])$/;

    function disableButton() {
        $('#regist-btn').attr('disabled', 'disabled');
        $('#regist-btn').css("background-color", "grey");
    }

    function enableButton() {
        $('#regist-btn').removeAttr('disabled');
        $('#regist-btn').removeAttr('style');
    }
    $('#fname').keyup(() => {
        var val = $('#fname').val().length;
        if (!nameptrn.test($('#fname').val())) {
            $('#fname-error').html('<b>Invalid !</b> First name must be Greater then 4 Character');
            disableButton();
        } else {
            $('#fname-error').html('');
            enableButton();
        }
    })
    $('#lname').keyup(() => {
        var val = $('#lname').val().length;
        if (!nameptrn.test($('#lname').val())) {
            $('#lname-error').html('<b>Invalid !</b> Last name must be Greater then 4 Character');
            disableButton();
        } else {
            $('#lname-error').html('');
            enableButton();
        }
    })

    $('#paswrd').keyup(() => {
        var val = $('#paswrd').val().length;
        if (!ptrn.test($('#paswrd').val())) {
            $('#pass-error').html('<b>Invalid !</b> Password must contain one letter, one number, & one special character');
            disableButton();
        } else {
            $('#pass-error').html('');
            enableButton();
        }
    })

    $('#cpaswrd').keyup(() => {
        var cpas = ($('#cpaswrd').val()).length;
        var pas = ($('#paswrd').val()).length;

        if (pas === cpas) {
            var cpasval = $('#cpaswrd').val();
            var pasval = $('#paswrd').val();

            if (cpasval !== pasval) {
                $('#cpass-error').html('<b>Invalid !</b> Both password must be same');
                disableButton();
            } else {
                $('#cpass-error').html('');
                enableButton();
            }
        } else {
            $('#cpass-error').html('<b>Invalid !</b> Both password must be same');
            disableButton();
        }

    })
    
    $('#phone').blur(() => {
        if (phonePtrn.test($('#phone').val())) {
            $('#phone-error').html('');
            $('#phone-error1').html('');
            enableButton();
        } else {
            $('#phone-error').html('<b>Invalid !</b> phone number');
            $('#phone-error1').html('Please follow this formate <b>+94-11-123-4567</b>');
            disableButton();
        }
    })
</script>
