/***** Introduction *****/
This program is created for the Faculty of Medicine Dentistry & Health Sciences, The University of Melbourne as an academic project. 
Author: Chenchao Ye(Peter)
Supervisor: Dr. Karin Verspoor


/***** Software Running Instruction *****/
Main files of this software are stored in folder website. This software is tested working under below server environment 
PHP 5.5.18 
MySQL 5.5.38 
Apache 2.2.29

This software does not include any database scheme because all data are collected from real patients, which is confidential and sensitive, however, a demo site is created with mock data. The demo site can be visited through below url:
http://www.peteryeah.com/php-demo/
Login username and password are both ¡®admin¡¯.


/***** Project Software Structure *****/
/index.php
	This file contains the main function of the software.

/login.php
	Login page for the whole system.

/login_authentication.php
	A page authenticate user login information and implement access control.

/logout.php
	A page clears current logged session and logout users.

/input.php
	A page produces text boxes for data searching.

/autocomplete.php
	A page for autocomplete function.

/varRetrieve.php
	This page is part 1 of 2 in search by category function.

/varAdd.php
	This page is part 2 of 2 in search by category function.

/histogram.php
	This page generates histogram based on the data file created by histogram function kept in tsv folder. It is derived from D3 Javascript Library bar chart sample.

/css/jquery-ui.css
	This is a jquery UI css file for jquery UI functions.

/css/style.css
	This is a css for creating style of webpages.

/js/jquery.cookie.js
	This is a jquery plugin for saving cookies.

/js/jquery.min.js
	This is a jquery library.

/js/script.js
	This javascript file contains js functions of the system.

/csv/
	This folder is created to store cvs files.

/tsv/
	This folder is created to store tsv files for histogram.

/***** Database Schema *****/
Due to confidential issues, the actual clinical data cannot be submitted as a part of this software, therefore the database schema in database schema folder only contain the structure of the database for the software.


