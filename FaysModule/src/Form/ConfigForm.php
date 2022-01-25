<?php
namespace FaysModule\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class ConfigForm extends Form {
    public function init() {
        $this->add([
            'name' => 'content',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Action bubble content',
                'info' => 'This text will be displayed inside the action bubble.',
            ]
        ]);
    }
}
?>
