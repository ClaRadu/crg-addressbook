<!DOCTYPE html>
<html>
<head>
<title>CRG Address Book v.2.01</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<script src="scripts/DbOp.js"></script>
<script src="scripts/AdrBook.js"></script>
<script>
// mouse events
$(document).ready(function() {
	// show all data
	db = new Dbs();
	db.getData();
	
	// show and poulate 'add_new_entry' form
	$('#btnAdd').click(function() {
		db.getCities('showCit_a', 1); // get cities
		$('#crtAddModal').show();
	});
	
	// hide 'add_new_entry' form
	$('#btnClose_a').click(function() { $('#crtAddModal').hide(); });
	
	// save data and hide 'add_new_entry' form
	$('#btnSave_a').click(function() {
		// get values from modal form ( js method )
		var fname = document.getElementById('frmfname').value;
		var lname = document.getElementById('frmlname').value;
		var str = document.getElementById('frmstr').value;
		var zipc = document.getElementById('frmzipc').value;
		var e = document.getElementById('selcit');
		var selCity = e.options[e.selectedIndex].text;
		
		var cid = Number(e.selectedIndex);
		cid++; // increment value by 1 to match the entries in 'cities' table

		var AdrBook = new aBook(0, lname, fname, str, zipc, cid, selCity);
		db.save(AdrBook);
		alert("Data saved");
		$('#crtAddModal').hide(); // close form
	});
	
	// hide 'update' form
	$('#btnClose_u').click(function() { $('#crtUpdModal').hide(); });
	
	// update data and hide 'update' form
	$('#btnSave_u').click(function() {
		// get values from modal form ( jquery )
		var id = $('#frm2id').val();
		var fname = $('#frm2fname').val();
		var lname = $('#frm2lname').val();
		var str = $('#frm2str').val();
		var zipc = $('#frm2zipc').val();
		var cid = $('#selcit option:selected').val();
		var cname = $('#selcit option:selected').text();
		
		var AdrBook = new aBook(id, lname, fname, str, zipc, cid, cname);
		db.update(AdrBook);
		
		alert("Data updated");
		$('#crtUpdModal').hide(); // close form
	});
	
	// export data to xml
	$('#btnSav').click(function() { 
		db.getData();
		alert('Data exported to xml');
	});
});

// update button
// thanks to user5636597 on stackoverflow.com
// https://stackoverflow.com/questions/18602331/why-is-this-jquery-click-function-not-working
$(document).on('click', '#btnUpd', function() {
	// show update modal form
	$('#crtUpdModal').show();
	db.getElem(this.value, 1);
});

// delete button
$(document).on('click', '#btnDel', function() {
	if (confirm('Are you sure you want to record #' + this.value + '?')) {
		db.del(this.value);
		alert('Record deleted');
		db.getData(); // refresh 
	}
});
</script>
<body>

<div class="w3-top">
	<div class="w3-black w3-bar w3-card">
		<div class="w3-container">
			<h1>CRG Address Book</h1>
		</div>
	</div>
</div>

</br></br></br>
</br></br>
<div id='divu' class="w3-content w3-container w3-teal w3-round" style='display:block;'>
	<!-- hud.toggleAdd(1, dbs); -->
	<button id='btnAdd' class="w3-button w3-blue w3-section w3-round">Add</button>
	<!-- run getData() func. because that automatically updates the xml file as well -->
	<button id='btnSav' class="w3-button w3-blue w3-section w3-round">Save to XML</button>
	<a id='btnDwn' href="down/adrBook.xml" target="_blank" class="w3-button w3-blue w3-section w3-round">Open xml file</a>
	<hr>
	</br>
	<div id="showDat">Data will be listed here...</div></br>
</div>
</br>

<!-- add_new_entry modal form -->
<div id="crtAddModal" class="w3-modal">
	<div class="w3-modal-content w3-animate-top w3-card-4">
	  <div class="w3-container">
		<div class='w3-gray'><h2 id="gray"><label>&nbsp<i class="fa fa-plus-circle"></i>Adding new data:</label></h2></div>
		<form action='' target='' name='frma1' method='post'>
		<table>
			<tr><td><p>First name: </p></td><td><input type='text' id='frmfname'/></td></tr>
			<tr><td><p>Last name: </p></td><td><input type='text' id='frmlname'/></td></tr>
			<tr><td><p>Street: </p></td><td><input type='text' id='frmstr'/></td></tr>
			<tr><td><p>Zip code: </p></td><td><input type='text' id='frmzipc'/></td></tr>
			<tr><td><small>Choose the city:</small></td><td><div id="showCit_a"></div></td></tr>
			<tr><td colspan=2><div id="infoSelectedCity"></div></td></tr>
		</table>
		<br/>
		<button class="w3-button w3-green w3-section w3-right" id="btnSave_a">Save <i class="fa fa-remove"></i></button>
		<button class="w3-button w3-red w3-section" id="btnClose_a">Close <i class="fa fa-remove"></i></button>
		</form>
	  </div>
	</div>
</div>

<!-- update modal form -->
<div id="crtUpdModal" class="w3-modal">
	<div class="w3-modal-content w3-animate-top w3-card-4">
	  <div class="w3-container">
		<div class='w3-gray'><h2 id="gray"><label>&nbsp<i class="fa fa-edit"></i> Updating:</label></h2></div>
		<form action='' target='' name='frmu2' method='post'>
			<div id="showTxtBoxes"></div>
			<table>
				<tr><td colspan=2><div id="infoSelectedCity"></div></td></tr>
			</table>
		<br/>
		<button class="w3-button w3-green w3-section w3-right"  id="btnSave_u">Save <i class="fa fa-remove"></i></button>
		<button class="w3-button w3-red w3-section"  id="btnClose_u">Close <i class="fa fa-remove"></i></button>
		</form>
	  </div>
	</div>
</div>

<div id="showSav"></div>
<div id="showUpd"></div>
<div id="showDel"></div>

<div class="w3-display-bottom w3-margin">
<a class="w3-round w3-padding-small" id="logo" href="http://crgames.elementfx.com" target="_blank">&nbspC.R.G. 2018&nbsp</a>
</div>

</body>
</html>
