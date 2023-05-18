export default function applyFilter(Image_id) {
    console.log("init");

    var imgElement = document.getElementById(Image_id);

    var canvas = document.createElement("canvas");

    canvas.width = imgElement.naturalWidth;
    canvas.height = imgElement.naturalHeight;

    var context = canvas.getContext("2d");

    context.drawImage(imgElement, 0, 0, canvas.width, canvas.height);

    var imageData = context.getImageData(0, 0, canvas.width, canvas.height);

    var newImgData = pixelsJS.filterImgData(imageData, "neue");
    context.putImageData(newImgData, 0, 0);

    // context.putImageData(imageData, 0, 0);

    // canvas.height = 3024;

    var dataUrl = canvas.toDataURL();

    imgElement.src = dataUrl;

    // canvas.remove();

    // return dataUrl;
}


    // var img = document.getElementById(Image_id);
    // // img.crossOrigin = "Anonymous";
    // // img.onload = function () {
    // //     pixelsJS.filterImg(img, "neue");
    // // }
    // var filtered_img = pixelsJS.filterImg(img, "cosmic")