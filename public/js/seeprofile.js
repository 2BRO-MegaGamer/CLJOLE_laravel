const previewImage = (event) => {
    const imageFiles = event.target.files;
    const imageFilesLength = imageFiles.length;
    if (imageFilesLength > 0) {
        const imageSrc = URL.createObjectURL(imageFiles[0]);
        const imagePreviewElement = document.querySelector("#preview-selected-image");
        imagePreviewElement.src = imageSrc;
        imagePreviewElement.style.display = "block";
    }
};
if (document.getElementById("update_Mchange") != null) {
    setTimeout(()=>{
        document.getElementById("btn_change_bio").click();
    },500)

}
if (document.getElementById("update_DUB_Mchange") != null) {
    setTimeout(()=>{
        document.getElementById("btn_change_bio").click();
    },500)

}
