
var IpWidget_SliderFromTree = function () {
    this.$widgetObject = null;
    this.data = null;
    this.$controls = null;
    this.widgetId = null;

    var widgetClass = 'ipWidget-SliderFromTree';

    this.init = function ($widgetObject, data) {
        var currentScope = this;
        this.$widgetObject = $widgetObject;
        this.data = data;
        this.widgetId = this.$widgetObject.data('widgetid');

        var context = this;

        var customTinyMceConfig = ipTinyMceConfig();
        customTinyMceConfig.plugins = [
            "advlist, paste, link, table, colorpicker, textcolor, alignrollup, anchor, autolink, code, preview, textpattern, lineheight, colorpicker"
        ];
        customTinyMceConfig.menubar = true;
        customTinyMceConfig.toolbar1 = 'bold italic underline alignrollup styleselect removeformat table, undo redo, lineheightselect, fontselect';
        customTinyMceConfig.toolbar2 = 'link bullist numlist outdent indent subscript superscript forecolor backcolor, fontsizeselect',
                
                customTinyMceConfig.setup = function (ed, l) {
                    ed.on('change', function (e) {
                        var data = {
                            method: 'saveTextFields'
                        };
                        data.text = {
                            header: $widgetObject.find('.tHead').html(),
                            description: $widgetObject.find('.tDesc').html()
                        };

                        $widgetObject.save(data);

                    })
                };

        $widgetObject.find('.ipsContainer').tinymce(customTinyMceConfig);
        $widgetObject.find('.ipsContainer').attr('spellcheck', true);

        // hiding active editor to make sure it doesn't appear on top of repository window
        $(document).on('ipWidgetAdded', function (e, data) {
            if (tinymce.activeEditor.theme.panel) {
                tinymce.activeEditor.theme.panel.hide();
            }
        });

        $widgetObject.find('.ipsManage').off().on('click', function (e) {
            e.preventDefault();
            $.proxy(managePopup, context)();
        });

        $('#ipWidgetSliderFromTreeOptions .ipsModuleFormAdmin .browsePage').ipFormUrlId();

    };
    
    //START WYBIERANIA STRONY I ZWROCENIA ID
    var methodsFindPageId = {

        init: function (options) {


            return this.each(function () {

                var $this = $(this);
                var $input = $this.find('input');
                var $label = $this.find('label');

                var data = $this.data('ipFormUrl');
                if (!data) {

                    $this.data('ipFormUrl', {initialized: 1});

                    $this.find('.ipsBrowse').on('click', function () {
                        var $$this = $(this);

                        // searching for parent modal
                        var $modal = $$this.closest('.modal');
                        var isInModal = $modal.length ? true : false;

                        // if action is in modal, we're hiding it
                        if (isInModal) {
                            $modal.modal('hide');
                        }

                        ipBrowseLinkId(function (response) {

                            if (response.pageId) {
                                $input.val(response.pageId).change();
                            }
                            if (response.pageTitle) {
                                $label.text(response.pageTitle);
                            }

                            // if action is in modal, we're need to reopen it
                            if (isInModal) {
                                $modal.modal('show');
                            }
                        });
                    });

                }
            });
        }
    };
    
    function ipBrowseLinkId(callback) {

        var selectedPageId = null;
        var $modal = $('#ipBrowseLinkModal'),
                $iframe = $modal.find('.ipsPageSelectIframe');

        $iframe.attr('src', $iframe.data('source'));

        $modal.modal();
        var $iframeContent = $iframe.contents();

        $modal.find('.ipsConfirm').on('click', function () {
            var iframeWindow = $iframe.get(0).contentWindow;
            selectedPageId = iframeWindow.angular.element(iframeWindow.$('.ipAdminPages')).scope().selectedPageId;
            $modal.modal('hide');
        });

        $modal.off('hide.bs.modal').on('hide.bs.modal', function () {
            if (!selectedPageId) {
                callback('');
                return;
            }

            //page selected. Get the Page title and ID
            $.ajax({
                type: 'GET',
                url: ip.baseUrl,
                data: {aa: 'SliderFromTree.getPageIdAndTitle', pageId: selectedPageId},
                dataType: 'json',
                success: function (response) {
                    callback(response);
                },
                error: function (response) {
                    if (ip.developmentEnvironment || ip.debugMode) {
                        alert('Server response: ' + response.responseText);
                    }
                    callback('');
                }
            });
        });
    }
    
    $.fn.ipFormUrlId = function () {
        return methodsFindPageId.init.apply(this, arguments);
    };
    
    //KONIEC WYBIERANIA STRONY I ZWROCENIA ID

    var managePopup = function (index, callback) {
        var context = this;
        this.popup = $('#ipWidgetSliderFromTreeOptions');
        this.confirmButton = this.popup.find('.ipsConfirm');
        this.pageId = this.popup.find('input[name=pageId]');
        this.pageTitle = this.popup.find('.browsePage').find('label');
        this.showButton = this.popup.find('input[name=showButton]');
        var data = this.data;

        if (data.pageId) {
            this.pageId.val(data.pageId);
        } else {
            this.pageId.val(''); // cleanup value if it was set before
        }
        
        if (data.pageTitle) {
            this.pageTitle.text(data.pageTitle);
        } else {
            this.pageTitle.text(''); // cleanup value if it was set before
        }

        if (data.showButton) {
            this.showButton.attr('checked', true);
        } else {
            this.showButton.attr('checked', false);
        }

        this.popup.modal(); // open modal popup

        ipInitForms();

        this.confirmButton.off().on('click', function () {
            $.proxy(saveOptions, context)(callback)
        });

    };

    var saveOptions = function (callback) {
        var data = {
            method: 'saveOptions',
            pageId: this.pageId.val(),
            pageTitle: this.pageTitle.text(),
            showButton: this.showButton.prop('checked') ? 1 : 0,
        };

        this.$widgetObject.save(data, 1, callback); // save and reload widget
        this.popup.modal('hide');
    };
    
};

