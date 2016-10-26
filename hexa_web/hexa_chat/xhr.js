var xmlHttp;

xmlHttp = new XMLHttpRequest();
xmlHttp.onreadystatechange = checkReadyState;
xmlHttp.open("GET", "http://www.ajaxtower.jp/sample/plan.txt", false);
xmlHttp.send(null);

function checkReadyState(){
  if ((xmlHttp.readyState == 4) && (xmlHttp.status == 200)){
    alert(xmlHttp.responseText);
  }
}