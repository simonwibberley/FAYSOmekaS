<?php

namespace FaysModule;

use Zend\View\Renderer\PhpRenderer;
use Omeka\Module\AbstractModule;
use Zend\Mvc\Controller\AbstractController;

use FaysModule\Form\ConfigForm;


class Module extends AbstractModule {
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getConfigForm(PhpRenderer $renderer) {
        $services = $this->getServiceLocator();
        $form = $services->get('FormElementManager')->get(ConfigForm::class);
        $html = $renderer->formCollection($form);
        return $html;
    }

    public function handleConfigForm(AbstractController $controller) {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');
        $form = new ConfigForm;
        $form->init();
        $form->setData($controller->params()->fromPost());
        if ($form->isValid()) {
            $formData = $form->getData();
            $settings->set('fays_module_action_bubble_text', $formData['content']);
            return true;
        } else {
            $controller->messenger()->addErrors($form->getMessages());
            return false;
        }
    }
}

?>
