<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree\Widget\SliderFromTree;

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
            $parentPage = ipPage($pageId);
            $children = $parentPage->getChildren();

            foreach ($children as $page) {
                $pageBanner = $this->getPageBanner($page->getId());
                $pageStorage = ipPageStorage($page->getId())->getAll();

                $pages[] = [
                    'id'          => $page->getId(),
                    'link'        => $page->getLink(),
                    'title'       => empty($pageStorage['sftTitle']) ? $page->getTitle() : $pageStorage['sftTitle'],
                    'image'       => $pageBanner,
                    'subtitle'    => empty($pageStorage['sftSubtitle']) ? '' : $pageStorage['sftSubtitle'],
                    'description' => empty($pageStorage['sftDescription']) ? '' : $pageStorage['sftDescription'],
                ];
            }

            if (!empty($data['showButton'])) {
                $redirectUrl = $parentPage->getRedirectUrl();
                $data['showButton'] = empty($redirectUrl) ? $parentPage->getLink() : $redirectUrl;
            }
        }

        $data['pages'] = $pages;

        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }

    private function getPageBanner(int $pageId): string
    {
        $pageBanner = ipPageStorage($pageId)->get('PageBanner');

        $transformSmall = [
            'type'   => 'fit',
            'width'  => 800,
            'height' => 800,
            'forced' => false,
        ];

        return empty($pageBanner) ? '' : ipFileUrl(ipReflection($pageBanner[0], $transformSmall));
    }

    public function update(int $widgetId, array $postData, array $currentData): array
    {
        if (isset($postData['method'])) {
            switch ($postData['method']) {
                case 'saveOptions':
                    if (!isset($postData)) {
                        throw new \Ip\Exception("Missing required parameter");
                    }

                    if (isset($postData['pageId'])) {
                        $currentData['pageId'] = $postData['pageId'];
                    }
                    if (isset($postData['pageTitle'])) {
                        $currentData['pageTitle'] = $postData['pageTitle'];
                    }
                    if (isset($postData['showButton'])) {
                        $currentData['showButton'] = (int)$postData['showButton'];
                    }

                    break;
                case 'saveTextFields':
                    if (!isset($postData)) {
                        throw new \Ip\Exception("Missing required parameter");
                    }

                    $currentData['text'] = [
                        'header'      => $postData['text']['header'],
                        'description' => $postData['text']['description'],
                    ];

                    break;
            }
        }

        return $currentData;
    }
}
