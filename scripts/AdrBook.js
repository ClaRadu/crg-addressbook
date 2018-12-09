// object to temporarily hold all elements from db

function aBook(nid, nName, nfName, nstr, nzipc, ncid, ncitName)
{
	var id = nid; // needed only for update function
	var name = nName;
	var firstName = nfName;
	var street = nstr;
	var zipCode = nzipc;
	var cityId = ncid;
	var cityName = ncitName;
	
	return {
		// get data
		getId: function () { return id; },
		getName: function () { return name; },
		getfname: function () { return firstName; },
		getStr: function () { return street; },
		getZip: function () { return zipCode; },
		getCitId: function () { return cityId; },
		getCitName: function () { return cityName; }
	}
}
