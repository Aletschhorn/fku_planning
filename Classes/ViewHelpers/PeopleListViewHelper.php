<?php
namespace FKU\FkuPlanning\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

class PeopleListViewHelper extends AbstractViewHelper {

    /**
     * Shows a list of names from an array of user objects
     */

	use CompileWithRenderStatic;

    public function initializeArguments() {
        $this->registerArgument('list', 'array', 'Array of people objects', true);
        $this->registerArgument('append', 'string', 'MIME file type expresseion', false, '');
        $this->registerArgument('short', 'boolean', 'MIME file type expresseion', false, false);
	}

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
	public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$list = $renderChildrenClosure();
		if (! $list) {
			$list = $arguments['list'];
		}
		
		$output = '';
		if (is_object($list)) {
			$number = count($list);
			$counter = 0;
			foreach ($list as $person) {
				$counter++;
				if ($short and $person->getFirstname()) {
					$output .= $person->getFirstname().' '.substr($person->getLastname(),0,1).'.';
				} else {
					$output .= $person->getName();
				}
				$output .= $append;
				if ($counter < $number) {
					$output .= ', ';
				}
			}
			return $output;
		} else {
			return NULL;
		}
	}
}

?>