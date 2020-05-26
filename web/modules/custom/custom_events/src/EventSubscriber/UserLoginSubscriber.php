<?php

namespace Drupal\custom_events\EventSubscriber;

use Drupal\custom_events\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UserLoginSubscriber.
 *
 * @package Drupal\custom_events\EventSubscriber
 */
class UserLoginSubscriber implements EventSubscriberInterface {

  /**
   * Database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      // Static class constant => method on this class.
      UserLoginEvent::EVENT_NAME => 'onUserLogin',
    ];
  }

  /**
   * React to the user login event dispatched.
   *
   * @param \Drupal\custom_events\Event\UserLoginEvent $event
   *   Dat event object yo.
   */
  public function onUserLogin(UserLoginEvent $event) {
    $database = \Drupal::database();
    $dateFormatter = \Drupal::service('date.formatter');

    $account_created = $database->select('users_field_data', 'ud')
      ->fields('ud', ['created'])
      ->condition('ud.uid', $event->account->id())
      ->execute()
      ->fetchField();

    $uid = $event->account->id(); // \Drupal::currentUser()->id();
    $user = \Drupal\user\Entity\User::load($uid);
    $dept = $user->field_department->value;
    $username = $user->getDisplayname();


    //$account_created =  $user->field_created->value;

    drupal_set_message(t('Welcome, %user from %dept! Your account was created on %created_date.' , [
      '%created_date' => $dateFormatter->format($account_created, 'short'),
      '%user' => $username,
      '%dept' => $dept,

    ]));
  #  $destination = \Drupal::request()->query->get('destination');
    if (!isset($destination)) {
      #dpm('redirecting');
      $response = new \Symfony\Component\HttpFoundation\RedirectResponse('/home');
      $response->send();
    } else {
      #dpm('not redirecting.');
    }


  }

}
