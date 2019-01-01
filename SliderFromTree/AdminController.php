<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 14.9.21
 * Time: 23.39
 */

namespace Plugin\SliderFromTree;

class AdminController
{
    public function getPageIdAndTitle()
    {
        $data = ipRequest()->getQuery();


        if (!isset($data['pageId'])) {
            throw new \Ip\Exception("Page id is not set");
        }
        $pageId = (int)$data['pageId'];

        $page = new \Ip\Page($pageId);

        $answer = array(
            'pageId' => $pageId,
            'pageTitle' => $page->getTitle(),
        );

        return new \Ip\Response\Json($answer);
    }
}
