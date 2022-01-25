<?php
namespace FaysModule\Service\BlockLayout;

use Omeka\Stdlib\HtmlPurifier;
use FaysModule\Site\BlockLayout\TwoColLayout;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;


class TwoColLayoutFactory implements FactoryInterface {
    public function __invoke(
        ContainerInterface $services, $requestedName, array $options = null
    ) {
        $settings = $services->get('Omeka\Settings');
        $text = $settings->get('fays_module_action_bubble_text');
        $htmlPurifier = $services->get('Omeka\HtmlPurifier');

        return new TwoColLayout($text, $services->get('Omeka\Logger'), $htmlPurifier);
    }
}

