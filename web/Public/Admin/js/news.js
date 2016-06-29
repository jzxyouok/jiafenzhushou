/**
 * Created by rocks on 16/3/14.
 */

$(function () {
    $("form").parsley({
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest(".form-group");
        },
        errorsWrapper: "<span></span>",
        errorTemplate: "<span></span>"
    });


    var ue = UE.getEditor("content", {
        autoHeight: true,
    });


    var uploader = WebUploader.create({
        auto: true,
        server: "/admin.php?m=Admin&c=Picture&a=upload",
        pick: "#thumb .add-pic-pre",
        accept: {
            title: "Images",
            extensions: "jpg,jpeg,png",
            mimeTypes: "image/*"
        }
    });

    uploader.on("uploadProgress", function (file, percentage) {
        $("#thumb .add-pic-pre").hide();
        $("#thumb .add-pic-ing").show();
    });


    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on("uploadSuccess", function (file, url) {
        $("#thumb .add-pic-pre").hide();
        $("#thumb .add-pic-ing").hide();
        $("#thumb-pre").before("<div class='add-pic-after add-file-after'>" +
            "<img style='width:100%;height:100%' src='/" + url + "'>" +
            "<div class='operation'>" +
            "<div class='bg'>" +
            "</div>" +
            "<ul class='fun'>" +
            "   <li><a title='查看原图' class='magnifier' target='_blank' href='/" + url + "'><b>查看原图</b></a></li>" +
            "   <li><a title='替换' class='change cursor-pt webuploader-container'><div class='webuploader-pick'><b>替换</b></div>" +
            "       <div style='position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; bottom: auto; right: auto;'>" +
            "       <input type='file' name='file' class='webuploader-element-invisible' accept='image/*'><label style='opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);'></label>" +
            "       </div>" +
            "       </a>" +
            "</li>" +
            "   <li><a title='删除' class='delete cursor-pt' id='deleteThumb'><b>删除</b></a></li>" +
            "</ul></div><input type='hidden' value='" + url + "' name='thumb'></div>");

        $("#deleteThumb").click(function () {
            uploader.removeFile(file);
            $("#thumb .add-pic-pre").show();
            $("#thumb .add-pic-after").remove();
        });
    });

    // 文件上传失败，显示上传出错。
    uploader.on("uploadError", function (file) {

    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on("uploadComplete", function (file) {

    });
    $("#deleteThumb").click(function () {
        $("#thumb .add-pic-pre").show();
        $("#thumb .add-pic-after").remove();
    });



}).on("form:submit", function () {
    return false;
});
