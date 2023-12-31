<?php
namespace FKU\FkuPlaning\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use FKU\FkuPeople\Domain\Repository\NotificationruleRepository;

class ext_update {
	
	/**
	 * @var string Extension name
     */
	protected $extensionName = 'fku_planning';

	/**
	 * @var array Notification rules
     */
	protected $notificationRules = array (
		array (1, 'ich in %s irgend einen Gottesdienst-Einsatz habe', 'In %1$s, am %2$s, habe ich einen Gottesdienst-Einsatz.', 0, 1, 0),
		array (2, 'ich in %s für die Predigt im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für die Predigt im Gottesdienst zuständig. Das Thema ist "%3$s".', 0, 1, 0),
		array (3, 'ich in %s für die Leitung im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für die Leitung im Gottesdienst zuständig. Das Thema ist "%3$s".', 0, 1, 0),
		array (4, 'ich in %s für die Fürbitte für die weltweite Kirche im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für die Fürbitte für die weltweite Kirche im Gottesdienst zuständig.', 0, 1, 0),
		array (5, 'ich in %s einen Musik-Einsatz im Gottesdienst habe', 'In %1$s, am %2$s, habe ich einen Musik-Einsatz im Gottesdienst.', 0, 1, 0),
		array (6, 'in %s ein Gottesdienst stattfindet, für welchen ich die Musikprobe organisiere', 'In %1$s, am %2$s, findet ein Gottesdienst statt, für welchen ich die Musikprobe organisiere.', 0, 1, 0),
		array (7, 'in %s ein Gottesdienst stattfindet, für welchen ich die Lieder auswähle', 'In %1$s, am %2$s, findet ein Gottesdienst statt, für welchen ich die Lieder auswähle. Das Thema ist "%3$s".', 0, 1, 0),
		array (8, 'ich in %s für den Beamer im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für den Beamer im Gottesdienst zuständig.', 0, 1, 0),
		array (9, 'ich in %s für das Mischpult im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für das Mischpult im Gottesdienst zuständig.', 0, 1, 0),
		array (10, 'ich in %s als Sigrist im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich als Sigrist im Gottesdienst zuständig.', 0, 1, 0),
		array (11, 'ich in %s für die Türbegrüssung im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für die Türbegrüssung im Gottesdienst zuständig.', 0, 1, 0),
		array (12, 'ich in %s einen Teenstreff-Einsatz habe', 'In %1$s, am %2$s, habe ich einen Teenstreff-Einsatz.', 0, 1, 0),
		array (13, 'ich in %s einen Kidstreff-Einsatz habe', 'In %1$s, am %2$s, habe ich einen Kidstreff-Einsatz. Das Thema ist "%6$s".', 0, 1, 0),
		array (14, 'ich in %s einen Summervögeli-Einsatz habe', 'In %1$s, am %2$s, habe ich einen Summervögeli-Einsatz.', 0, 1, 0),
		array (15, 'ich in %s einen Kinderhüeti-Einsatz habe', 'In %1$s, am %2$s, habe ich einen Kinderhüeti-Einsatz.', 0, 1, 0),
		array (16, 'ich in %s für den Fahrdienst des Gottesdiensts zuständig bin', 'In %1$s, am %2$s, bin ich für den Fahrdienst des Gottesdiensts zuständig.', 0, 1, 0),
		array (17, 'ich in %s für das Gebet nach dem Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für das Gebet nach dem Gottesdienst zuständig.', 0, 1, 0),
		array (18, 'ich in %s für den Chilekafi zuständig bin', 'In %1$s, am %2$s, bin ich für den Chilekafi zuständig.', 0, 1, 0),
		array (19, 'ich in %s für die Kaffeemaschine im Chilekafi zuständig bin', 'In %1$s, am %2$s, bin ich für die Kaffeemaschine im Chilekafi zuständig.', 0, 1, 0),
		array (20, 'ich in %s für den Winterdienst des Gottesdienstes zuständig bin', 'In %1$s, am %2$s, bin ich für den Winterdienst des Gottesdienstes zuständig (inklusive die ganze Woche davor).', 0, 1, 0),
		array (21, 'die Planung eines Gottesdienst, in den ich involviert bin, verändert wurde', 'Im Gottesdienst vom %1$s hat %2$s die Angabe %3$s von "%4$s" zu "%5$s" verändert.', 1, 1, 1),
		array (22, 'die Planung eines Teenstreffs, in den ich involviert bin, verändert wurde', 'Im Teenstreff vom %1$s hat %2$s die Angabe %3$s von "%4$s" zu "%5$s" verändert.', 1, 1, 1),
		array (23, 'die Planung eines Kidstreffs, in den ich involviert bin, verändert wurde', 'Im Kidstreff vom %1$s hat %2$s die Angabe %3$s von "%4$s" zu "%5$s" verändert.', 1, 1, 1),
		array (24, 'die Planung einer Kinderhüeti, in die ich involviert bin, verändert wurde', 'In der Kinderhüeti vom %1$s hat %2$s die Angabe %3$s von "%4$s" zu "%5$s" verändert.', 1, 1, 1),
		array (25, 'die Vorher-Nachher-Angaben eines Gottesdiensts, in die ich involviert bin, verändert wurden', 'In den Vorher-Nachher-Angaben des Gottesdiensts vom %1$s hat %2$s die Angabe %3$s von "%4$s" zu "%5$s" verändert.', 1, 1, 1),
		array (26, 'irgendwelche Angaben eines Gottesdienstes verändert wurden', 'Im Gottesdienst vom %1$s hat %2$s die Angabe %3$s von "%4$s" zu "%5$s" verändert.', 1, 1, 1),
		array (27, 'ich in %s für das Abendmahl im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für das Abendmahl im Gottesdienst zuständig.', 0, 1, 0),
		array (28, 'der Gottesdienst in %s nicht zur üblichen Zeit beginnt', 'In %1$s, am %2$s, beginnt der Gottesdienst ausnahmsweise um %3$s Uhr.', 0, 1, 0),
		array (29, 'eine neue Predigt hochgeladen wurde', 'Die Predigt vom %1$s wurde auf die Website hochgeladen.', 1, 1, 1),
		array (30, 'ich in %s für die Kamera im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für die Kamera im Gottesdienst zuständig.', 0, 1, 0),
		array (31, 'ich in %s für den Livestream-Schnitt im Gottesdienst zuständig bin', 'In %1$s, am %2$s, bin ich für den Livestream-Schnitt im Gottesdienst zuständig.', 0, 1, 0)
	);

