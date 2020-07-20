<?php
/**
 * @file
 * Contains \Drupal\node_json_data\Form\NodeJsonApiForm
 */
namespace Drupal\node_json_data\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class NodeJsonApiForm extends ConfigFormbase {
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames(){
      return[
        'node_json_data.adminsettings',
      ];
    }
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'node_json_api_form';
      }

    public function buildForm(array $form, FormStateInterface $form_state){

      $config = $this->config('node_json_data.adminsettings');
        
        $form['api_key'] = array(
            '#title' => t('API Key'),
            '#type' => 'textfield',
            '#maxlength' => 16,
            '#default_value' => $config->get('api_key'),
          );
      
          return parent::buildForm($form, $form_state);
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
      $value = $form_state->getValue('default_value');
      
    }


    public function submitForm(array &$form, FormStateInterface $form_state) {
      $this->config('node_json_data.adminsettings')  
      ->set('api_key', $form_state->getValue('api_key'))  
      ->save();
      drupal_set_message(t('Form is working.'));    
    }
}

