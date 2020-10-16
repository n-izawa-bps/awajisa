// thanks.htmlの時間 

timerID = setInterval('clock()',500);

function clock() {
	if (document.getElementById("time")) {
		document.getElementById("time").innerHTML = getNow();
	}
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

// 送信前必須チェック
function check() {
	// エラーフラグ
	let is_error = false;

	// 必須項目
	const gender = document.getElementById("gender");
	const age = document.getElementById("age");
	const address_level2 = document.getElementById("address-level2");
	const transportation = document.getElementById("transportation");
	const smart_ic = document.getElementById("smart-ic");
	const purpose2 = document.getElementById("purpose2");
	const course = document.getElementById("course");
	const highway = document.getElementById("highway");
	const reason = document.getElementById("reason");
	const sa = document.getElementById("sa");
	const purpose = document.getElementById("purpose");
	const shop = document.getElementById("shop");
	const timeZone = document.getElementById("timeZone");
	const staying_time = document.getElementById("staying-time");
	const oasis = document.getElementById("oasis");
	const purpose3 = document.getElementById("purpose3");
	const facility = document.getElementById("facility");

	// 必須チェック
	is_error = checkRequire(gender, is_error);
	is_error = checkRequire(age, is_error);
	is_error = checkRequire(address_level2, is_error);
	is_error = checkRequire(transportation, is_error);
	is_error = checkRequire(smart_ic, is_error);

	if (smart_ic.value == "" || smart_ic.value == "yes") {
		is_error = checkRequire(purpose2, is_error);
		is_error = checkRequireForCheckbox(course, is_error);
		is_error = checkRequire(highway, is_error);
		is_error = checkRequireForCheckbox(reason, is_error);
	}

	is_error = checkRequire(sa, is_error);
	is_error = checkRequireForCheckbox(purpose, is_error);
	is_error = checkRequireForCheckbox(shop, is_error);
	is_error = checkRequire(timeZone, is_error);
	is_error = checkRequire(staying_time, is_error);
	is_error = checkRequire(oasis, is_error);

	if (oasis.value == "" || oasis.value == "yes") {
		is_error = checkRequireForCheckbox(purpose3, is_error);
		is_error = checkRequireForCheckbox(facility, is_error);
	}

	if (is_error) {
		scrollTo(0, 0);
		alert("必須項目を入力してください");
		return false;
	}

	return true;
}

function checkRequire(target, is_error) {
	// title-boxのinvalidを削除
	let parent = target.parentElement;
	let title_box = parent.previousElementSibling;
	title_box.classList.remove("invalid");

	if (target.value != "") {
		return is_error;
	}

	title_box.classList.add("invalid");
	return true;
}

function checkRequireForCheckbox(target, is_error) {
	// title-boxのinvalidを削除
	let parent = target.parentElement;
	let title_box = parent.previousElementSibling;
	title_box.classList.remove("invalid");

	target_array = target.children;
	for (checkbox of target_array) {
		if (checkbox.checked) {
			return is_error;
		}
	}

	title_box.classList.add("invalid");
	return true;
}