// get data from db and save to db

function Dbs()
{
	// properties
	var isSaved = false;
	var id = 0; // null value is default
	var xmlhttp;

	return {
		getSaved: function () { return isSaved; },
		
		setId: function(newid) { id = newid; },
		
		getId: function () { return id; },
		
		request: function (resobj)
		{
			if (window.XMLHttpRequest)
			{
				xmlhttp = new XMLHttpRequest();
			}
			else
			{ // older ie versions
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
	
			xmlhttp.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					document.getElementById(resobj).innerHTML = this.responseText;
				}
			}
			
			return;
		},
		
		// get an array of all cities in the db.
		getCities: function (divname, run)
		{
			this.request(divname);
			xmlhttp.open("GET", "dbs/getCity.php?run=" + run, true);
			xmlhttp.send();
		},
		
		// get all data from 'addrbook' table
		getData: function ()
		{
			this.request("showDat");
			xmlhttp.open("GET", "dbs/getInfo.php", true);
			xmlhttp.send();
		},
		
		// get just one element from 'addrbook' table
		getElem: function (rid, rcit)
		{
			if (rid == 0) return false;
			else {
//				alert(rid);
				this.setId(rid);
				this.request("showTxtBoxes");
				xmlhttp.open("GET", "dbs/getElem.php?elem="+rid+"&useCity="+rcit, true);
				xmlhttp.send();
			
				return true;
			}
		},
		
		// save data to database
		save: function (abookObj)
		{
			// get values from object
			var fname = abookObj.getfname();
			var lname = abookObj.getName();
			var str = abookObj.getStr();
			var zipc = abookObj.getZip();
			var cityid = abookObj.getCitId();
			var selCity = abookObj.getCitName();
			
			if (fname != "") { // make sure we only save sane values
				this.request("showSav");
				xmlhttp.open("GET", "dbs/save.php?name="+lname+"&fname="+fname+"&str="+str+"&zipc="+zipc+"&cid="+cityid+"&cname="+selCity, true);
				xmlhttp.send();
				
				isSaved = true;
			} else alert("Please enter a valid name.");
		}, // end of save func.
		
		// update data
		update: function (abookObj)
		{
			// get values
			var fname = abookObj.getfname();
			var lname = abookObj.getName();
			var str = abookObj.getStr();
			var zipc = abookObj.getZip();
			var cityid = abookObj.getCitId();
			var selCity = abookObj.getCitName();
			
			if (id > 0) { // make sure we only save sane values
				this.request("showUpd");
				xmlhttp.open("GET", "dbs/update.php?id="+id+"&name="+lname+"&fname="+fname+"&str="+str+"&zipc="+zipc+"&cid="+cityid+"&cname="+selCity, true);
				xmlhttp.send();
			} else alert("Please select a valid id.");
		}, // end of upd. func.
		
		// delete entry
		del: function (delid)
		{
			this.request("showDel");
			xmlhttp.open("GET", "dbs/delete.php?Delid=" + delid, true);
			xmlhttp.send();
		} // end of del. func.
	}
}
