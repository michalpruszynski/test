<?php

namespace Drupal\custom_events\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase {

    public function getFormId()
    {
        return 'custom_events_config_form';
    }

    protected function getEditableConfigNames()
    {
        return [
            'custom_events.settings'
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('custom_events.settings');

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => 'Event name',
            '#default_value' => $config->get('event_name'),
            '#required' => TRUE,
        ];

        $form['short_text'] = [
            '#type' => 'textfield',
            '#title' => 'Short introduction',
            '#default_value' => $config->get('short_text'),
        ];
        
        $form['description'] = [
            '#type' => 'textarea',
            '#type' => 'text_format',
            '#title' => 'Description',
            '#default_value' => $config->get('description'),
            '#default_value' => $config->get('description')['value'],
            '#required' => TRUE,
        ];
        
        $form['address'] = [
            '#type' => 'textfield',
            '#title' => 'Address',
            '#default_value' => $config->get('address'),
        ];
        
        $form['geolocation'] = [
            '#type' => 'textfield',
            '#title' => 'Geolocation',
            '#default_value' => $config->get('geolocation'),
        ];
        
        $form['date'] = [
            '#type' => 'date',
            '#title' => 'Date',
            '#default_value' => $config->get('date'),
        ];

        $form['contact'] = [
            '#type' => 'textfield',
            '#title' => 'Contact',
            '#default_value' => $config->get('contact'),
        ];
        
        $form['thumbnail_image'] = [
            '#type' => 'textfield',
            '#title' => 'Thumbnail Image',
            '#default_value' => $config->get('thumbnail_image'),
        ];

        $form['gallery'] = [
            '#type' => 'textfield',
            '#title' => 'Gallery',
            '#default_value' => $config->get('gallery'),
        ];
        
        $form['video'] = [
            '#type' => 'textfield',
            '#title' => 'Video link',
            '#default_value' => $config->get('video'),
        ];

        $form['application_form'] = [
            '#type' => 'textfield',
            '#title' => 'PDF Form',
            '#default_value' => $config->get('application_form'),
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Submit form',
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = $this->config('custom_events.settings');
                 
        $config->set('name', $form_state->getValue('name'));
        $config->set('short_text', $form_state->getValue('short_text'));
        $config->set('description', $form_state->getValue('description'));
        $config->set('address', $form_state->getValue('address'));
        $config->set('geolocation', $form_state->getValue('geolocation'));
        $config->set('date', $form_state->getValue('date'));
        $config->set('contact', $form_state->getValue('contact'));
        $config->set('thumbnail_image', $form_state->getValue('thumbnail_image'));
        $config->set('gallery', $form_state->getValue('gallery'));
        $config->set('video', $form_state->getValue('video'));
        $config->set('application_form', $form_state->getValue('application_form'));

        $config->save();


        return parent::submitForm($form, $form_state);
    }
}