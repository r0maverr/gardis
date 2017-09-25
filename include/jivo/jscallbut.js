var jivoOnline = 'offline';
function jivo_onOpen() {
document.getElementById("jivocb").style.display= "none";
}
function jivo_onClose() {
  if (jivoOnline == "online")
     document.getElementById("jivocb").style.display= "block";
}
function jivo_onLoadCallback() {
  jivoOnline = jivo_config.chat_mode;
  if (jivoOnline == "online")
     document.getElementById("jivocb").style.display= "block";
}