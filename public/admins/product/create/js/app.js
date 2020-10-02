$(document).ready(function () {
    $(".select2-category").select2({
        // tags: ture,
        theme: "classic",
        placeholder: "Chọn danh mục",
        allowClear: true
    });
    $(".select2-brand").select2({
        // tags: ture,
        theme: "classic",
        placeholder: "Chọn danh mục",
        allowClear: true
    });
    $(".select2_p_keyword_seo").select2({
        tags: true,
        placeholder: "Thêm tag",
        tokenSeparators: [","]
    });
    // start add technical and promotion
    $("#add_p_technical").click(function () {
        var content =
            '<tr><td><input type="text" class="form-control " name="name_p_technical[]" placeholder="Màn hình"></td> <td><input type="text" class="form-control " name="value_p_technical[]"placeholder = "AMOLED, 6.4in, Full HD+" > </td ></tr > ';
        $("#main_p_technical").append(content);
    });
    $("#add_p_promotion").click(function () {
        var content =
            '<input type="text" class="form-control mb-2" name="p_promotion[]" placeholder="Nộ dung khuyến mãi"> ';
        $("#main_p_promotion").append(content);
    });
    /* end add technical and promotion*/
});

// bootstrap-fileinput
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
