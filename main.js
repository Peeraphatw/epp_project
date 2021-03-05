var res;

const showcode = document.querySelector('#code');
const assetCode = document.querySelector('#assetCode');
const myform = document.querySelector('#myform');
function onScanSuccess(qrCodeMessage) {
  render(qrCodeMessage);
}

var html5QrcodeScanner = new Html5QrcodeScanner(
  'reader',
  {
    fps: 60,
    qrbox: 250,
  },
  true
);
html5QrcodeScanner.render(onScanSuccess);

const render = (assetid) => {
  if (assetid != '') {
    let assetidTerm = sessionStorage.getItem('assetid');
    if (assetid != assetidTerm) {
      sessionStorage.setItem('assetid', assetid);
      showcode.innerHTML = assetid;
      assetCode.value = assetid;
      myform.submit();
    } else {
      return null;
    }
  }
};
