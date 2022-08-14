<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree\Widget\SliderFromTree\Services;

use Plugin\SliderFromTree\Widget\SliderFromTree\Services\Contracts\PageBannerInterface;

class ContentService
{
    public function getPagesContent(int $pageId, PageBannerInterface $pageBanner): array
    {
        $pages = [];

        $parentPage = ipPage($pageId);
        $children = $parentPage->getChildren();

        foreach ($children as $page) {
            $pageStorage = ipPageStorage($page->getId())->getAll();

            $pages[] = [
                'id'          => $page->getId(),
                'link'        => $page->getLink(),
                'title'       => empty($pageStorage['sftTitle']) ? $page->getTitle() : $pageStorage['sftTitle'],
                'image'       => $pageBanner->getPageBanner($page->getId()),
                'subtitle'    => empty($pageStorage['sftSubtitle']) ? '' : $pageStorage['sftSubtitle'],
                'description' => empty($pageStorage['sftDescription']) ? '' : $pageStorage['sftDescription'],
            ];
        }

        return $pages;
    }

    public function getRedirectUrl(int $pageId): string
    {
        $parentPage = ipPage($pageId);
        $redirectUrl = $parentPage->getRedirectUrl();

        return empty($redirectUrl) ? $parentPage->getLink() : $redirectUrl;
    }
}