$(document).ready(function () {
    $('.select-parent').select2({
        theme: "classic",
        placeholder: "Chọn danh mục cha",
        allowClear: true
    });

    $("#icon").change(function () {
        value = $(this).val();
        $('#icon_preview').attr('class', 'fas fa-3x ' + value);
    });
    $("#file").change(function () {
        readURL(this);
    });

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
