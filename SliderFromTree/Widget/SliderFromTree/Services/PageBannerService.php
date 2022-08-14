<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree\Widget\SliderFromTree\Services;

use Plugin\SliderFromTree\Widget\SliderFromTree\Services\Contracts\PageBannerInterface;

class PageBannerService implements PageBannerInterface
{
    private const BANNER_FILE_CONFIG = [
        'type'   => 'fit',
        'width'  => 800,
        'height' => 800,
        'forced' => false,
    ];

    public function getPageBanner(int $pageId): string
    {
        $pageBanner = ipPageStorage($pageId)->get('PageBanner');

        return empty($pageBanner) ? '' : ipFileUrl(ipReflection($pageBanner[0] ?? '', self::BANNER_FILE_CONFIG));
    }
}