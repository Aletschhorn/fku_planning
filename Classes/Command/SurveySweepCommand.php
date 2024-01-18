<?php
namespace FKU\FkuPlanning\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use FKU\FkuPlanning\Domain\Repository\SurveyRepository;
use FKU\FkuPlanning\Domain\Repository\ReplyRepository;

class SurveySweepCommand extends Command {

    /**
     * Configure the command
     */
    protected function configure() {
        $this->setDescription('Deletes expired surveys');
        $this->setHelp('Finds and deletes expired surveys and the related replies');
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {

		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$this->surveyRepository = $objectManager->get(SurveyRepository::class);
		$this->replyRepository = $objectManager->get(ReplyRepository::class);

		$counter = 0;
		$surveys = $this->surveyRepository->findExpired();
		foreach ($surveys as $survey) {
			$replies = $this->replyRepository->findBySurvey($survey);
			foreach ($replies as $reply) {
				$this->replyRepository->remove($reply);
			}
			$this->surveyRepository->remove($survey);
			$counter++;
		}
		$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
		$persistenceManager->persistAll();

        $io = new SymfonyStyle($input, $output);
		$io->writeln($counter.' expired surveys deleted.');
		return Command::SUCCESS;
	}
}
?>