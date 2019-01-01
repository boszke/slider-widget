<div class="ip">
    <div id="ipWidgetSliderFromTreeOptions" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php _e('Options', 'Ip-admin'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php
                    $form = new \Ip\Form();
                    $form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);

                    $field = new \Ip\Form\Field\Info(
                            [
                        'name'  => 'page',
                        'label' => __('Page', 'SliderFromTree', false),
                        'html'  => '<div class="form-group browsePage">
                                        <div class="input-group">
                                            <input class="form-control " name="pageId" type="text" value="">
                                            <span class="input-group-btn btn-page">
                                                <button class="ipsBrowse btn btn-default" type="button">' . __('Browse', 'Ip-admin') . '</button>
                                            </span>
                                        </div>
                                        <div class="form-group">Wybrana strona: <label></label></div>
                                    </div>'
                    ]);
                    $form->addField($field);

                    $field = new \Ip\Form\Field\Checkbox(
                            [
                        'name'  => 'showButton',
                        'label' => __('Show button', 'SliderFromTree', false),
                    ]);
                    $form->addField($field);


                    echo $form;
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Cancel', 'Ip-admin'); ?></button>
                    <button type="button" class="btn btn-primary ipsConfirm"><?php echo __('Confirm', 'Ip-admin'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
