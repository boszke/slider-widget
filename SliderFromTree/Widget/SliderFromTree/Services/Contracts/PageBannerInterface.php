<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree\Widget\SliderFromTree\Services\Contracts;

interface PageBannerInterface
{
    public function getPageBanner(int $pageId): string;
}