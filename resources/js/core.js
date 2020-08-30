window.getfileInfo = function(event) {

    if (!event || !event.target || !event.target.files || event.target.files.length === 0) {
        return;
    }

    const name = event.target.files[0].name;
    const lastDot = name.lastIndexOf('.');

    const fileName = name.substring(0, lastDot);
    const ext = name.substring(lastDot + 1);
    var totalFile = document.getElementById("fileUpload").files.length;
    for (var i = 0; i < totalFile; i++) {
        $('#previewUploads').append("<div class='preview-card mt-n1-5'><img class='banner-form-preview' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
    }
}

window.focusElement = function() {
    document.getElementById("user-name").focus();
}

jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
    $(".clickable-div").click(function() {
        window.location = $(this).data("href");
    });
});