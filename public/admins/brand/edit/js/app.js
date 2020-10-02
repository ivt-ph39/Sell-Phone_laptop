$(document).ready(function () {
    $("#file").change(function () {
        readURL(this);
    });
    $(document).on('click', '.delete_avatar', function () {
        if (confirm('Bạn Muốn Thay Đổi Avatar')) {
            $('.delete_avatar').addClass('d-none');
            $('.add_avatar').removeClass('d-none');
            $("#input_delete_avatar").val(1);
        };
    })
    var attrAdd = $("#message_add_avatar").attr('data-add_avatar');
    if (attrAdd == 'Avatar phải là ảnh' || attrAdd == 'Avatar không được để trống') {
        $('.delete_avatar').addClass('d-none');
        $('.add_avatar').removeClass('d-none');
    }
})
// function XL xem truoc anh.
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_upload_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
