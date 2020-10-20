function setTimer() {
	setInterval(clock, 1000);
}

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

// question7
function entryChange1(){
	if(document.getElementById('smart-ic')){
		id = document.getElementById('smart-ic').value;

		if(id == 'yes'){
			document.getElementById('go-out').style.display = "";
			document.getElementById('island').style.display = "";
			document.getElementById('awaji-highway').style.display = "";
			document.getElementById('awaji-reason').style.display = "";
		}else if(id == 'no'){
			document.getElementById('go-out').style.display = "none";
			document.getElementById('island').style.display = "none";
			document.getElementById('awaji-highway').style.display = "none";
			document.getElementById('awaji-reason').style.display = "none";
		}
	}
}

// question7-2
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

// question11
function entryChange3(){
	if(document.getElementById('price')){
		id = document.getElementById('price').value;

		if(id == '5'){
			document.getElementById('from-souvenir').style.display = "none";
		}else{
			document.getElementById('from-souvenir').style.display = "";
		}
	}
}

// question14
function entryChange4(){
	if(document.getElementById('oasis')){
		id = document.getElementById('oasis').value;

		if(id == 'yes'){
			document.getElementById('oasis-purpose').style.display = "";
			document.getElementById('oasis-facility').style.display = "";
		}else if(id == 'no'){
			document.getElementById('oasis-purpose').style.display = "none";
			document.getElementById('oasis-facility').style.display = "none";
		}
	}
}

class ErrorInfo {
	constructor() {
		this.is_error = false;
		this.first_error_top = 0;
	}

	checkRequire(target) {
		// title-boxのinvalidを削除
		let parent = target.parentElement;
		let title_box = parent.previousElementSibling;

		if (target.value != "") {
			title_box.classList.remove("invalid");
			return true;
		}

		title_box.classList.add("invalid");
		if (this.first_error_top == 0) {
			this.first_error_top = title_box.getBoundingClientRect().top + window.pageYOffset;
		}
		this.is_error = true;
	}

	checkRequireForCheckbox(target) {
		// title-boxのinvalidを削除
		let parent = target.parentElement;
		let title_box = parent.previousElementSibling;

		let target_array = target.children;
		for (let checkbox of target_array) {
			if (checkbox.checked) {
				title_box.classList.remove("invalid");
				return true;
			}
		}

		title_box.classList.add("invalid");
		if (this.first_error_top == 0) {
			this.first_error_top = title_box.getBoundingClientRect().top + window.pageYOffset;
		}
		this.is_error = true;
	}
}

// 送信前必須チェック
function check() {
	// エラークラス生成
	let errorObj = new ErrorInfo();

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
	errorObj.checkRequire(gender);
	errorObj.checkRequire(age);
	errorObj.checkRequire(address_level2);
	errorObj.checkRequire(transportation);
	errorObj.checkRequire(smart_ic);

	if (smart_ic.value == "" || smart_ic.value == "yes") {
		errorObj.checkRequire(purpose2);

		if (purpose2.value == "" || purpose2.value == "1") {
			errorObj.checkRequireForCheckbox(course);
		}

		errorObj.checkRequire(highway);
		errorObj.checkRequireForCheckbox(reason);
	}

		errorObj.checkRequire(sa);
		errorObj.checkRequireForCheckbox(purpose);
		errorObj.checkRequireForCheckbox(shop);
		errorObj.checkRequire(timeZone);
		errorObj.checkRequire(staying_time);
		errorObj.checkRequire(oasis);

	if (oasis.value == "" || oasis.value == "yes") {
		errorObj.checkRequireForCheckbox(purpose3);
		errorObj.checkRequireForCheckbox(facility);
	}

	// 最終チェック
	if (errorObj.is_error) {
		document.documentElement.scrollTop = errorObj.first_error_top;
		alert("必須項目を入力してください");
		return false;
	}

	return true;
}

window.addEventListener('load', (event) => {
	setTimer();
	entryChange1();
	entryChange2();
	entryChange3();
	entryChange4();
});