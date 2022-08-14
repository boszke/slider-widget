<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree\Widget\SliderFromTree\Services;

class TextFieldsService
{
    public function update(array $postData, array $currentData): array
    {
        $currentData['text'] = [
            'header'      => $postData['text']['header'],
            'description' => $postData['text']['description'],
        ];

        return $currentData;
    }
}