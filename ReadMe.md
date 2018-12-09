# CRG Address Book App v.2.01

First of all, I'd like to thank user5636597 on stackoverflow.com:

https://stackoverflow.com/questions/18602331/why-is-this-jquery-click-function-not-working


## Table of contents:
1. Project layout
2. License
3. Info / Contact


## 1. Project layout
<Root folder>
- ReadMe.md			// info file
- license
- index.php			// main file
- create.php		// create and manage the database used by the app ( run manually )

<dbs folder>
- globalvars.php	// global variables needed in order to connect to the database
- getInfo.php		// gets all data from the 'adrbook' table and saves it to xml
- getCity.php		// gets all the data from the 'cities' table
- getElem.php		// retrieves only one record from the 'adrbook' table 
- save.php			// saves data to the 'adrbook' table
- update.php		// updates entries from 'adrbook' table
- delete.php		// delete record from 'adrbook' table

<scripts folder>
- DbOp.js		// javascript object to get data from the php scripts and show it to screen
- AdrBook.js	// javascript object to temporarily hold all data from 'adrbook' table

<styles folder>
- style.css		// holds all the css styles used by the app

<down folder>
- adrBook.xml	// stores all data from 'adrbook' table


## 2. License
The license of this software and its source-code is based on the zlib/libpng license.

See file license.md for more info.


## 3. Info / Contact
Application developed by Claudiu Radu a.k.a. CRG using (thus requiring): 
php, mysql, javascript and jquery, w3.css, bootstrap.

using tools: 
XAMPP, Notepad++, Opera and Firefox.

C.R.G. 2018.
