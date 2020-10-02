$(document).ready(function () {
    $('.select-category').select2({
        theme: "classic",
        placeholder: "Chọn danh mục",
        allowClear: true
    });
    $('.select-brand').select2({
        theme: "classic",
        placeholder: "Chọn danh mục",
        allowClear: true
    });
    $(".select2_p_keyword_seo").select2({
        tags: true,
        placeholder: "Thêm tag",
        tokenSeparators: [","]
    });
    $("#add_p_technical").click(function () {
        var content =
            '<tr>' +
            '<td>' +
            '<input type="text" class="form-control " name="name_p_technical[]" placeholder="Màn hình">' +
            '</td>' +
            '<td>' +
            '<input type="text" class="form-control " name="value_p_technical[]" placeholder="AMOLED, 6.4in, Full HD+" >' +
            '</td >' +
            '</tr > ';
        $("#main_p_technical").append(content);
    });

    $("#add_p_promotion").click(function () {
        var content = '<input type="text" class="form-control mb-2" name="p_promotion[]" placeholder="Nộ dung khuyến mãi"> ';
        $("#main_p_promotion").append(content);
    });
    $("#btn-add-images").click(function () {
        $("#add-images").toggle();
    });
    $(document).on('click', '#delete_avatar', function () {
        confirm(" Bạn muốn xóa Avatar hiện tại !");
        $("#show_avatar_old").remove();
        $("#add_avatar_new").removeClass('d-none');
    });
    $(document).on('click', '.delete_img_detail', function () {
        $(this).parent().parent().remove();

        var count_img = $("#count_img_detail").attr("data-count_img_detail") - 1;

        $("#count_img_detail").html('');
        $("#count_img_detail").html(count_img);
        $("#count_img_detail").attr("data-count_img_detail", count_img);

        if (count_img == 0) {
            $(".show_img_detail").remove();
            $("#add-images").css("display", "block");
        }
    })
})

$("#p_image_detail").fileinput({
    showUpload: false,
    theme: "fas",
    removeTitle: "Xoa tat"
});
$("#p_avatar").fileinput({
    showUpload: false,
    theme: "fas",
    removeTitle: "Xoa tat"
});
