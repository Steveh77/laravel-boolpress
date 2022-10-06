const placeholder =
    "https://media.istockphoto.com/vectors/thumbnail-image-vector-graphic-vector-id1147544807?k=20&m=1147544807&s=612x612&w=0&h=pBhz1dkwsCMq37Udtp9sfxbjaMl27JUapoyYpQm0anc=";
const preview = document.getElementById("preview");
const imageField = document.getElementById("image-field");

imageField.addEventListener("input", () => {
    if (imageField.value) preview.src = imageField.value;
    else preview.src = placeholder;
});
