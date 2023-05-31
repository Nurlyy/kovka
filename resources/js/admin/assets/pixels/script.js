export default function applyFilter(Image_id, put_to, filter) {
    console.log("init");

    var imgElement = document.getElementById(Image_id);

    var putImg = document.getElementById(put_to);

    var canvas = document.createElement("canvas");

    canvas.width = imgElement.naturalWidth;
    canvas.height = imgElement.naturalHeight;

    var context = canvas.getContext("2d");

    context.drawImage(imgElement, 0, 0, canvas.width, canvas.height);

    var imageData = context.getImageData(0, 0, canvas.width, canvas.height);
    if(filter != "original"){
        imageData = pixelsJS.filterImgData(imageData, filter);
    }
    
    context.putImageData(imageData, 0, 0);

    // context.putImageData(imageData, 0, 0);

    // canvas.height = 3024;

    var dataUrl = canvas.toDataURL();

    putImg.src = dataUrl;
    putImg.style.display = "block";

    // canvas.remove();
    // var blobb = null;
    // fetch(dataUrl)
    //     .then(response => response.blob())
    //     .then((blob) => {
    //     // Handle the Blob object here
    //     blobb = blob;
    // })

    // return typeof(blobb);

    const base64Data = dataUrl.split(",")[1]; // Remove the data URL prefix
    const byteCharacters = atob(base64Data);
    const byteArrays = [];
    for (let i = 0; i < byteCharacters.length; i++) {
        byteArrays.push(byteCharacters.charCodeAt(i));
    }
    const blob = new Blob([new Uint8Array(byteArrays)], { type: "image/png" });
    const file = new File([blob], "image_"+Math.floor(Math.random() * (10000 - 1 + 1)) + 1+".png", { type: blob.type });
    return file;
}

// var img = document.getElementById(Image_id);
// // img.crossOrigin = "Anonymous";
// // img.onload = function () {
// //     pixelsJS.filterImg(img, "neue");
// // }
// var filtered_img = pixelsJS.filterImg(img, "cosmic")
