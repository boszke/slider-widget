<?php

declare(strict_types=1);

namespace Plugin\SliderFromTree;

class Filter {
    public static function ipPagePropertiesForm(\IP\Form $form, array $info): \IP\Form
    {
        $values = ipPageStorage($info['pageId'])->getAll();

        $fieldset = new \Ip\Form\Fieldset(__('Fields displayed in sliders', 'SliderFromTree', false));
        $form->addFieldset($fieldset);

        $form->addField(new \Ip\Form\Field\RichText(
            [
                'name' => 'sftTitle',
                'label' => __('Title displayed in sliders', 'SliderFromTree', false),
                'value' => empty($values['sftTitle']) ? '' : $values['sftTitle'],
            ]
        ));
           
        $form->addField(new \Ip\Form\Field\RichText(
            [
                'name' => 'sftSubtitle',
                'label' => __('Subtitle displayed in sliders', 'SliderFromTree', false),
                'value' => empty($values['sftSubtitle']) ? '' : $values['sftSubtitle'],
            ]
        ));
        
        $form->addField(new \Ip\Form\Field\RichText(
            [
                'name' => 'sftDescription',
                'label' => __('Description displayed in sliders', 'SliderFromTree', false),
                'value' => empty($values['sftDescription']) ? '' : $values['sftDescription'],
            ]
        ));

        return $form;
    }
}
