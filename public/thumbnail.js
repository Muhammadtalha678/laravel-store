const thumbnailInput = document.getElementById("thumbnail");
const thumbnailPreview = document.querySelector(".thumbnail-preview");

document.getElementById('add-thumbnail-button').addEventListener("click", function() {
    thumbnailInput.click();
});
thumbnailInput.addEventListener('change',function() {
    thumbnailPreview.innerHTML = "";

    var files = this.files;
    for (var i = 0; i < files.length; i++) {
        var img = document.createElement('img');
        var imgUrl = URL.createObjectURL(files[i]);
        img.src = imgUrl;
        img.height = '100';
        img.width = '100';
        // img.margin-right='10';
        img.style.marginRight = '10px';
        thumbnailPreview.appendChild(img);
        
    }
});


