function setNameLabelImage(){
  let inputImage = document.getElementById('inputImg');
  let labelImage = document.getElementById('labelImg');
  labelImage.innerText = inputImg.files[0].name;
}
