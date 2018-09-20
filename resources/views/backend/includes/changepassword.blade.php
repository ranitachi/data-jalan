{{-- modal change password --}}
<div class="main-register-wrap modal-change-password">
    <div class="main-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
            <h3>Ganti Password</h3>
            <div id="tabs-container" style="font-size:12px;margin-top:0px;">
                <div class="custom-form">
                    <form method="post" name="registerform">

                        <input type="hidden" id="id_user" value="{{ Auth::user()->id }}">

                        <label style="padding-bottom:0px;">Password Lama * </label>
                        <input type="password" style="margin-bottom:10px;" id="old_pass">
                        <label style="padding-bottom:0px;">Password Baru * </label>
                        <input type="password" style="margin-bottom:10px;" id="new_pass">
                        <label style="padding-bottom:0px;">Konfirmasi Password Baru * </label>
                        <input type="password" style="margin-bottom:10px;" id="confirm_new_pass">
                    </form>
                </div>
            </div>
            <a class="btn btn-success close-modal" id="btn-change-password">Simpan Perubahan</a>
        </div>
    </div>
</div>

<script>
    // show confirmation modal add
    $(".modal-open-cp").on('click', function(e){
        e.preventDefault();
        $('.modal-change-password').fadeIn();
        $("html, body").addClass("hid-body");
    })

    // all modal close
    $('.close-modal').on("click", function () {
        $('.modal-delete').fadeOut();
        $('.modal-add').fadeOut();
        $('.modal-edit').fadeOut();
        $('.modal-change-password').fadeOut();
        $('.modal-hasil').fadeOut();
        $('.modal-dokumentasi').fadeOut();
    });

    $('#btn-change-password').click(function(){
        var id_user = $('#id_user').val()
        var old_pass = $('#old_pass').val()
        var new_pass = $('#new_pass').val()
        var confirm_new_pass = $('#confirm_new_pass').val()

        $.ajax({
            url: "{{ url('api/change-password') }}",
            type: "POST",
            dataType: "json",
            data: {
                id_user: id_user,
                old_pass: old_pass,
                new_pass: new_pass,
                new_pass_confirmation: confirm_new_pass,
            },
            success: function(res) {
                $('#for-alert-change-password').html(
                    "<div class='alert alert-success alert-style'>" +
                        "<strong>Ou yeah,</strong> " + res.message +
                    "</div>"
                )

                closeAlert()
            }
        }).fail(function(err){
            $('#for-alert-change-password').html(
                "<div class='alert alert-danger alert-style'>" +
                    "<strong>Oops,</strong> terjadi kesalahan." +
                "</div>"
            )

            closeAlert()
        })
    })

    // close the alert
    function closeAlert() {
        setTimeout(function() {
            $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });

            $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    }
</script>