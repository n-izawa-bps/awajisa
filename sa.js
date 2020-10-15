// thanks.htmlの時間 

timerID = setInterval('clock()',500);

function clock() {
	document.getElementById("time").innerHTML = getNow();
}

function getNow() {
	var now = new Date();
	var year = now.getFullYear();
	var mon = now.getMonth()+1;
	var day = now.getDate();
	var hour = now.getHours();
	var min = now.getMinutes();
	var sec = now.getSeconds();

	var s = year + "年" + mon + "月" + day + "日" + hour + "時" + min + "分" + sec + "秒"; 
	return s;
}

// ここまでthanks.htmlの時間


// ここから表示切替

//   ここからquestion7

function entryChange1(){
	if(document.getElementById('smart-ic')){
		id = document.getElementById('smart-ic').value;
		 
		if(id == 'yes'){
			document.getElementById('purpose').style.display = "";
			document.getElementById('island').style.display = "";
			document.getElementById('highway').style.display = "";
			document.getElementById('reason').style.display = "";
		}else if(id == 'no'){
			document.getElementById('purpose').style.display = "none";
			document.getElementById('island').style.display = "none";
			document.getElementById('highway').style.display = "none";
			document.getElementById('reason').style.display = "none";
		}
	}
}
 
window.onload = entryChange1;

// ここまでquestion7

// ここからquestion7-2

function entryChange2(){
	if(document.getElementById('purpose2')){
		id = document.getElementById('purpose2').value;
		 
		if(id == '1'){
			document.getElementById('island').style.display = "";
		}else{
			document.getElementById('island').style.display = "none";
		}
	}
}
 
window.onload = entryChange2;

// ここまでquestion7-2

// ここからquestion11

function entryChange3(){
	if(document.getElementById('price')){
		id = document.getElementById('price').value;
		 
		if(id == '5'){
			document.getElementById('place').style.display = "none";
		}else{
			document.getElementById('place').style.display = "";
		}
	}
}
 
window.onload = entryChange3;

// ここまでquestion11

// ここからquestion14

function entryChange4(){
	if(document.getElementById('oasis')){
		id = document.getElementById('oasis').value;
		 
		if(id == 'yes'){
			document.getElementById('purpose3').style.display = "";
			document.getElementById('facility').style.display = "";
		}else if(id == 'no'){
			document.getElementById('purpose3').style.display = "none";
			document.getElementById('facility').style.display = "none";
		}
	}
}
 
window.onload = entryChange4;

// ここまでquestion14

/* ここまで表示切替 */
