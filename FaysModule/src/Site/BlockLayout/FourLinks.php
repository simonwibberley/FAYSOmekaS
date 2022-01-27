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

class FourLinks extends AbstractBlockLayout {


    public function getLabel() {
        return "FAYS Four Links";
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {

        $defaults = [
            'link1' => '/s/fays/browse',
            'link1Text' => 'Browse the collections >>',
            'link2' => '/s/fays/search',
            'link2Text' => 'Search the archive >>',
            'link3' => '/s/fays/page/exhibits',
            'link3Text' => 'Explore our exhibitions >>',
            'link4' => '/s/fays/page/about',
            'link4Text' => 'Read more about us >>',
        ];

        $data = is_null($block) ? [] : $block->data();
        $values = array_merge($defaults, $data);

        $form = new Form();


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

        $form->setData([
            Utility::fieldName('link1') => $values['link1'],
            Utility::fieldName('link1Text') => $values['link1Text'],

            Utility::fieldName('link2') => $values['link2'],
            Utility::fieldName('link2Text') => $values['link2Text'],

            Utility::fieldName('link3') => $values['link3'],
            Utility::fieldName('link3Text') => $values['link3Text'],

            Utility::fieldName('link4') => $values['link4'],
            Utility::fieldName('link4Text') => $values['link4Text'],

        ]);

        return $view->formCollection($form);
    }

	public function render(
        PhpRenderer $view, SitePageBlockRepresentation $block
    ) {



        return $view->partial(
            'common/block-layout/four-links',
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

            ]
        );
    }
}

?>