<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "fku_planning"
 *
 * Auto generated by Extension Builder 2016-10-04
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
	'title' => 'FKU Planning',
	'description' => '',
	'category' => 'plugin',
	'author' => 'Daniel Widmer',
	'author_email' => 'daniel.widmer@fku.ch',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '5.4.1',
	'constraints' => [
		'depends' => [
			'typo3' => '7.6.0-10.4.99',
			'fluid_fpdf' => '1.0.0-2.99.99',
			'fku_people' => '6.0.0-7.99.99',
		],
		'conflicts' => [],
		'suggests' => [],
	],
];

/******************************************
 * Version 1.1.0
 * -------------
 * Added alarm option for personal calendar, works only with fku_people 2.6.0
 *
 * Version 1.1.1
 * -------------
 * Tiny corrections in templates
 *
 * Version 1.1.2
 * -------------
 * Alarm tests
 *
 * Version 1.1.3
 * -------------
 * Preparation for Kids Treff dashboard
 * New constants
 *
 * Version 1.2.0
 * -------------
 * Spinner icon when changing calender alarm
 * New e-mail list to music team
 *
 * Version 1.3.0
 * -------------
 * Save and proceed to next service as alternate save button in editView
 * Test display of automatically generate agenda entry
 *
 * Version 1.3.1
 * -------------
 * Removed all residues of integrated FPDF
 *
 * Version 1.4.0
 * -------------
 * Added option "alle Lieder" for service music selection (boolean)
 *
 * Version 1.4.1
 * -------------
 * Using Halflings instead of Glyphicons
 *
 * Version 2.0.0
 * -------------
 * Implementation notifications
 *
 * Version 2.1.0
 * -------------
 * Linking of kids topic downloads
 *
 * Version 2.1.1
 * -------------
 * Bugfix in IcalCommandController
 *
 * Version 2.1.2
 * -------------
 * Bugfix in IcalCommandController
 *
 * Version 2.1.3
 * -------------
 * Small change in column widths of service export PDF
 *
 * Version 2.2.0
 * -------------
 * Tracking of changes in planning entries
 * FlashMessages with icons, ready for Typo3 8
 *
 * Version 2.2.1
 * -------------
 * Bugfix for tracking with general data udpate
 *
 * Version 2.3.0
 * -------------
 * Monthly list view
 * Function findByEvent in MasterRepository
 *
 * Version 2.4.0
 * -------------
 * Notifications if master planning changes
 *
 * Version 2.4.1
 * -------------
 * Minor correction in notification cache text creation
 *
 * Version 2.4.2
 * -------------
 * Changed wording: Gottesdienstleitung instead of Moderation
 *
 * Version 2.5.0
 * -------------
 * Minimal correction in template Personal.html
 * Additional step of agenda event description modification form if certain fields are modified
 * Partial template Agenda.html shows raw text (for textarea) instead of formatted text
 *
 * Version 2.6.0
 * -------------
 * Outsourcing of notification storage to fku_pepple v4.0.0
 *
 * Version 2.6.1
 * -------------
 * Returning to list view after modification of a master, table jumps to modified entry
 *
 * Version 2.6.2
 * -------------
 * Bugfix: link to related kids document wrong in personal action for Plenum Kids Treff people 
 *
 * Version 2.7.0
 * -------------
 * Beamer action added
 *
 * Version 2.7.1
 * -------------
 * Bugfix: listMonthAction shows content of last month
 *
 * Version 2.7.2
 * -------------
 * Missing German translation for "kids young team" added in translation file
 * Beamer agenda information is until next master >= 7 days from current (instead of fix 7 days)
 *
 * Version 2.7.3
 * -------------
 * Using presentation download links for songs in beamer action from fku_songs 3.0.0
 *
 * Version 2.7.4
 * -------------
 * Minor changes in html templates
 *
 * Version 2.8.0
 * -------------
 * Added information about reporting per master in personal view
 * New partial Master/LinkSelectedSongs, used in peronal and show view
 * Correction in IcalCommandController
 *
 * Version 2.8.1
 * -------------
 * Minor change in template Agenda.html
 * Added notification ID 26
 *
 * Version 2.8.2
 * -------------
 * Minor change in template Agenda.html
 * Fixed bug to allowing updating agenda event if none is linked
 *
 * Version 2.9.0
 * -------------
 * Templates: links to export PDF with target _blank
 * New database fields kidsYoungActive and serviceSupperPeople
 * Children section also includes Summervögeli (in addition to kids section)
 * Option to enter responsible people for Lord's supper
 *
 * Version 2.10.0
 * --------------
 * Remoced residues of editService, editKids, edit...
 * Make success alerts dismissible
 * New notification to remind for planned support people
 * Shows "keine Summervögeli" if kidsYoungActive is false in section lists of kids and children as well as in export PDF of both sections
 * New constant for notification PID, used in personal view
 *
 * Version 2.10.1
 * --------------
 * Avoid creating empty notification entries into user's memory
 *
 * Version 2.10.2
 * --------------
 * Show more than 7 days of agenda in BeamerAction if next service is less than 7 days from current service
 *
 * Version 2.10.3
 * --------------
 * Only call notificationCommandController->storeNotifications when updating master if there are any notifications
 * Hint on Beamer template if no prayer is planned for the respective service
 *
 * Version 2.11.0
 * --------------
 * Added Driver view
 * Base birthdays in beamer view on fku_people (instead of fku_agenda)
 *
 * Version 2.11.1
 * --------------
 * Modified List, ListMonth, Personal, and Show view and their partials for optimize for XS format
 *
 * Version 2.11.2
 * --------------
 * Bugfix in Section....html partial files
 *
 * Version 2.11.3
 * --------------
 * Avoid calling notificationCommandController->storeNotifications when updating a master if no change was made
 * New notification rule (id=28): service starts at unusual time; consequentely some updates in IcalCommandController
 *
 * Version 2.12.0
 * --------------
 * Use f:variable viewhelper for PDF export to remove many f:alias
 * Some minor corrections in PDF export
 * Moved Summervögeli from Kids Treff to Kinderhüeti in Master>Show
 * Correct usage of $settings in IcalCommandController, fixes bug in notification id 28
 *
 * Version 2.12.1
 * --------------
 * Slightly optimized PDF file creation with file parameters and separate font path definition
 *
 * Version 3.0.0
 * -------------
 * Added service serials (new DB table, modified forms and views including PDF export
 *
 * Version 3.1.0
 * -------------
 * Correction: section navigation shows "personal" to be active in master->personalView
 * New program type "Ausflug" for kids
 * Beamer template: link to song reporting list of the event
 *
 * Version 3.1.1
 * -------------
 * Bugfix: tracking of master update (whether inital and new value is different or same)
 *
 * Version 3.1.2
 * -------------
 * Changed "Missionsfenster" to "Fürbitte für die weltweite Kirche"
 * Use multiCell instead of cell in Partials/Matster/PDF/Title.html to correctly display Umlaute in month names
 *
 * Version 3.2.0
 * -------------
 * Bible information and sermon series are displayed in master show view if no service topic is entered
 * Optimized layout of involved people in service on beamer page
 * Added option "Today" ("heute") for date range in master list view including adaptation in Partial/Master/PDF/Title
 *
 * Version 3.2.1
 * -------------
 * Minor correction in template Beamer.html (hide mission if disabled)
 *
 * Version 3.2.2
 * -------------
 * E-mail to gdablauf now also reaches serviceMissionary
 *
 * Version 3.2.3
 * -------------
 * Option for administrators to delete the page cache of Beamer view
 * Fix a bug for service list view to show same information of kids and teens for all dates
 *
 * Version 3.2.4
 * -------------
 * Beamer view with textareas for SongBeamer slides
 *
 * Version 3.3.0
 * -------------
 * New DB field in master "serviceCollection"
 * Adapted templates Show.html, Beamer.html and partial FormFieldService.html
 *
 * Version 3.3.1
 * -------------
 * Bugfix in IcalCommandControl: use utf8_encode function for date information since März was not correctly rendered
 *
 * Version 3.3.2
 * -------------
 * Minor enhancement in partial template Sectionkids.html to show topic and topicLink if kidsProgramm = 6 (Ausflug)
 *
 * Version 3.3.3
 * -------------
 * Improved template Beamer.html for SongBeamer Birthday output
 *
 * Version 3.3.4
 * -------------
 * DriverAction improved: set time of low and high limit (instead of only date)
 *
 * Version 3.3.5
 * -------------
 * Removed limitation for SongBeamer section in Template Beamer.html
 *
 * Version 3.3.6
 * -------------
 * Modified template Agenda.html: Franziska Sägesser instead of Merita Göldi as person of contact
 *
 * Version 3.4.0
 * -------------
 * Moved filter value determination for ListAction to separate funktion getFilterValues in MasterControlller
 * Add parameters extraContraints in findInDateRange in MasterRepository
 * Correction in template Beamer.html to show expression <posx:230> correctly
 *
 * Version 3.5.0
 * -------------
 * Added "missionary" feature: various changes in MasterController, new table, new templates
 *
 * Version 3.5.1
 * -------------
 * Only show birthdays in BeamerAction on Sundays
 * Correct display of month name with Umlauts in Driver.html
 *
 * Version 4.0.0
 * -------------
 * Sermons integrated in this extension
 * Title of birthday slide in template BeamerAction added
 * Corrected TCA definitions in order to remove deprecaited functions
 * Ready for Typo3 version 10
 *
 * Version 4.0.1
 * -------------
 * Link for KidsTreff documents corrected for extension file_list
 * Corrections in IcalCommand
 * Correct link for "Weitere Präsentationen und Vorlagen" on template Beamer.html
 *
 * Version 4.1.0
 * -------------
 * composer.json added
 * serviceLivestreamlink added as new DB field in master (used only in backend so far)
 * Correction in MasterController: define empty array for $listAllNotification in updateAction
 * Layout corrections in template Agenda.html
 * Typo of Utilities corrected in NotificationCommand.php
 *
 * Version 4.1.1
 * -------------
 * Typo of Utilities corrected in NotificationCommand.php
 *
 * Version 4.1.2
 * -------------
 * Corrections in DashboardAction of MasterController and in Utilities to show next action in dashboard
 * Some line breaks added in Personal.html 
 * Added function clearSpecificCache in MasterController
 *
 * Version 4.1.3
 * -------------
 * Corrections in Partials/Master/FormFields/Service.html
 * Added camera person and filmeditor person to button for e-mail to all involved service workers
 * Correction cache clearing
 *
 * Version 4.1.4
 * -------------
 * Minor change in template LivestreamPrevious.html
 * Minor changes in all partial templates Children.html, Kids.html, Others.html, Service.html, and Teens.html in folder Master/Section
 * Several changes in template ListMonth.html
 * Correct link classes and month names in function getDateRanges of MasterController.php
 * Made action "list" non-cacheable
 * Display YouTube link in Show.html
 * Field to enter YouTube ID in partial template Master/Formfields/Service.html
 * Corrected positioning of header image in export PDF (in file Partials/Master/PDF/Header.html
 * Path of partial template in New.html
 *
 * Version 4.1.5
 * -------------
 * Made action "new" non-cacheable
 * Minor correction in template Show.html
 * Correction in IcalCommand and NotificationCommand for usage of Utilities::identifyUser
 *
 * Version 4.2.0
 * -------------
 * Changes to macke back link for Missionary secrion of list more flexible
 * New plugin "Registration"
 *
 * Version 4.2.1
 * -------------
 * Hide pages and recursive in plugin options of GD-Registration content element
 *
 * Version 4.3.0
 * -------------
 * findNext in MasterRepository uses the real time (converted to UTC), not only full days for finding the next (or previous) mater
 * Defined +4 hours after a master to display the next one in livestream actions
 *
 * Version 4.3.1
 * -------------
 * Corrected date/time threshold for next/previous lifestream display in MasterController
 *
 * Version 4.3.2
 * -------------
 * Use "Fahrdienst" instead of "Auto-Abholdienst" in template Driver.html
 *
 * Version 4.3.3
 * -------------
 * Changed name of pageType for PDF export
 * Changed date format in titel of template Edit.html and partial PDF/DateTimeHoliday.html
 *
 * Version 4.3.4
 * -------------
 * Added missing camera and filmeditor names in partial Section/Service.html in XS view
 * Corrected TCA of table missionary
 * Corrected TCA of table master: item 6 for kids_program
 *
 * Version 4.3.5
 * -------------
 * Minor corrections in template SermonList and partial Master/Sermon/Table
 *
 * Version 4.4.0
 * -------------
 * Added constant for PidLivestream
 * Modified MasterController to clear cache for PidLivestream when clearing cache for PidPlanning
 * Added partial Master/Sermon/Notes and changed template SermonList accordingly
 * Changes in template SermonLast (title size and to display anything if service has not title)
 * Removed starttime and endtime from table tx_fkuplanning_domain_model_serial
 * Renamed plugin GD-Plan to GD Admin
 * Removed fiedl for storage pages for plugin GD Admin
 *
 * Version 4.5.0
 * -------------
 * Added XS table for sermon list
 * Corrected bug in sermonUpdateAction of MasterController for notification of users when publishing a sermon
 * Default setting for new sermon: published = true
 * Enhanced faatures for SermonNewListAction, yet deactivateed (commented out)
 * Added field "recent" to model Serial -> Database update required!
 * Only serials marked as "recent" as available in master edit view
 *
 * Version 4.6.0
 * -------------
 * Minor change in template Beamer
 * New MasterController action "livestream" for future replacement of livestreamNext and livesteramPrevious
 *
 * Version 5.0.0
 * -------------
 * Removed MasterController actions livestreamNext and livesteramPrevious
 * Separate plugins for various contents/actions
 * Removed Commands.php and added Service.yaml in Configuration folder, reworked dependency injection in MasterController
 *
 * Version 5.0.1
 * -------------
 * Minor corrections in template Driver.html and Show.html for date format
 * Bugs corrected in MasterController::sermonUpdateAction
 *
 * Version 5.1.0
 * -------------
 * Redefined actions of plugin Mission
 * New constants / setup variable: PidPlanning
 *
 * Version 5.2.0
 * -------------
 * Personal calendar configuration accessible again (issue #2 fixed)
 *
 * Version 5.2.1
 * -------------
 * Correction of plugin name of fku_agenda in Show.html
 *
 * Version 5.2.2
 * -------------
 * Correction of partial template KidsTopicLink.html
 *
 * Version 5.2.3
 * -------------
 * Added PPT template for livestream servies in Beamer.html
 *
 * Version 5.2.4
 * -------------
 * Correction in class NotificationCommand
 *
 * Version 5.3.0
 * -------------
 * Renamed typoscript files from .txt to .typoscript
 * Removed cache clearing by the extension
 * Fixed issue of showing empty table intead of text in Personal.html
 *
 * Version 5.3.1
 * -------------
 * Only show relevant services in missionary view
 *
 * Version 5.3.2
 * -------------
 * Correct Umlaute in month names
 *
 * Version 5.4.0
 * -------------
 * Moving "Türbegrüssung" from section service to section others
 * Introduction of flag serviceLivestream to use as a condition for some displayed information
 *
 * Version 5.4.1
 * -------------
 * Link to new ppt templates in Beamer.html template
 *
 */