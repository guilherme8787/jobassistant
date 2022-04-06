function sendMailOne(id) {
  document.getElementById("loading").style.display = "inline-block";
  fetch("maildispatch.php?send=one&id=" + id)
    .then((response) => response.json())
    .then((json) => {
      document.getElementById("loading").style.display = "none";
      alert("Enviado!");
      location.reload();
    });
}
function sendMailAll() {
  document.getElementById("loading").style.display = "inline-block";
  fetch("maildispatch.php?send=all")
    .then((response) => response.json())
    .then((json) => {
      document.getElementById("loading").style.display = "none";
      alert("Enviado!");
      location.reload();
    });
}
