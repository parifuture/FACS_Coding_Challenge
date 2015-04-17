$(document).ready(function() {

	$("#deleteItemButton").click(function(){
		$("#deletedItemsContainer").show();
	});

	$(document).click(function() {
		$(".facs-item").removeClass("clicked");
		$("#deleteItemButton").prop("disabled",true);
	});

});

function toggleDeleteButton() {
	if($("#addedItemsContainer .facs-item").length > 0) {
		$("#deleteItemButton").show();
	} else {
		$("#deleteItemButton").hide();
	}
}


function itemClick(itemid) {

	$(".facs-item").click(function(e) {
		$(this).addClass("clicked");
		$("#deleteItemButton").removeAttr("disabled");
		e.stopPropagation();
	});

	$(document).click(function() {
		$(".facs-item").removeClass("clicked");
		$("#deleteItemButton").prop("disabled",true);
	});

	if($(".facs-item.clicked").length >= 1) {
		alert("Please select one item at a time");
		// remove all the highlighted boxes
		$(".facs-item.clicked").each(function(i, obj) {
  			$(this).removeClass("clicked");
		});

	}
}

function UpdateItem() {
	// AJAX Call Goes here

	var id = $(".clicked").attr("id");
	$.ajax({
		url: 'Test.php',
		data: {
			"cmd":"updateitem",
			"item_id":id, //we are passing the id of the clicked item
			"user_id":"1234", //this will be a unique user id
			"item_status":"deleted"  //the only time updateitem is called when an item is deleted
		},
		type: 'post',
		success: function(output) {
			if ((output === true) || (output === 1)) {
				// we have hard coded the id of the row in which the div is loaded
				// it is safe to remove them when the AJAX JSON resposnse is true
				$("#row"+id).remove();
				// code to move the deleted row in the deleted container
				$("#deletedItemsTable").append("<tr id=\"row"+id+"\"><td><div id=\""+id+"\" class=\"facs-item\">Item #"+id+" Deleted</div></td></tr>");
			}
			toggleDeleteButton();
		},
		failure: function(output) {
			alert("Server Error! Please try again");
		}
	});
}

function AddItem() {
	// AJAX Call Goes here
	// The response of ajax call gives us the Sequence Number
	//
	var last_id = $("#count").val();
	if(last_id === undefined) {
		last_id = $("#addedItemsTable tr:last td div").attr("id");
	}
	if(last_id === undefined) {
		last_id = $("#deletedItemsTable tr:last td div").attr("id");
	}
	if(last_id === undefined) {
		last_id = 1;
	}
	$.ajax({
		url: 'Test.php',
		data: {
			"cmd":"additem",
			"item_text":last_id,
			"item_description":"add"
		},
		type: 'post',
		success: function(output) {
			$("#addedItemsTable tr:last").after("<tr id=\"row"+output+"\"><td><div id=\""+output+"\" onClick=\"itemClick(this);\" class=\"facs-item\">Item #"+output+"</div></td></tr>");
			itemClick("item"+output);
			toggleDeleteButton();
			$("#count").val(output);
		},
		failure: function(output) {
			alert("Server Error! Please try again");
		}
	});
}


