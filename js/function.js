$(document).ready(function(){

	var files;

	function getCName(event)
	{

		event.preventDefault();

		var cat_name = $("#c_name").val();

		createCat(cat_name,displayResponse);
	}

	function getTrig(event)
	{
		event.preventDefault();

		var trig_name = $("#trigger").val();

		createTrig(trig_name,displayResponse);
	}

	function getAcID(event)
	{
		event.preventDefault();

		var value = $(this).attr("id");
		console.log(value);

		deleteAc(value,displayResponse);
	}

	function getDeleteId(event)
	{
		event.preventDefault();
		
		var delId = $(this).attr("id");
		var delName = $(this).attr("name");

		delParam(delName,delId,displayResponse);


	}

	function getParams(event)
	{
		event.preventDefault();
		
		var assign_cat = $(this).parent(".ac_form_elements").children("#assign_cat").find("option:selected").attr("name");
		var assign_trig = $(this).parent(".ac_form_elements").children("#assign_trig").find("option:selected").attr("name");
		var acid = $(this).attr("name");

		assignParams(assign_cat,assign_trig,acid,displayResponse);
	}

	function getImageData(event)
	{
		event.stopPropagation();
		event.preventDefault();

		var acid = $(this).attr("name");
		var file_data = $(this).siblings("#up_image").prop('files')[0];
		console.log(file_data);
		var data = new FormData();

		data.append("file",file_data);

		updateImage(acid,data,displayResponse);
	}

	function getAc(event)
	{
		event.stopPropagation();
		event.preventDefault();

		var ac_title = $("#ac_name").val();
		var ac_cat = $("#cat").find("option:selected").attr("name");
		var ac_vb = $('input[name="visibility"]:checked').serialize();
		var ac_trig = $("#trig").find("option:selected").attr("name");
		var ac_message = $("#ac_message").val();
		var file_data = $('#ac_image').prop('files')[0];
		var data = new FormData();

		data.append("file",file_data);

		createAc(ac_title,ac_cat,ac_vb,ac_trig,ac_message,data,displayResponse);
	}

	function createCat(cat_name,fn)
	{
		return $.ajax({
			type: "get",
			url: "function/create_cat.php",
			data: {
				cat:cat_name
			},
			success: fn
		});
	}

	function createTrig(trig_name,fn)
	{
		return $.ajax({
			type: "get",
			url: "function/create_trig.php",
			data: {
				trig:trig_name
			},
			success: fn
		});
	}

	function deleteAc(value,fn)
	{
		return $.ajax({
			type: "get",
			url: "function/delete_ac.php",
			data: {
				ac:value
			},
			success: fn
		});
	}

	function delParam(delName,delId,fn)
	{
		return $.ajax({
			type: "get",
			url: "function/delete_param.php",
			data: {
				name:delName,
				id:delId
			},
			success: fn
		});
	}

	function assignParams(assign_cat,assign_trig,acid,fn)
	{
		return $.ajax({
			type: "get",
			url: "function/update_ac.php",
			data: {
				assign_cat:assign_cat,
				assign_trig:assign_trig,
				id:acid
			},
			success: fn
		})
	}

	function updateImage(acid,data,fn)
	{
		return $.ajax({
			type: "post",
			url: "function/update_image.php?acid=" + acid,
			cache: false,
			contentType: false,
			processData: false,
			data: data,
			success: fn
		});
	}

	function createAc(title,cat,vb,trig,message,data,fn)
	{
		return $.ajax({
			type: "post",
			url: "function/create_ac.php?name=" + title + "&categorie=" + cat + "&" + vb +"&trigger=" + trig + "&text=" + message,
			cache: false,
			contentType: false,
			processData: false,
			data: data,
			success: fn
		});
	}

	function displayResponse(response)
	{
		$("#result").show();
		document.getElementById("result").innerHTML = response;
		$("#result").fadeOut(5000);

		$("#ac_container").load(document.URL + " #ac_container");
		$("#create_ac_form").load(document.URL + " #create_ac_form");
		$("#categorie_container").load(document.URL + " #categorie_container");
		$("#trigger_container").load(document.URL + " #trigger_container");
	}

	function displayOptions(event)
	{
		event.preventDefault();

		$(this).find("#ac_id").val(function () {
			$(this).parents(".achievement").find(".ac_main_frame").fadeTo(100,0.4);
			$(this).parent().show();
		});
	}

	function hideOptions(event)
	{
		event.preventDefault();

		$(this).find("#ac_id").val(function () {
			$(this).parents(".achievement").find(".ac_main_frame").fadeTo(100,1);
			$(this).parent().hide();
		});
	}

	function displayConnect(event)
	{
		event.preventDefault();

		$(this).parents(".options").find("#ac_id").val(function () {
			$(this).parents(".achievement").find(".ac_chain_frame").slideToggle();
		});
	}

	function displayImgUpload(event)
	{
		event.preventDefault();
		
		$(this).parents(".options").find("#ac_id").val(function () {
			$(this).parents(".achievement").find(".ac_image_frame").slideToggle();
		});
	}

	$(document).on("click","#c_cat",getCName);
	$(document).on("click","#create_ac",getAc);
	$(document).on("click","#create_trig",getTrig);
	$(document).on({mouseover: displayOptions,mouseleave: hideOptions},".achievement");
	$(document).on("click",".delete_ac",getAcID);
	$(document).on("click",".delete_button",getDeleteId);
	$(document).on("click",".connect_ac",displayConnect);
	$(document).on("click","#assign_params",getParams);
	$(document).on("click",".update_img",displayImgUpload);
	$(document).on("click","#assign_img",getImageData);

});