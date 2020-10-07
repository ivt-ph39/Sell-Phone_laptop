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
    $(".select2_tag").select2({
        tags: true,
        placeholder: "Thêm tag",
        tokenSeparators: [","]
    });
    // start add technical and promotion
    $("#add_technical").click(function () {
        var content =
            '<tr><td><input type="text" class="form-control " name="name_technical[]" placeholder="Màn hình"></td> <td><input type="text" class="form-control " name="value_technical[]"placeholder = "AMOLED, 6.4in, Full HD+" > </td ></tr > ';
        $("#main_technical").append(content);
    });
    $("#add_promotion").click(function () {
        var content =
            '<input type="text" class="form-control mb-2" name="promotion[]" placeholder="Nộ dung khuyến mãi"> ';
        $("#main_promotion").append(content);
    });
    /* end add technical and promotion*/
});

// bootstrap-fileinput
$("#image_detail").fileinput({
    showUpload: false,
    theme: "fas",
    removeTitle: "Xoa tat"
});
$("#avatar").fileinput({
    showUpload: false,
    theme: "fas",
    removeTitle: "Xoa tat"
});
