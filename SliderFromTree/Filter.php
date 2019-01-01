<?php
/**
 * @package   ImpressPages
 */


namespace Plugin\SliderFromTree;


class Filter {

    /**
     * @param \Ip\Form $form
     * @return mixed
     */
    
    //Plugin View in admin (page settings)
    public static function ipPagePropertiesForm($form, $info)
    {
        $values = ipPageStorage($info['pageId'])->getAll();

        //create form
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
