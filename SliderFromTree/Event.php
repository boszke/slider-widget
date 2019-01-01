<?php

namespace Plugin\SliderFromTree;

class Event
{
    public static function ipPageUpdated($data)
    {
        if (ipRoute()->plugin() != 'Pages' || ipRoute()->action() != 'updatePage') {
            return; //we want to handle only page updates that are made from within Pages section.
        }

        $pageId = $data['id'];
        $pageStorage = ipPageStorage($pageId);
        $pageStorage->set('sftTitle', $data['sftTitle']);
        $pageStorage->set('sftSubtitle', $data['sftSubtitle']);
        $pageStorage->set('sftDescription', $data['sftDescription']);
    }

    public static function ipPageDuplicated($data)
    {
        $pageOldStorage = ipPageStorage($data['sourceId']);
        $values = $pageOldStorage->getAll();
        $oldData = [
            'sftTitle' => empty($values['sftTitle']) ? '' : $values['sftTitle'],
            'sftSubtitle' => empty($values['sftSubtitle']) ? '' : $values['sftSubtitle'],
            'sftDescription' => empty($values['sftDescription']) ? '' : $values['sftDescription'],
        ];

        $pageStorage = ipPageStorage($data['id']);
        $pageStorage->set('sftTitle', $oldData['sftTitle']);
        $pageStorage->set('sftSubtitle', $oldData['sftSubtitle']);
        $pageStorage->set('sftDescription', $oldData['sftDescription']);
    }
    
    public static function ipBeforePageRemoved($data)
    {
        $pageId = $data['pageId'];
        ipPageStorage($pageId)->remove('sftTitle');
        ipPageStorage($pageId)->remove('sftSubtitle');
        ipPageStorage($pageId)->remove('sftDescription');
    }

}
