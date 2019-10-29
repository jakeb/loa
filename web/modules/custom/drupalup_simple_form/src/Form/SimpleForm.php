<?php
namespace Drupal\drupalup_simple_form\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


use \Drupal\node\Entity\Node;
use \Drupal\user\Entity\User;
use \Drupal\filter\Entity\FilterFormat;




/**
 * Our simple form class.
 */
class SimpleForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalup_simple_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

   /*
   *  this just here to try things.
   * sample patient node# 26046
   */

     #$node = Node::load(26046);
     $node_storage = \Drupal::entityTypeManager()->getStorage('node');
     $nid = 26046;
     $node = $node_storage->load($nid);
     #$users = User::loadMultiple(array(1, 2, 3));
     #$format = FilterFormat::load(1);

    #

    $form['number_1'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First number'),
    ];
    $form['number_2'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Second numbers'),
    ];

    #echo('just some text here');
    echo('<pre>');
    echo $node->field_first_name->value;
    echo('</pre>');

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Calculate'),
    ];
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($form_state->getValue('number_1') + $form_state->getValue('number_2'));
  }
}
