<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree;

class Event
{
    public static function ipPageUpdated(array $data): void
    {
        if (ipRoute()->plugin() !== 'Pages' || ipRoute()->action() !== 'updatePage') {
            return; //we want to handle only page updates that are made from within Pages section.
        }

        $pageId = (int)$data['id'];
        $pageStorage = ipPageStorage($pageId);
        $pageStorage->set('sftTitle', $data['sftTitle']);
        $pageStorage->set('sftSubtitle', $data['sftSubtitle']);
        $pageStorage->set('sftDescription', $data['sftDescription']);
    }

    public static function ipPageDuplicated(array $data): void
    {
        $pageOldStorage = ipPageStorage($data['sourceId']);
        $values = $pageOldStorage->getAll();

        $pageStorage = ipPageStorage($data['id']);
        $pageStorage->set('sftTitle', empty($values['sftTitle']) ? '' : $values['sftTitle']);
        $pageStorage->set('sftSubtitle', empty($values['sftSubtitle']) ? '' : $values['sftSubtitle']);
        $pageStorage->set('sftDescription', empty($values['sftDescription']) ? '' : $values['sftDescription']);
    }

    public static function ipBeforePageRemoved(array $data): void
    {
        $pageId = (int)$data['pageId'];
        ipPageStorage($pageId)->remove('sftTitle');
        ipPageStorage($pageId)->remove('sftSubtitle');
        ipPageStorage($pageId)->remove('sftDescription');
    }

}
