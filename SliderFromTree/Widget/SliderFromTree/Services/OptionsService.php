<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree\Widget\SliderFromTree\Services;

class OptionsService
{
    public function update(array $postData, array $currentData): array
    {
        if (isset($postData['pageId'])) {
            $currentData['pageId'] = $postData['pageId'];
        }
        if (isset($postData['pageTitle'])) {
            $currentData['pageTitle'] = $postData['pageTitle'];
        }
        if (isset($postData['showButton'])) {
            $currentData['showButton'] = (int)$postData['showButton'];
        }

        return $currentData;
    }
}