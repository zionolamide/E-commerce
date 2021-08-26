const file = document.getElementById("file");
const imgPreview = document.getElementById("img-preview");

file.addEventListener("change", function() {
    getImgData();
});

function getImgData() {
    const files = file.files[0];
    if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function() {
            imgPreview.style.display = "block";
            imgPreview.innerHTML = '<img src="' + this.result + '" />';
        });
    }
}