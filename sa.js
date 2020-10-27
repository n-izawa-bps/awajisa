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
function entryChangeMainPurpose(){
	if($('#main-purpose')){
		const value = $('#main-purpose').val();

		if(value == '1'){
			$('#q-destination').show();
			entryChangeDestination();
		}else{
			$('#q-destination').hide();
			$('#q-course').hide();
		}
	}
}

// question7-1
function entryChangeDestination(){
	if($('#destination')){
		const value = $('#destination1').prop("checked");

		if(value){
			$('#q-course').show();
		}else{
			$('#q-course').hide();
		}
	}
}

// question9
function entryChangeSmartic(){
	if($('#smartic')){
		const value = $('#smartic').val();

		if(value == 'yes'){
			$('#q-smartic-reason').show();
		}else{
			$('#q-smartic-reason').hide();
		}
	}
}

// question13
function entryChangeAwajisaPurpose(){
	if($('#awajisa-purpose')){
		const value1 = $('#awajisa-purpose1').prop("checked");
		const value2 = $('#awajisa-purpose2').prop("checked");

		if(value1 || value2){
			$('#q-shop').show();
		}else{
			$('#q-shop').hide();
		}

		if(value1) {
			$('#q-price').show();
			$('#q-from-souvenir').show();
		}else{
			$('#q-price').hide();
			$('#q-from-souvenir').hide();
		}
	}
}

// question16
function entryChangeOasis(){
	if($('#oasis')){
		value = $('#oasis').val();

		if(value == 'yes'){
			$('#q-oasis-purpose').show();
		}else{
			$('#q-oasis-purpose').hide();
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
	const age = $('#age');
	const address_level1 = $('#address-level1');
	const transportation = $('#transportation');
	const main_purpose = $('#main-purpose');
	const destination = $('#destination');
	const course = $('#course');
	const known_smartic = $('#known-smartic');
	const smartic = $('#smartic');
	const smartic_reason = $('#smartic-reason');
	const awajisa_purpose = $('#awajisa-purpose');
	const shop = $('#shop');
	const timezone = $('#timezone');
	const staying_time = $('#staying-time');
	const oasis = $('#oasis');
	const oasis_purpose = $('#oasis-purpose');
	const facility = $('#facility');

	// 必須チェック
	checkRequire(age);
	checkRequire(address_level1);
	checkRequire(transportation);
	checkRequire(main_purpose);

	if (main_purpose.val() == "1") {
		checkRequireForCheckbox(destination);

		if ($('#destination1').prop("checked")) {
			checkRequireForCheckbox(course);
		}
	}

	checkRequire(known_smartic);
	checkRequire(smartic);

	if (smartic.val() == "yes") {
		checkRequireForCheckbox(smartic_reason);
	}

	checkRequireForCheckbox(awajisa_purpose);

	if ($('#awajisa-purpose1').prop("checked") || $('#awajisa-purpose2').prop("checked")) {
		checkRequireForCheckbox(shop);
	}

	checkRequire(timezone);
	checkRequire(staying_time);
	checkRequire(oasis);

	if (oasis.val() == "yes") {
		checkRequireForCheckbox(oasis_purpose);
	}

	checkRequireForCheckbox(facility);

	// 最終チェック
	if ($('.invalid').length) {
		let top = $('.invalid').first().offset().top - $('.invalid').first().height();
		$(window).scrollTop(top);

		alert("必須項目を入力してください");
		return false;
	}

	return true;
}

window.addEventListener('load', (event) => {
	setTimer();
	entryChangeMainPurpose();
	entryChangeDestination();
	entryChangeSmartic();
	entryChangeAwajisaPurpose();
	entryChangeOasis();
});

window.addEventListener('pageshow', (event) => {
	if (event.persisted) {
		window.location.reload(true);
	}
});