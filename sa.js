function setTimer() {
	setInterval(clock, 1000);
}

function clock() {
	if (document.getElementById('time')) {
		document.getElementById('time').innerHTML = getNow();
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
			entryChange2();
			document.getElementById('awaji-highway').style.display = "";
			document.getElementById('awaji-reason').style.display = "";
		}else{
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

		if(id == '' || id == '5'){
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
		}else{
			document.getElementById('oasis-purpose').style.display = "none";
			document.getElementById('oasis-facility').style.display = "none";
		}
	}
}

function checkRequire(target) {
	let parent = target.parent();
	let title_box = parent.prev();

	if (target.val() != "") {
		return true;
	}

	title_box.addClass('invalid');
}

function checkRequireForCheckbox(target) {
	let parent = target.parent();
	let title_box = parent.prev();

	if (target.find(":checked").length) {
		return true;
	}

	title_box.addClass('invalid');
}

// 送信前必須チェック
function check() {
	$('.invalid').each(function() {
		$(this).removeClass('invalid');
	});

	// 必須項目
	const gender = $('#gender');
	const age = $('#age');
	const address_level2 = $('#address-level2');
	const transportation = $('#transportation');
	const smart_ic = $('#smart-ic');
	const purpose2 = $('#purpose2');
	const course = $('#course');
	const highway = $('#highway');
	const reason = $('#reason');
	const sa = $('#sa');
	const purpose = $('#purpose');
	const shop = $('#shop');
	const timeZone = $('#timeZone');
	const staying_time = $('#staying-time');
	const oasis = $('#oasis');
	const purpose3 = $('#purpose3');
	const facility = $('#facility');

	// 必須チェック
	checkRequire(gender);
	checkRequire(age);
	checkRequire(address_level2);
	checkRequire(transportation);
	checkRequire(smart_ic);

	if (smart_ic.val() == "" || smart_ic.val() == "yes") {
		checkRequire(purpose2);

		if (purpose2.val() == "" || purpose2.val() == "1") {
			checkRequireForCheckbox(course);
		}

		checkRequire(highway);
		checkRequireForCheckbox(reason);
	}

		checkRequire(sa);
		checkRequireForCheckbox(purpose);
		checkRequireForCheckbox(shop);
		checkRequire(timeZone);
		checkRequire(staying_time);
		checkRequire(oasis);

	if (oasis.val() == "" || oasis.val() == "yes") {
		checkRequireForCheckbox(purpose3);
		checkRequireForCheckbox(facility);
	}

	// 最終チェック
	if ($('.invalid').length) {
		let top = $('.invalid').first().offset().top;
		$(window).scrollTop(top);

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

window.addEventListener('pageshow', (event) => {
	if (event.persisted) {
		window.location.reload(true);
	}
});