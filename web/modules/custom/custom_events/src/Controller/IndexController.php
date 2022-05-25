<?php

namespace Drupal\custom_events\Controller;

use Drupal\Core\Controller\ControllerBase;

class IndexController extends ControllerBase {

    public function showContent() {
        return [
            '#type' => 'markup',
            '#markup' => \Drupal::config('custom_events.settings')->get('description')['value'],
        ];
    }
}
