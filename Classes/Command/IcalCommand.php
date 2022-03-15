<?php
namespace FKU\FkuPlanning\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use FKU\FkuPlanning\Utilities\Utilities;
use FKU\FkuPlanning\Domain\Repository\MasterRepository;
use FKU\FkuPeople\Domain\Repository\UserRepository;

class IcalCommand extends Command {

    /**
     * Configure the command
     */
    protected function configure() {
        $this->setDescription('Creates individual .ics files of events with duties of the respective people');
        $this->setHelp('Creates an .ics file per FE user who activated this feature containg all events in which the user has a duty. Set parameter updateIntervalHours=0 to create the files anyway or to any integer to only update the file if changes were made in the last xx hours.');
		$this->addArgument('filePathAndName',InputArgument::REQUIRED,'Complete path and file name of .ics file, relative to TYPO3 installation path, without the .ics extension, e.g. fileadmin/calendar/personal');
		$this->addArgument('updateIntervalHours', InputArgument::REQUIRED, 'Number of hours back a change in the events shall still provoke the update of the .ics file; set to 0 to create the file anyway');
		$this->addArgument('visible', InputArgument::REQUIRED, 'Comma-separated list of visibility table uids that shall be displayed');
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {

		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$this->masterRepository = $objectManager->get(MasterRepository::class);
		$this->userRepository = $objectManager->get(UserRepository::class);

        $io = new SymfonyStyle($input, $output);
		$this->filePathAndName = $input->getArgument('filePathAndName');
		$updateIntervalHours = intval($input->getArgument('updateIntervalHours'));
		$this->visible = explode(',',$input->getArgument('visible'));

		if ($updateIntervalHours > 0) {
			$updated = $this->masterRepository->findUpdated($year, $updateIntervalHours, $this->visible);
			if ($updated->count() > 0) {
				$filesUpdated = $this->createFiles($this->filePathAndName, $this->visible);
				$io->writeln($filesUpdated.' Ical files have been created/updated.');
			} else {
		        $io->writeln('No Ical files written because no changes were detected.');
			}
		} else {
			$filesUpdated = $this->createFiles($this->filePathAndName, $this->visible);
			$io->writeln($filesUpdated.' Ical files have been created/updated.');
		}
		return Command::SUCCESS;
	}


	/**
	 * 
	 * @param string $filePathAndName File and path name of the .ics files
	 * @param array $visible UIDs of master's visibility to be used
	 * @param \FKU\FkuPeople\Domain\Model\User $singleUser Optional: create file only for this single user
	 *
	 * @return bool|int Number of written .ics files
	 */
	public function createFiles (string $filePathAndName, array $visible, \FKU\FkuPeople\Domain\Model\User $singleUser = NULL) {
		
		$filesystem = new Filesystem();
		$counter = 0;
		
		if ($this->masterRepository === NULL or $this->userRepository === NULL) {
			$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
			$this->masterRepository = $objectManager->get(MasterRepository::class);
			$this->userRepository = $objectManager->get(UserRepository::class);
		}

		// find masters in the right date range
		$start = new \DateTime;
		$start->setTime(0,0,0)->setDate(date('Y')-1,1,1);
		$end = clone $start;
		$end->modify('+2 years');
		$masters = $this->masterRepository->findInDateRange($start, $end, $visible);
		if ($masters->count() == 0) { return 0; }
		
		// find users for which a .ics file should be created
		if ($singleUser !== NULL) {
			if ($singleUser instanceof \FKU\FkuPeople\Domain\Model\User) {
				$users = array (0 => $singleUser);
			} else {
				return false;
			}
		} else {
			$users = $this->userRepository->findPlanningcal();
			if ($users->count() == 0) { return true; }
		}

		// write file content
		foreach ($users as $user) {
			$me = $user->getTxFkupeopleFkudbid();
			if ($me > 0) {

				// intialize
				$absoluteFilePathAndName = Environment::getPublicPath() . '/' . $filePathAndName.'_'.$user->getTxFkupeoplePlanningcal().'.ics';
				$fileContent = "";
		
				// filter the masters with logged-in person involved
				foreach ($masters as $key => $master) {
					if ($master) {
						if ($master->getEvent()) {
							$event = $master->getEvent();
							if ($myMaster = Utilities::identifyUser ($master, $me)) {

								$fileContent .= "BEGIN:VEVENT\r\n";
								$fileContent .= "UID:".$event->getUid()."_".$master->getUid()."@fku.ch\r\n";
			
								// register dates and times
								$dtstart = ";TZID=Europe/Berlin:".$event->getEventStart()->format('Ymd\THis');
								if ($event->getEventEnd() and $event->getEventStart() != $event->getEventEnd()) {
									$dtend = ";TZID=Europe/Berlin:".$event->getEventEnd()->format('Ymd\THis');
								} elseif ($event->getCategory()->getDuration() > 0) {
									$duration = $event->getCategory()->getDuration();
									$end = strtotime('+'.$duration.' minutes',$event->getEventStart()->format('U'));
									$dtend = ";TZID=Europe/Berlin:".date('Ymd\THis',$end);
								} else {
									$dtend = $dtstart;
								}
								$fileContent .= "DTSTART".$dtstart."\r\n";
								$fileContent .= "DTEND".$dtend."\r\n";
								
								// Event description
								$duties = implode(', ',$myMaster['rolesText']);
								$fileContent .= "SUMMARY:".$duties."\r\n";
								$fileContent .= "DESCRIPTION:".self::escapeText($event->getDescription())."\r\n";
								$fileContent .= "LOCATION:FKU\r\n";	
								$fileContent .= "DTSTAMP:".$event->getCrdate()->format('Ymd\THis\Z')."\r\n";
								$fileContent .= "CREATED:".$event->getCrdate()->format('Ymd\THis\Z')."\r\n";
								$fileContent .= "LAST-MODIFIED:".$master->getTstamp()->format('Ymd\THis\Z')."\r\n";
								
								// Add alarm if alarm interval is set
								$alarm = $user->getTxFkupeoplePlanningAlarm();
								if ($alarm > 0) {
									if ($alarm == 99) {
										$fileContent .= "BEGIN:VALARM\r\n";
										$fileContent .= "TRIGGER:-P20DT19H0M0S\r\n";
										$fileContent .= "ACTION:DISPLAY\r\n";
										$fileContent .= "DESCRIPTION:Event reminder\r\n";
										$fileContent .= "END:VALARM\r\n";
										
									} else {
										$fileContent .= "BEGIN:VALARM\r\n";
										$fileContent .= "TRIGGER:-P".$alarm."D\r\n";
										$fileContent .= "ACTION:DISPLAY\r\n";
										if ($alarm == 1) {
											$fileContent .= "DESCRIPTION:Morgen ".$duties."\r\n";
										} else {
											$fileContent .= "DESCRIPTION:".$duties." in ".$alarm." Tagen\r\n";
										}
										$fileContent .= "END:VALARM\r\n";
									}
								}
								// End event description
								$fileContent .= "END:VEVENT\r\n";
							}							
						}
					}
				}
			
				// update file
				$completeFile = self::getFileHeader($user->getName()) . $fileContent . self::getFileFooter();
				$filesystem->dumpFile($absoluteFilePathAndName, $completeFile);
				$counter++;
			}
		}
		return $counter;
	}

	/**
	 * escapeText
	 *
	 * @var \string $text
	 * @return \string
	 */
	protected static function escapeText($text) {
		$text = str_replace("\r\n", "\\n", $text);
		$text = str_replace(",", "\,", $text);
		$text = str_replace(";", "\;", $text);
		return $text;
	}
	
	/**
	 * getFileHeader
	 *
	 * @var \string $username
	 * @return \string
	 */
	protected static function getFileHeader ($username) {
		$fileHeader = "";
		$fileHeader .= "BEGIN:VCALENDAR\r\n";
		$fileHeader .= "VERSION:2.0\r\n";
		$fileHeader .= "PRODID:-//FKU//Freie Kirche Uster 1.0//DE\r\n";
		$fileHeader .= "CALSCALE:GREGORIAN\r\n";
		$fileHeader .= "METHOD:PUBLISH\r\n";
		$fileHeader .= "X-WR-CALNAME:FKU-Einsätze ".$username."\r\n";
		$fileHeader .= "X-WR-TIMEZONE:Europe/Zurich\r\n";
		$fileHeader .= "BEGIN:VTIMEZONE\r\n";
		$fileHeader .= "TZID:Europe/Berlin\r\n";
		$fileHeader .= "X-LIC-LOCATION:Europe/Berlin\r\n";
		$fileHeader .= "BEGIN:DAYLIGHT\r\n";
		$fileHeader .= "TZOFFSETFROM:+0100\r\n";
		$fileHeader .= "TZOFFSETTO:+0200\r\n";
		$fileHeader .= "TZNAME:CEST\r\n";
		$fileHeader .= "DTSTART:19700329T020000\r\n";
		$fileHeader .= "RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU\r\n";
		$fileHeader .= "END:DAYLIGHT\r\n";
		$fileHeader .= "BEGIN:STANDARD\r\n";
		$fileHeader .= "TZOFFSETFROM:+0200\r\n";
		$fileHeader .= "TZOFFSETTO:+0100\r\n";
		$fileHeader .= "TZNAME:CET\r\n";
		$fileHeader .= "DTSTART:19701025T030000\r\n";
		$fileHeader .= "RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU\r\n";
		$fileHeader .= "END:STANDARD\r\n";
		$fileHeader .= "END:VTIMEZONE\r\n";
		return $fileHeader;
	}
		
	/**
	 * getFileFooter
	 *
	 * @return \string
	 */
	protected static function getFileFooter () {
		return "END:VCALENDAR\r\n";
	}
}
?>