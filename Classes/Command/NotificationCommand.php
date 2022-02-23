<?php
namespace FKU\FkuPlanning\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use FKU\FkuPlanning\Utilities\Utilities;
use FKU\FkuPlanning\Domain\Repository\MasterRepository;
use FKU\FkuPeople\Domain\Repository\NotificationRepository;
use FKU\FkuPeople\Domain\Repository\NotificationruleRepository;
use FKU\FkuPeople\Domain\Repository\UserRepository;

class NotificationCommand extends Command {
	
    /**
     * Configure the command
     */
    protected function configure() {
        $this->setDescription('Creates notification texts for FE users based on reminder settings');
        $this->setHelp('Creates reminder texts for individual FE users that have setup such notifications and stores the text in the daily notification text storage in fe_users');
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {

		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$masterRepository = $objectManager->get(MasterRepository::class);
		$configurationManager = $objectManager->get(ConfigurationManagerInterface::class);
		$settings = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'FkuPlanning', 'Serviceplan');

        $io = new SymfonyStyle($input, $output);

		// find masters in the right date range
		setlocale(LC_TIME, "de_CH");
		$today = new \DateTime('Today');
		$end = clone $today;
		$end->modify('+1 month');
		$masters = $masterRepository->findInDateRange($today, $end);
		if ($masters->count() == 0) { 
	        $io->writeln('No events found within one month. No notifications created.');
			return Command::SUCCESS;
		}
		
		$userRepository = $objectManager->get(UserRepository::class);
		$notificationRepository = $objectManager->get(NotificationRepository::class);
		$notificationruleRepository = $objectManager->get(NotificationruleRepository::class);
		$notifications = $notificationRepository->findAllOfExtension('fku_planning');

		// Search notifications
		if ($notifications->count() == 0) {
	        $io->writeln('No notification rules for fku_planning found.');
			return Command::SUCCESS;
		}

		foreach ($notifications as $notification) {
			$user = $notification->getUser();
			// verify if user is still active?
			$me = $user->getTxFkupeopleFkudbid();
			if ($me > 0) {
				$days = $notification->getDays();
				foreach ($masters as $master) {
					$interval = intval($today->diff($master->getDate())->days);
					if ($interval == $days) {
						$myMaster = Utilities::identifyUser($master,$me);
						if ($notification->getRule()->getNid() == 28 and $master->getDate()->format('H.i') != $settings['defaultStartTime']) {
							// notification if service takes place to unusual time
							if ($notification->getRule()->getMessage()) {
								$text = $user->getTxFkupeopleNotificationCacheday();
								if ($interval > 1) {
									$fill1 = $days.' Tagen';
								} else {
									$fill1 = '1 Tag';
								}
								$fill2 = utf8_encode(strftime('%e. %B', $master->getDate()->getTimestamp()));
								$fill3 = $master->getDate()->format('H.i');
								$text .= sprintf($notification->getRule()->getMessage(), $fill1, $fill2, $fill3);
								$text .= chr(13).'-----'.chr(13);
								$user->setTxFkupeopleNotificationCacheday($text);
								$userRepository->update($user);
						        $io->writeln('Notification created for user '.$user->getName().' based on notification rule 28.');
							}
						} elseif ($notification->getRule()->getNid() == 1 and $myMaster !== false) {
							// notification is created even if user is not involved but any reason for notifications is given
							$text = $user->getTxFkupeopleNotificationCacheday();
							// no check for $notification->getTiming because it is supposed to be 1 in every case
							if ($interval > 1) {
								$fill1 = $days.' Tagen';
							} else {
								$fill1 = '1 Tag';
							}
							$fill2 = utf8_encode(strftime('%e. %B', $master->getDate()->getTimestamp()));
							$fill3 = $master->getServiceTopic();
							$fill4 = $master->getTeensTopic1();
							$fill5 = $master->getTeensTopic2();
							$fill6 = $master->getKidsTopic();
							foreach  ($myMaster['notifications'] as $ruleId) {
								if ($rule = $notificationruleRepository->findSingle('fku_planning',$ruleId)->getFirst()) {
									$text .= sprintf($rule->getMessage(), $fill1, $fill2, $fill3, $fill4, $fill5, $fill6);
									$text .= chr(13).'-----'.chr(13);
								}
							}
							$user->setTxFkupeopleNotificationCacheday($text);
							$userRepository->update($user);
					        $io->writeln('Notification(s) created for user '.$user->getName().' based on notification rule 1.');
						} else {
							if ($myMaster !== false and in_array($notification->getRule()->getNid(),$myMaster['notifications'])) {
								// notification is only created if user is involved in made change
								if ($notification->getRule()->getMessage()) {
									$text = $user->getTxFkupeopleNotificationCacheday();
									// no check for $notification->getTiming because it is supposed to be 1 in every case
									if ($interval > 1) {
										$fill1 = $days.' Tagen';
									} else {
										$fill1 = '1 Tag';
									}
									$fill2 = utf8_encode(strftime('%e. %B', $master->getDate()->getTimestamp()));
									$fill3 = $master->getServiceTopic();
									$fill4 = $master->getTeensTopic1();
									$fill5 = $master->getTeensTopic2();
									$fill6 = $master->getKidsTopic();
									$text .= sprintf($notification->getRule()->getMessage(), $fill1, $fill2, $fill3, $fill4, $fill5, $fill6);
									$text .= chr(13).'-----'.chr(13);
									$user->setTxFkupeopleNotificationCacheday($text);
									$userRepository->update($user);
							        $io->writeln('Notification created for user '.$user->getName().' based on notification rule '.$notification->getRule()->getNid().'.');
								}
							}
						}
					}
				}
			}
		}
		return Command::SUCCESS;
	}

}
?>