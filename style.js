const css = ['btn-success', 'btn'];
var allbtn = document.getElementsByTagName('button');
var select = document.getElementsByTagName('select');
var allspan = document.getElementsByTagName('span');
allspan[1].innerHTML = 'EPP QR Code Scanner';
allbtn[1].classList.add(...css);
const myinterval = setInterval(() => {
  if (select[0]) {
    clearInterval(myinterval);
    select[0].classList.add('form-control');
    var options = select[0].options.length;
    for (let j = 0; j < options; j++) {
      if (select[0].options[j].text.search('front') != -1) {
        select[0].options[j].text = 'กล้องหน้า';
      } else if (select[0].options[j].text.search('back') != -1) {
        select[0].options[j].text = 'กล้องหลัง';
        select[0].options[j].selected = true;
      }
    }
  }
  for (let i = 0; i <= allbtn.length - 1; i++) {
    if (i > 0) {
      allbtn[i].classList.add(...css);
    }
  }
}, 50);
