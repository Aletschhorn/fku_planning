<?php
namespace FKU\FkuPlanning\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Daniel Widmer <daniel.widmer@fku.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * YoutubeController
 */

class YoutubeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
    
    /**
     * action define
     *
     * @return void
     */
    public function defineAction() {
		$this->view->assignMultiple(array(
			'url' => $url,
		));
    }

    /**
     * action show
     *
     * @param \string $url
     * @return void
     */
    public function showAction($url) {
		preg_match ('/(http|https):\/\/www.youtube.com\/(.*)v=([a-zA-Z0-9_]+)/', $url, $res);

		$this->view->assignMultiple(array(
			'url' => $url,
			'res' => $res,
		));
    }

}