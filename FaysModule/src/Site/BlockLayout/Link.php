<?php
namespace FaysModule\Site\BlockLayout;

use Interop\Container\ContainerInterface;
use Omeka\Entity\SitePageBlock;
use Omeka\Stdlib\ErrorStore;
use Zend\Form\Element\Textarea;
use Zend\ServiceManager\Factory\FactoryInterface;

use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Zend\View\Renderer\PhpRenderer;

use Zend\Form\Element;
use Zend\Form\Form;

use Zend\Log\LoggerInterface;

class Link extends AbstractBlockLayout {


    public function getLabel() {
        return "FAYS Link";
    }

    public function onHydrate(SitePageBlock $block, ErrorStore $errorStore)
    {
        $data = $block->getData();
        $html = isset($data['html']) ? $this->htmlPurifier->purify($data['html']) : '';
        $data['html'] = $html;
        $block->setData($data);
    }


    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {

        $defaults = [
            'link' => '',
            'title' => '',
        ];


        $data = is_null($block) ? [] : $block->data();
        $values = array_merge($defaults, $data);

        $form = new Form();

        $form->add([
            'name' => Utility::fieldName('link'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link', 'info' => 'Link url.']
        ]);

        $form->add([
            'name' => Utility::fieldName('title'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Title', 'info' => 'Link title.']
        ]);

        $form->setData([
            Utility::fieldName('link') => $values['link'],
            Utility::fieldName('title') => $values['title'],
        ]);

        return  $view->blockAttachmentsForm($block) . $view->formCollection($form);
    }

	public function render(
        PhpRenderer $view, SitePageBlockRepresentation $block
    ) {

        $attachments = $block->attachments();


        $listings = [];

        foreach($attachments as $attachment ) {
            $item = $attachment->item();
            $img = "";
            if($item->media()) {
                $media = $item->media()[0];
                $img = $view->thumbnail($media, "square", ['title' => $media->displayTitle()]);
            }

            $listings[] = [
                "img" => $img,
            ];

        }



        return $view->partial(
            'common/block-layout/link',
            [
                'link' => $block->dataValue('link'),
                'title' => $block->dataValue('title'),
                'listings' => $listings
            ]
        );
    }
}

?>