<?php

namespace Drupal\dgddi_salt\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class DGDDISaltSubscriber.
 *
 * @package Drupal\dgddi_salt
 */
class DGDDISaltSubscriber implements EventSubscriberInterface
{
  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events['kernel.request'] = ['checkDGDDIToken'];

    return $events;
  }

  /**
   * This method is called whenever the kernel.request event is
   * dispatched.
   *
   * We have to:
   *  1. Test if token exists (x-csrf-token or whatever)
   *  2. Decode token to get params
   *  2. Test if params are valids
   *  3. Return Response or 403
   *
   * @param GetResponseEvent $event
   */
  public function checkDGDDIToken(GetResponseEvent $event) {
    drupal_set_message('Event for checkDGDDIToken', 'status', TRUE);
    $token = $event->getRequest()->headers->has('x-csrf-token');
    if ($token) {
      $a = 4;
    }
    else {
      throw new AccessDeniedHttpException();
    }
  }
}
