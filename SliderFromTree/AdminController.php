<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree;

class AdminController
{
    public function getPageIdAndTitle(): \Ip\Response\Json
    {
        $data = ipRequest()->getQuery();

        if (!isset($data['pageId'])) {
            throw new \Ip\Exception("Page id is not set");
        }
        $pageId = (int)$data['pageId'];

        $page = new \Ip\Page($pageId);

        return new \Ip\Response\Json(
            [
                'pageId'    => $pageId,
                'pageTitle' => $page->getTitle(),
            ]
        );
    }
}
