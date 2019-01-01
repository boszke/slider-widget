<?php
/**
 * @package ImpressPages
 *
 */
namespace Plugin\SliderFromTree\Widget\SliderFromTree;


class Controller extends \Ip\WidgetController
{


    public function getTitle()
    {
        return __('Slider From Tree', 'SliderFromTree', false);
    }
    
    /**
     * Array 0f menu items to be added to the widget's options menu. (gear box on the left top corner of the widget)
     * @param $revisionId
     * @param $widgetId
     * @param $data
     * @param $skin
     * @return array
     */
    public function optionsMenu($revisionId, $widgetId, $data, $skin)
    {
        $answer = [];

        $answer[] = [
            'title' => __('Options', 'Ip-admin', false),
            'attributes' => [
                'class' => 'ipsManage'
            ]
        ];

        return $answer;
    }

    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {
        $pages = [];
        if (isset($data['pageId'])) {
            $pageId   = (int) $data['pageId'];
            $parentPage = ipPage($pageId);
            $children = $parentPage->getChildren();
            
            foreach ($children as $page) {
                $pageBanner = $this->getPageBanner($page->getId());
                $pageStorage = ipPageStorage($page->getId())->getAll();
                
                $pages[] = [
                    'id'          => $page->getId(),
                    'link'        => $page->getLink(),
                    'title'       => empty($pageStorage['sftTitle']) ? $page->getTitle() : $pageStorage['sftTitle'],
                    'image'       => $pageBanner,
                    'subtitle'    => empty($pageStorage['sftSubtitle']) ? '' : $pageStorage['sftSubtitle'],
                    'description' => empty($pageStorage['sftDescription']) ? '' : $pageStorage['sftDescription']
                ];
            }
            
            if (!empty($data['showButton'])) {
                $redirectUrl = $parentPage->getRedirectUrl();
                $data['showButton'] = empty($redirectUrl) ? $parentPage->getLink() : $redirectUrl;
            }
        }
        
        $data['pages'] = $pages;

        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }
    
    private function getPageBanner($pageId)
    {
        $pageBanner = ipPageStorage($pageId)->get('PageBanner');

        $transformSmall = [
            'type'   => 'fit',
            'width'  => 800,
            'height' => 800,
            'forced' => false
        ];

        return empty($pageBanner) ? '' : ipFileUrl(ipReflection($pageBanner[0], $transformSmall));
    }

    public function update($widgetId, $postData, $currentData)
    {
        if (isset($postData['method'])) {
            switch ($postData['method']) {
                case 'saveOptions':
                    if (!isset($postData)) {
                        throw new \Ip\Exception("Missing required parameter");
                    }

                    if (isset($postData['pageId'])) {
                        $currentData['pageId'] = $postData['pageId'];
                    }
                    if (isset($postData['pageTitle'])) {
                        $currentData['pageTitle'] = $postData['pageTitle'];
                    }
                    if (isset($postData['showButton'])) {
                        $currentData['showButton'] = (int)$postData['showButton'];
                    }
                    
                    break;
                case 'saveTextFields':
                    if (!isset($postData)) {
                        throw new \Ip\Exception("Missing required parameter");
                    }

                    $currentData['text'] = [
                        'header'     => $postData['text']['header'],
                        'description' => $postData['text']['description'],
                    ];

                    break;
            }
        }
        
        return $currentData;
    }

}
