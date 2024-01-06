
// for video
const videoInput = document.getElementById("videos");
const videoPreview = document.querySelector(".videos-preview");

document.getElementById('add-videos-button').addEventListener("click", function() {
    videoInput.click();
});
videoInput.addEventListener('change',function() {
    videoPreview.innerHTML = "";

    var filesVideos = this.files;
    for (var i = 0; i < files.length; i++) {
        var video = document.createElement('video');
        var videoSource = document.createElement('source');
        video.appendChild(videoSource);
        var videoUrl = URL.createObjectURL(filesVideos[i]);
        video.src = videoUrl;
        video.height = '200';
        video.width = '200';
        // img.style.margin = '20'
        videoPreview.appendChild(video);
        
    }
});