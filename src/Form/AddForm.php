<?php

namespace Drupal\partner\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

class AddForm extends FormBase
{
    /**
     * Returns form id
     *
     * @return string
     */
    public function getFormId()
    {
        return 'partners_add_form';
    }

    /**
     * Build form array
     *
     * @param array $form
     * @param FormStateInterface $formState
     * @return array
     */
    public function buildForm(array $form, FormStateInterface $form_state): array
    {
        // First name
        $form['first_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First Name'),
            '#required' => TRUE,
            '#maxlength' => 255,
            '#default_value' => '',
          ];
          
        // Company
        $form['company'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Company'),
            '#required' => TRUE,
            '#maxlength' => 255,
            '#default_value' => '',
        ];

      // Other input fields...
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = [
          '#type' => 'submit',
          '#button_type' => 'primary',
          '#default_value' => $this->t('Save') ,
        ];
          $form['#theme'] = 'partners_add_form';
          
        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {}

      /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    try{
      $conn = Database::getConnection();
      
      $field = $form_state->getValues();
       
      $fields["first_name"] = $field['first_name'];    
      $fields["company"] = $field['company'];  
        $conn->insert('partners')
           ->fields($fields)->execute();
        \Drupal::messenger()->addMessage($this->t('The Partners First name ad Company has been succesfully saved'));
       
    } catch(Exception $ex){
      \Drupal::logger('partners')->error($ex->getMessage());
    }
      
  }
}