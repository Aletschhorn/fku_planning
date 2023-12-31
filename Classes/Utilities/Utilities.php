<?php
namespace FKU\FkuPlanning\Utilities;

class Utilities {
	
	/**
	 * identifyUser
	 *
	 * @var \FKU\FkuPlanning\Domain\Model\Master $master
	 * @var \integer $me Person ID of FKU database
	 * @return \array
	 */
	public static function identifyUser (\FKU\FkuPlanning\Domain\Model\Master $master, int $me) {
		$myMaster = ['roles' => [], 'rolesText' => [], 'notifications' => []];
		foreach ($master->getServicePreacher() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'servicePreacher';
				$myMaster['rolesText'][] = 'Prediger';
				$myMaster['notifications'][] = 2;
			}
		}
		foreach ($master->getServiceModerator() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceModerator';
				$myMaster['rolesText'][] = 'Moderator';
				$myMaster['notifications'][] = 3;
			}
		}
		foreach ($master->getServiceMusicSelect() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceMusicSelect';
				$myMaster['rolesText'][] = 'Liederauswahl';
				$myMaster['notifications'][] = 7;
			}
		}
		foreach ($master->getServiceMusicRehearse() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceMusicRehearse';
				$myMaster['rolesText'][] = 'Musik-Probe organisieren';
				$myMaster['notifications'][] = 6;
			}
		}
		foreach ($master->getServiceMusicBand() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceMusicBand';
				$myMaster['rolesText'][] = 'Musikteam';
				$myMaster['notifications'][] = 5;
			}
		}
		foreach ($master->getServiceMusicOrgan() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceMusicOrgan';
				$myMaster['rolesText'][] = 'Organist';
				$myMaster['notifications'][] = 5;
			}
		}
		foreach ($master->getServiceBeamer() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceBeamer';
				$myMaster['rolesText'][] = 'Beamer';
				$myMaster['notifications'][] = 8;
			}
		}
		foreach ($master->getServiceConsole() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceConsole';
				$myMaster['rolesText'][] = 'Mischpult';
				$myMaster['notifications'][] = 9;
			}
		}
		foreach ($master->getServiceCamera() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceCamera';
				$myMaster['rolesText'][] = 'Kamera';
				$myMaster['notifications'][] = 30;
			}
		}
		foreach ($master->getServiceFilmeditor() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceFilmeditor';
				$myMaster['rolesText'][] = 'Livestream-Schnitt';
				$myMaster['notifications'][] = 31;
			}
		}
		foreach ($master->getServiceSexton() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceSexton';
				$myMaster['rolesText'][] = 'Sigrist';
				$myMaster['notifications'][] = 10;
			}
		}
		foreach ($master->getServiceWelcome() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceWelcome';
				$myMaster['rolesText'][] = 'Türbegrüssung';
				$myMaster['notifications'][] = 11;
			}
		}
		foreach ($master->getServiceMissionary() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceMissionary';
				$myMaster['rolesText'][] = 'Fürbitte für die weltweite Kirche';
				$myMaster['notifications'][] = 4;
			}
		}
		foreach ($master->getServiceSupperPeople() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceSupperPeople';
				$myMaster['rolesText'][] = 'Abendmahl';
				$myMaster['notifications'][] = 27;
			}
		}
		foreach ($master->getChildrenPeople() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'childrenPeople';
				$myMaster['rolesText'][] = 'Kinderhüeti';
				$myMaster['notifications'][] = 14;
			}
		}
		foreach ($master->getKidsPlaying() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'kidsPlaying';
				$myMaster['rolesText'][] = 'Spielstrasse';
				$myMaster['notifications'][] = 13;
			}
		}
		foreach ($master->getKidsSinging() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'kidsSinging';
				$myMaster['rolesText'][] = 'Singen Kidstreff';
				$myMaster['notifications'][] = 13;
			}
		}
		foreach ($master->getKidsPlenum() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'kidsPlenum';
				$myMaster['rolesText'][] = 'Plenum Kidstreff';
				$myMaster['notifications'][] = 13;
			}
		}
		foreach ($master->getKidsGroup1() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'kidsGroup1';
				$myMaster['rolesText'][] = 'Kleingruppe Habakuk';
				$myMaster['notifications'][] = 13;
			}
		}
		foreach ($master->getKidsGroup2() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'kidsGroup2';
				$myMaster['rolesText'][] = 'Kleingruppe Karibu';
				$myMaster['notifications'][] = 13;
			}
		}
		foreach ($master->getKidsGroup3() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'kidsGroup3';
				$myMaster['rolesText'][] = 'Kleingruppe Zundhölzli';
				$myMaster['notifications'][] = 13;
			}
		}
		foreach ($master->getKidsGroup3Program() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'kidsGroup3Program';
				$myMaster['rolesText'][] = 'Programm Zundhölzli';
				$myMaster['notifications'][] = 13;
			}
		}
		foreach ($master->getKidsYoung() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'kidsYoung';
				$myMaster['rolesText'][] = 'Sommervögeli';
				$myMaster['notifications'][] = 14;
			}
		}
		foreach ($master->getTeensPeople1() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'teensPeople1';
				$myMaster['rolesText'][] = 'Teenstreff 1./2. Jahr';
				$myMaster['notifications'][] = 12;
			}
		}
		foreach ($master->getTeensPeople2() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'teensPeople2';
				$myMaster['notifications'][] = 12;
				$myMaster['rolesText'][] = 'Teenstreff 3. Jahr';
			}
		}
		foreach ($master->getCoffeePeople() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'coffeePeople';
				$myMaster['rolesText'][] = 'Chilekafi';
				$myMaster['notifications'][] = 18;
			}
		}
		foreach ($master->getCoffeeSpecial() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'coffeeSpecial';
				$myMaster['rolesText'][] = 'Kaffeemaschine';
				$myMaster['notifications'][] = 19;
			}
		}
		foreach ($master->getDrivingPeople() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'drivingPeople';
				$myMaster['rolesText'][] = 'Fahrdienst';
				$myMaster['notifications'][] = 16;
			}
		}
		foreach ($master->getPrayerPeople() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'prayerPeople';
				$myMaster['rolesText'][] = 'Gebet nach GD';
				$myMaster['notifications'][] = 17;
			}
		}
		foreach ($master->getServiceWinter() as $person) {
			if ($person->getUid() == $me) {
				$myMaster['roles'][] = 'serviceWinter';
				$myMaster['rolesText'][] = 'Winterdienst';
				$myMaster['notifications'][] = 20;
			}
		}

		if (count($myMaster['rolesText']) > 0) {
			$myMaster['master'] = $master;
			$myMaster['notifications'] = array_unique($myMaster['notifications']);
			return $myMaster;
		} else {
			return false;
		}
	}
	
}
?>