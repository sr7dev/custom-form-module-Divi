jQuery(document).ready(function ($) {
	var zip = $('#zip').val(),
		validate_trigger = false,
		has_error = false,
		form = $('form.acf_zip_form'),
		resultsDIV = $('#page-container'),
		isMedicare = (window.location.href.search('medicare') > -1),
		type = isMedicare ? 'medicare' : 'health_insurance',
		url = '/wp-admin/admin-ajax.php';

	initZIP_v2(zip);	

	function initZIP_v2(zip) {
		get_city_v2(zip);
		send_first_step_v2(zip);
	}

	function validate_short_form_fields_v3() {
		$('#mrc_health_savings_form_0 [name=gender], #mrc_health_savings_form_0 #mrc_short_input_zipcode, #mrc_health_savings_form_0 #mrc_short_datepicker_birthdate').each(function () {
			let fields = $(this).closest('.error-message');
			let att_name = $(this).attr('name');
			let error_msg = "Field is required";
			if (typeof att_name !== typeof undefined && att_name !== false && $(this).attr('name').localeCompare('gender') == 0) {
				if ($('[name=gender]:checked').length == 0) {
					$(this).parent().find('.check-gender-v3').addClass('has-error');
					$(this).addClass( 'has-error' );
					has_error = true;
					error_msg = "Select gender";
				} else {
					has_error = false;
					$(this).removeClass('has-error');
					$(this).parent().find('.check-gender-v3').removeClass('has-error');
				}
			} else if ($(this).attr('id').localeCompare('mrc_short_input_zipcode') == 0) {
				let zip_pattern = /^\d{5}$/;
				error_msg = 'Enter valid ZIP code';
				
				if (zip_pattern.test($(this).val())) {
					has_error = false;
					$(this).removeClass('has-error');
				}
				else {
					has_error = true;
					$(this).addClass('has-error');
				}
			} else if (!$(this).val() || $(this).val() == '') {
				$(this).addClass('has-error');
				has_error = true;
				error_msg = "Select birthdate";
			} else {
				has_error = false;
				$(this).removeClass('has-error');
			}

			let ffa = fields.find('.mrc_health_savings_error_text');
			if (has_error) {
				if (ffa.length == 0) {
					if (error_msg == "Select gender")
						fields.append('<p class="mrc_health_savings_error_text" style="margin-left: 30%;">' + error_msg + '</p>');
					else
						fields.append('<p class="mrc_health_savings_error_text">' + error_msg + '</p>');
				}
				setTimeout(()=>{$(".overlay").removeClass("open");},500);
				$(".overlay").addClass("hide");
			} else {
				$(".overlay").removeClass("hide");
				if (ffa.length > 0)
					ffa.remove();
			}
		});
		return has_error;
	}

	$('#mrc_health_savings_hero_homepage_form').submit(multit_form_submit_v3);
	function multit_form_submit_v3() {
		let has_errors = validate_short_form_fields_v3();

		if (!validate_trigger) {
			$('#mrc_health_savings_form_0 [name=switch-one], #mrc_health_savings_form_0 #mrc_short_input_zipcode, #mrc_health_savings_form_0 #mrc_short_datepicker_birthdate').change(function () {
				let has_errors = validate_short_form_fields_v3();
			});

			validate_trigger = true;
		}
		if ($('#mrc_health_savings_hero_homepage_form .has-error').length == 0) {
						let bd = $('#mrc_short_datepicker_birthdate').val();
						let zipcode = $('#mrc_short_input_zipcode').val();
						let ref = '';
						let arrival_id = resultsDIV.data('arrival');
						$(this).append('<input type="hidden" name="birthday" value="' + bd + '">');
						$(this).append('<input type="hidden" name="zip" value="' + zipcode + '">');
						$(this).append('<input type="hidden" name="ref" value="' + ref + '">');
						$(this).append('<input type="hidden" name="arrival_id" value="' + arrival_id + '">');
        }
		return $('#mrc_health_savings_hero_homepage_form .has-error').length == 0;
	}

	$('#submitShortForm_v2').click(short_contact_form_submit_v2);

	function validate_short_form_fields_v2() {
		$('#mrc_short_form_0 select, #mrc_short_form_0 #zip, #mrc_short_form_0 [name=mrc_short_genderoption_0]').each(function () {
			let fields = $(this).closest('.error-message');
			let att_name = $(this).attr('name');
			let error_msg = "Field is required";
			if (typeof att_name !== typeof undefined && att_name !== false && $(this).attr('name').localeCompare('mrc_short_genderoption_0') == 0) {
				if ($('[name=mrc_short_genderoption_0]:checked').length == 0) {
					$(this).parent().find('.check-gender').addClass('has-error');
					$(this).addClass( 'has-error' );
					has_error = true;
					error_msg = "Select gender";
				} else {
					has_error = false;
					$(this).removeClass('has-error');
					$(this).parent().find('.check-gender').removeClass('has-error');
				}
			} else if ($(this).attr('id').localeCompare('zip') == 0) {
				let zip_pattern = /^\d{5}$/;
				error_msg = 'Enter valid ZIP code';
				
				if (zip_pattern.test($(this).val())) {
					has_error = false;
					$(this).removeClass('has-error');
				}
				else {
					has_error = true;
					$(this).addClass('has-error');
				}
			} else if (!$(this).val() || $(this).val() == '') {
				$(this).addClass('has-error');
				has_error = true;
				if ($(this).attr('id').localeCompare('mrc_short_month_0') == 0) {
					error_msg = "Select month";
				} else if ($(this).attr('id').localeCompare('mrc_short_day_0') == 0) {
					error_msg = "Select day";
				} else {
					error_msg = "Select year";
				}
				// console.log($(this),"Select birth date");
			} else {
				has_error = false;
				$(this).removeClass('has-error');
			}

			let ffa = fields.find('.mrc_short_error_text');
			if (has_error) {
				if (ffa.length == 0) {
					if (error_msg == "Select gender")
						fields.append('<p class="mrc_short_error_text" style="margin-left: 30%;">' + error_msg + '</p>');
					else
						fields.append('<p class="mrc_short_error_text">' + error_msg + '</p>');
				}
				setTimeout(()=>{$(".overlay").removeClass("open");},500);
				$(".overlay").addClass("hide");
			} else {
				$(".overlay").removeClass("hide");
				if (ffa.length > 0)
					ffa.remove();
			}
		});
		return has_error;
	}

	function short_contact_form_submit_v2() {
		if (!$(this).hasClass('sending')) {
			let has_error_local = validate_short_form_fields_v3();
			
			if (!validate_trigger) {
				$('#mrc_health_savings_form_0 [name=switch-one], #mrc_health_savings_form_0 #mrc_short_input_zipcode, #mrc_health_savings_form_0 #mrc_short_datepicker_birthdate').change(function () {
					let has_errors = validate_short_form_fields_v3();
				});
	
				validate_trigger = true;
			}

			if (has_error_local || ($('#mrc_health_savings_form_0 .has-error').length != 0)) {
				return false;
			}
			if ($('#mrc_health_savings_form_0 .has-error').length == 0) {
				data = {
					arrival_id: resultsDIV.data('arrival'),
					birthday: $('#mrc_short_datepicker_birthdate').val(),//$('#mrc_short_year_0').val() + '-' + $('#mrc_short_month_0').val() + '-' + $('#mrc_short_day_0').val(),
					pageName: window.location.pathname,
					zip: $('#mrc_short_input_zipcode').val(),//$('#zip').val(),
					gender: ($('[name=gender]:checked').val()).substring(0, 1),
					action: 'short_form_handler_v2'
				};
				$.ajax({
					url: "/wp-admin/admin-ajax.php",
					method: 'POST',
					data: data,
					beforeSend: function () {
						let ssf = $('#submitShortForm_v2');
						ssf.addClass('sending');
					},
					success: function (resp) {
						// console.log(data);
						if (resp) {
							let data = JSON.parse(resp);
							if (data.status) {
								window.location.href = data.url
							} else {
								let ssf = $('#submitShortForm_v2');
								// ssf.html('Get Free Quotes');
								ssf.removeClass('sending');
								alert(data.message);
							}
						}
					}
				});
			}
		}
	}

	var birth_day = $('#mrc_short_day_0');
		birth_month = $('#mrc_short_month_0');
		birth_year = $('#mrc_short_year_0');
	var months_days = {
		1: {days: 31, name: 'Jan'},
		2: {days: 29, name: 'Feb'},
		3: {days: 31, name: 'Mar'},
		4: {days: 30, name: 'Apr'},
		5: {days: 31, name: 'May'},
		6: {days: 30, name: 'Jun'},
		7: {days: 31, name: 'Jul'},
		8: {days: 31, name: 'Aug'},
		9: {days: 30, name: 'Sep'},
		10: {days: 31, name: 'Oct'},
		11: {days: 30, name: 'Nov'},
		12: {days: 31, name: 'Dec'}
	}
	birth_day.html('');
	birth_day.append('<option value="">Day</option>');
	for (var i = 1; i < 32; i++) {
		birth_day.append( '<option value="' + i + '">' + i + '</option>' );
	}

	birth_month.html('');
	birth_month.append('<option value="">Month</option>');
	for (var i = 1; i < 13; i++) {
		birth_month.append( '<option value="' + i + '">' + months_days[i]['name'] + '</option>' );
	}

	birth_year.html('');
	birth_year.append('<option value="">Year</option>');
	var start_year = (new Date()).getFullYear() - 100;
	var finish_year = (new Date()).getFullYear() - 18;
	for (var i = start_year; i < finish_year + 1; i++) {
		birth_year.append( '<option value="' + i + '">' + i + '</option>' );
	}

	$('#mrc_short_month_0').change(function () {
		var val = $(this).val();
		if (val !== '') {
			if (birth_day.val() !== '') {
				var selected_day = birth_day.val();

				if (selected_day > months_days[val]['days']) {
					selected_day = months_days[val]['days'];
				}
				birth_day.html('');
				birth_day.append('<option value="">Day</option>');
				for (var i = 1; i < months_days[val]['days'] + 1; i++) {
					birth_day.append('<option value="' + i + '">' + i + '</option>');
				}
				birth_day.val(selected_day);
			} else {
				birth_day.html('');
				birth_day.append('<option value="">Day</option>');
				for (var i = 1; i < months_days[val]['days'] + 1; i++) {
					birth_day.append('<option value="' + i + '">' + i + '</option>');
				}
			}
		}
		$('#birthdate').val(birth_month.val() + '/' + birth_day.val() + '/' + birth_year.val());

	});

	$('#mrc_short_year_0').change(function () {
		if (birth_month.val() == 2) {
			if ((birth_year.val() % 4) > 0) {
				var max_date = 28;
			} else {
				max_date = 29;
			}

			if (birth_day.val() !== '') {
				var selected_day = birth_day.val();
				var val = $(this).val();
				if (selected_day > max_date) {
					selected_day = max_date;
				}
				birth_day.html('');
				birth_day.append('<option value="">Day</option>');
				for (var i = 1; i < max_date + 1; i++) {
					birth_day.append('<option value="' + i + '">' + i + '</option>');
				}
				birth_day.val(selected_day);
			} else {
				birth_day.html('');
				birth_day.append('<option value="">Day</option>');
				for (var i = 1; i < max_date + 1; i++) {
					birth_day.append('<option value="' + i + '">' + i + '</option>');
				}
			}
		}
		$('#birthdate').val(birth_month.val() + '/' + birth_day.val() + '/' + birth_year.val());

	});

	$('#mrc_short_day_0').change(function () {
		$('#birthdate').val(birth_month.val() + '/' + birth_day.val() + '/' + birth_year.val());
	});

	function validate_triggersend_first_step_v2(zip) {
		//if we have already exist arrival hidden val (landing pages)
		let arrival_id = $('#arrival_id');
		if (arrival_id.length > 0 && arrival_id !== undefined) {
			// console.log('refer from landing arrival is set');
			resultsDIV.data('arrival', arrival_id.val());
		}
		else {
			get_arrival_v2(true)
		}
		// console.log(resultsDIV.data('arrival'));

	}

	function get_arrival_v2(init_step) {
		/*We have to Split the 2 ajax request in order to avoid empty Zipcode*/
		var data = {
			ip: getCookie_v2('utm_ip') ? getCookie_v2('utm_ip') : myAjax.ip,
			referer: getCookie_v2('utm_referer') ? getCookie_v2('utm_referer') : myAjax.referer,
			landing: getCookie_v2('utm_landing') ? getCookie_v2('utm_landing') : window.location.href,
			media: getCookie_v2('utm_media') ? getCookie_v2('utm_media') : '',
			verticalID: (window.location.href.search('medicare') > -1) ? 102 : 101,
			user_agent: window.navigator.userAgent,
			action: 'get_arrival_v2'
		};
		if (init_step) {
			data.campaign = getCampaign_v2();
			data.source = getSource_v2();
			data.term = getKeywords_v2();
		}
		else {
			data.campaign = form.find('[name=cid]').val();
			data.source = form.find('[name=tid]').val();
			data.term = form.find('[name=kw]').val();
		}

		/*This is the first Ajax Post sent rigth after hiting landing page this request the ID*/
		function firstAjaxPost_v2() {
			$.ajax({
				url: url,
				method: 'POST',
				data: data,
				success: function (resp) {
					// console.log('Arrival req');
					// console.log('resp: ' + resp);
					var data = JSON.parse(resp);
					form.append('<input type="hidden" name="arrival_id" value="' + data.arrival_id + '">');
					resultsDIV.data('arrival', data.arrival_id);
					// console.log('added');
					// console.log(init_step);

				}
			});
		}

		// Second Ajax Post, send after user hits the see plan option, this one submit the zip code
		function seAjaxPost_v2(zipVal) {
			// console.log('!test!');
			// console.log(zipVal);
			// Posting the Ajax
			$.ajax({
				url: url,
				method: 'POST',
				data: {
					type: type,
					zip: zipVal,
					arrival_id: resultsDIV.data('arrival'),
					action: 'lead_first_step_v2'
				},
				success: function (resp) {
					// console.log('Success step 1');
					// console.log(resp);
					if (resp) {
						var data = JSON.parse(resp);
						if (data.arrival_id) {
							resultsDIV.data('arrival', data.arrival_id);
						}
					}
				}
			});
		}

		/*Executing first Ajax post on load*/
		firstAjaxPost_v2();

		// adding Event to Execute second Ajax Post, fire the event based in a class and not an ID in order to allow multiple buttons
		// in one page

		jQuery('.mrc_short_submit').click(function (e) {
			var tmp_zip = $(this).parent().parent().parent().find('.acf_contactform_validate_field');
			if (tmp_zip)
				tmp_zip = tmp_zip.val();
			else 
				tmp_zip = 'ERROR';
			// console.log('1tmpZip' + tmp_zip);
			// seAjaxPost_v2(tmp_zip);
		});

	}

	function getCookie_v2(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	function getUrlVars_v2() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
			vars[key] = value;
		});
		return vars;
	}

	function getSource_v2() {
		var tid = getUrlVars_v2()["tid"];
		if (tid != null) {
			return tid;
		} else {
			return "direct";
		}
	}

	function getCampaign_v2() {
		var cid = getUrlVars_v2()["cid"];
		if (cid != null) {
			return cid;
		} else {
			return "direct";
		}
	}

	function getKeywords_v2() {
		var kw = getUrlVars_v2()["kw"];
		if (kw != null) {
			kw = kw.replace(/%20/g, " ");
			return kw;
		} else {
			return "direct";
		}
	}

	function get_city_v2(zip) {
		$.ajax({
			url: url,
			method: 'POST',
			data: {
				zip: zip,
				action: 'get_city_by_zip_v2'
			},
			success: function (resp) {
				if (resp) {
					var data = JSON.parse(resp);
					if (data.state && data.city) {
						$('body').append("<input type='hidden' id='city'>");
						$('body').append("<input type='hidden' id='state'>");
						$("#city").val(data.city);
						$("#state").val(data.state_long);
						$("#zip_2").val(data.zip_code);
					}
				}
			}
		});
	}

	function send_first_step_v2(zip) {
		//if we have already exist arrival hidden val (landing pages)
		let arrival_id = $('#arrival_id');
		if (arrival_id.length > 0 && arrival_id !== undefined) {
			resultsDIV.data('arrival', arrival_id.val());
		}
		else {
			get_arrival_v2(true)
		}
	}

});

function zipFormAction(formId) {
	const zip_value = document.getElementById("input_" + formId).value;
	var arrival_id = document.getElementsByName("arrival_id");

	if (arrival_id[0]) arrival_id = arrival_id[0].value;
	else arrival_id = 0;
	jQuery.ajax({
		url: "/wp-admin/admin-ajax.php",
		method: "POST",
		data: {
			zip: zip_value,
			arrival_id: arrival_id,
			action: "lead_first_step_v2"
		},
		success: function (resp) {
			const resultsDIV = jQuery("#page-container");
			if (resp) {
				var data = JSON.parse(resp);
				if (data.arrival_id) {
					// console.log("Success step 2, arrival_id:", data.arrival_id);
					resultsDIV.data("arrival", data.arrival_id);
				}
			}
		},
		error: function (resp) {
			console.log("leadapi is error");
		}
	});
}