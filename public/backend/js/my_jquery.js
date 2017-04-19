$(document).ready(function(){


// Fade div thông báo
if($('.thongbao').length > 0){
    setTimeout(function(){
        $('.thongbao').slideUp('3000');
    },2000);
}


$('.icon-trash').click(function(){
    var setDelete = confirm('Bạn có chắc muốn xóa không?');
    if(setDelete == true){
        return true;
    }else{
        return false;
    }
})


// Thực hiện checkall trong table
$("#example2 #checkall").click(function () {
    if ($("#example2 #checkall").is(':checked')) {
        $("#example2 input[type=checkbox]").each(function () {
            $(this).prop("checked", true);
        });

    } else {
        $("#example2 input[type=checkbox]").each(function () {
            $(this).prop("checked", false);
        });
    }
});




// Khi tích vào check thì hiện form đổi mật khẩu
$('.check_pass').change(function(){
     if($(this).is(":checked")){
        alert('hii');
     }
})

// Ẩn các trường của sản phẩm khi khi sản phẩm thuộc danh mục phụ kiện

$('.check-hide-item').change(function(){
     if($(this).is(":checked")){
        $('.hide-item').slideUp();
     }else{
        $('.hide-item').slideDown();
     }
})

// Xem trước một hình ảnh
$(".upload_img").on('change', function () {

    if (typeof (FileReader) != "undefined") {

        var image_holder = $(".show-img");
        image_holder.empty();

        var reader = new FileReader();
        reader.onload = function (e) {
            $("<img />", {
                "src": e.target.result,
                "class": "one-image"
            }).appendTo(image_holder);

        }
        image_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
    } else {
        alert("This browser does not support FileReader.");
    }
});



// Xem trước nhiều hình ảnh trước khi upload
    $(".upload_imgs").on('change', function () {

             //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $(".show-imgs");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }

                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }

            } else {
                     alert("This browser does not support FileReader.");
                }

        } else {
                 alert("Pls select only images");
        }
    });



})
