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

class TwoColLayout extends AbstractBlockLayout {
    private $text;
    private $logger;
    protected $htmlPurifier;


    public function __construct($text, LoggerInterface $logger, $htmlPurifier) {
        $this->text = $text;
        $this->logger = $logger;
        $this->htmlPurifier = $htmlPurifier;
    }

    public function getLabel() {
        return "FAYS Two Col Layout";
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
            'html1' => '',
//            'html2' => ''
        ];

        $textarea1 = new Textarea(Utility::fieldName('html1'));
        $textarea1->setAttribute('class', 'block-html full wysiwyg');
//        $textarea2 = new Textarea(Utility::fieldName('html2'));
//        $textarea2->setAttribute('class', 'block-html full wysiwyg');

        if ($block) {
            $textarea1->setAttribute('value', $block->dataValue('html1'));
//            $textarea2->setAttribute('value', $block->dataValue('html2'));
        }

        $data = is_null($block) ? [] : $block->data();
        $values = array_merge($defaults, $data);

        $form = new Form();


        $form->add($textarea1);
//        $form->add($textarea2);


        $form->setData([

            Utility::fieldName('html1') => $values['html1'],
//            Utility::fieldName('html2') => $values['html2'],
        ]);

        return  $view->blockAttachmentsForm($block) . $view->blockThumbnailTypeSelect($block) . $view->formCollection($form);
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
                $img = $view->thumbnail($media, "large", ['title' => $media->displayTitle()]);
            }

            $listings[] = [
                "img" => $img,
            ];

        }



        return $view->partial(
            'common/block-layout/two-col-layout',
            [
                'heading1' => $block->dataValue('heading1'),
                'heading2' => $block->dataValue('heading2'),
                'html1' => $block->dataValue('html1'),
//                'html2' => $block->dataValue('html2'),
                'listings' => $listings

            ]
        );
    }
}

?>