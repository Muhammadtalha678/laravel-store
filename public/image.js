const imageInput = document.getElementById("images");
const imagePreview = document.querySelector(".images-preview");

document.getElementById('add-images-button').addEventListener("click", function() {
    imageInput.click();
});
imageInput.addEventListener('change',function() {
    imagePreview.innerHTML = "";

    var files = this.files;
    for (var i = 0; i < files.length; i++) {
        var img = document.createElement('img');
        var imgUrl = URL.createObjectURL(files[i]);
        img.src = imgUrl;
        img.height = '100';
        img.width = '100';
        // img.margin-right='10';
        img.style.marginRight = '10px';
        imagePreview.appendChild(img);
        
    }
});


