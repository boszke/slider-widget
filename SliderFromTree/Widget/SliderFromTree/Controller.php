<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree\Widget\SliderFromTree;

use Plugin\SliderFromTree\Widget\SliderFromTree\Services\ContentService;
use Plugin\SliderFromTree\Widget\SliderFromTree\Services\OptionsService;
use Plugin\SliderFromTree\Widget\SliderFromTree\Services\PageBannerService;
use Plugin\SliderFromTree\Widget\SliderFromTree\Services\TextFieldsService;

class Controller extends \Ip\WidgetController
{
    public function getTitle(): string
    {
        return __('Slider From Tree', 'SliderFromTree', false);
    }

    public function optionsMenu(int $revisionId, int $widgetId, array $data, string $skin): array
    {
        $answer = [];

        $answer[] = [
            'title'      => __('Options', 'Ip-admin', false),
            'attributes' => [
                'class' => 'ipsManage',
            ],
        ];

        return $answer;
    }

    public function generateHtml(int $revisionId, int $widgetId, array $data, string $skin): string
    {
        $pages = [];
        if (isset($data['pageId'])) {
            $pageId = (int)$data['pageId'];
            $contentService = new ContentService();
            $pages = $contentService->getPagesContent($pageId, new PageBannerService());

            if (!empty($data['showButton'])) {
                $data['showButton'] = $contentService->getRedirectUrl($pageId);
            }
        }

        $data['pages'] = $pages;

        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }

    public function update(int $widgetId, array $postData, array $currentData): array
    {
        if (isset($postData['method'])) {
            if (!isset($postData)) {
                throw new \Ip\Exception("Missing required parameter");
            }

            switch ($postData['method']) {
                case 'saveOptions':
                    return (new OptionsService())->update($postData, $currentData);
                case 'saveTextFields':
                    return (new TextFieldsService())->update($postData, $currentData);
            }
        }
    }
}
