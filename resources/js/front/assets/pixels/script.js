export default function applyFilter (Image_id) {

    // document.addEventListener('DOMContentLoaded', init, false);
        console.log("init")
        var img = document.getElementById(Image_id);
        // img.crossOrigin = "Anonymous";
        // img.onload = function () {
        //     pixelsJS.filterImg(img, "neue");
        // }
        var filtered_img = pixelsJS.filterImg(img, "ocean")

        // var img2 = document.getElementById("img2");
        // img2.crossOrigin = "Anonymous";
        // img2.onload = function() {
        //     pixelsJS.filterImg(img2, "cosmic")
        // }

        // var img3 = document.getElementById("img3");
        // img3.crossOrigin = "Anonymous";
        // img3.onload = function() {
        //     pixelsJS.filterImg(img3, "ocean")
        // }

};