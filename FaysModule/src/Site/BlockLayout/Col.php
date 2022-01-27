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

class Col extends AbstractBlockLayout {


    public function getLabel() {
        return "FAYS Col";
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {

        $defaults = [
            'col' => '12'
        ];

        $data = is_null($block) ? [] : $block->data();
        $values = array_merge($defaults, $data);

        $form = new Form();


        $form->add([
            'name' => Utility::fieldName('col'),
            'type' => Element\Number::class,
            'options' => [ 'label' => 'Col width']
        ]);


        $form->setData([
            Utility::fieldName('col') => $values['col'],
        ]);

        return $view->formCollection($form);
    }

	public function render(
        PhpRenderer $view, SitePageBlockRepresentation $block
    ) {
        return $view->partial(
            'common/block-layout/col',
            [
                'col' => $block->dataValue('col'),
            ]
        );
    }
}

?>