	/**
	 * Main function, returning the HTML content
	 *
	 * @return string HTML
     */
	public function main() {
		$new = 0;
		$update = 0;

		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$notificationruleRepository = $objectManager->get(NotificationruleRepository::class);

		foreach ($this->notificationRules as $rule) {
			$notification = $notificationruleRepository->findSingle($this->extensionName,$rule[0])->getFirst();
			if ($notification) {
				$notification->setTitle($rule[1]);
				$notification->setMessage($rule[2]);
				$notification->setTimingNow($rule[3]);
				$notification->setTimingDay($rule[4]);
				$notification->setTimingWeek($rule[5]);
				$notificationruleRepository->update($notification);
				$update++;
			} else {
				$notification = new \FKU\FkuPeople\Domain\Model\Notificationrule;
				$notification->setExtension($this->extensionName);
				$notification->setNid($rule[0]);
				$notification->setTitle($rule[1]);
				$notification->setMessage($rule[2]);
				$notification->setTimingNow($rule[3]);
				$notification->setTimingDay($rule[4]);
				$notification->setTimingWeek($rule[5]);
				$notificationruleRepository->add($notification);
				$new++;
			}
		}
		$content = 'Added '.$new.' and updated '.$update.' notification rules in database';
		return $content;		
	}
	
	/**
	 * Access function, flag to allow or disallow execution
	 *
	 * @return boolean
     */
	public function access() {
		return true;
	}	
}
?>