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

class HomeLayout extends AbstractBlockLayout {
    private $text;
    private $logger;
    protected $htmlPurifier;


    public function __construct($text, LoggerInterface $logger, $htmlPurifier) {
        $this->text = $text;
        $this->logger = $logger;
        $this->htmlPurifier = $htmlPurifier;
    }

    public function getLabel() {
        return "FAYS Home Layout";
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
            'heading1' => '',
            'heading2' => '',
            'link1' => '',
            'link1Text' => '',
            'link2' => '',
            'link2Text' => '',
            'link3' => '',
            'link3Text' => '',
            'link4' => '',
            'link4Text' => '',
            'html' => ''
        ];

        $textarea = new Textarea(Utility::fieldName('html'));
        $textarea->setAttribute('class', 'block-html full wysiwyg');
        if ($block) {
            $textarea->setAttribute('value', $block->dataValue('html'));
        }

        $data = is_null($block) ? [] : $block->data();
        $values = array_merge($defaults, $data);

        $form = new Form();

        $form->add([
            'name' => Utility::fieldName('heading1'),
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Welcome 1 content',
                'info' => 'This text will be displayed first.',
            ]
        ]);

        $form->add([
            'name' => Utility::fieldName('heading2'),
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Welcome 2 content',
                'info' => 'This text will be displayed second.',
            ]
        ]);


        $form->add([
            'name' => Utility::fieldName('link1'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link 1', 'info' => 'Link 1 url.']
        ]);
        $form->add([
            'name' => Utility::fieldName('link1Text'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link 1 Text', 'info' => 'Link 1 text.']
        ]);


        $form->add([
            'name' => Utility::fieldName('link2'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link 2', 'info' => 'Link 2 url.']
        ]);
        $form->add([
            'name' => Utility::fieldName('link2Text'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link 2 Text', 'info' => 'Link 2 text.']
        ]);


        $form->add([
            'name' => Utility::fieldName('link3'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link 3', 'info' => 'Link 3 url.']
        ]);
        $form->add([
            'name' => Utility::fieldName('link3Text'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link 3 Text', 'info' => 'Link 3 text.']
        ]);


        $form->add([
            'name' => Utility::fieldName('link4'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link 4', 'info' => 'Link 4 url.']
        ]);
        $form->add([
            'name' => Utility::fieldName('link4Text'),
            'type' => Element\Text::class,
            'options' => [ 'label' => 'Link 4 Text', 'info' => 'Link 4 text.']
        ]);



        $form->add($textarea);

        $form->setData([
            Utility::fieldName('heading1') => $values['heading1'],
            Utility::fieldName('heading2') => $values['heading2'],

            Utility::fieldName('link1') => $values['link1'],
            Utility::fieldName('link1Text') => $values['link1Text'],

            Utility::fieldName('link2') => $values['link2'],
            Utility::fieldName('link2Text') => $values['link2Text'],

            Utility::fieldName('link3') => $values['link3'],
            Utility::fieldName('link3Text') => $values['link3Text'],

            Utility::fieldName('link4') => $values['link4'],
            Utility::fieldName('link4Text') => $values['link4Text'],

            Utility::fieldName('html') => $values['html'],
        ]);
        return $view->formCollection($form);
    }

	public function render(
        PhpRenderer $view, SitePageBlockRepresentation $block
    ) {
        //        throw new \Exception('no ' + get_class($view->getServiceLocator()));

//        $c1 = $block->dataValue('content1');
//        $this->logger->debug("inside action bubble render", [$c1]);

        return $view->partial(
            'common/block-layout/home-layout',
            [
                'heading1' => $block->dataValue('heading1'),
                'heading2' => $block->dataValue('heading2'),

                'link1' => $block->dataValue('link1'),
                'link1Text' => $block->dataValue('link1Text'),

                'link2' => $block->dataValue('link2'),
                'link2Text' => $block->dataValue('link2Text'),

                'link3' => $block->dataValue('link3'),
                'link3Text' => $block->dataValue('link3Text'),

                'link4' => $block->dataValue('link4'),
                'link4Text' => $block->dataValue('link4Text'),

                'html' => $block->dataValue('html'),

                'home' => true
            ]
        );
    }
}

?>