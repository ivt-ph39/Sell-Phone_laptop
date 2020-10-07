$(document).ready(function () {
    $("#file").change(function () {
        readURL(this);
    });
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#baner_review').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
