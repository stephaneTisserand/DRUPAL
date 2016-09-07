<?php

namespace Drupal\dgddi_salt\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dgddi_salt\SaltManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class DebugController.
 *
 * @package Drupal\dgddi_salt\Controller
 */
class DebugController extends ControllerBase {

  protected $saltManager;

  /**
   * Class constructor.
   * 
   * @param \Drupal\dgddi_salt\SaltManager $saltManager
   */
  public function __construct(SaltManager $saltManager) {
    $this->saltManager = $saltManager;
  }

  /**
   * {@inheritdoc}
   * 
   * @return SaltManager
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('dgddi.salt.manager'));
  }

  /**
   * Debug.
   *
   * @return string
   *   Return Encoded URL string.
   */
  public function debug() {
    $url =  \Drupal::request()->query->get('url') ?: $this->saltManager->getDefaultURL();

    return [
      '#type' => 'markup',
      '#markup' => 'Model :<br>http://val-bo1-api-rights.douane-gouv.tma/3.1/Teleservice?secAppelant=TEST&secTimestamp=14648800415462969&secSignature=TYM4CT2qgu2h8NJk56KtZUHEKJFpStJjGEDk_ohwedI<br><br>Generated :<br>' . $this->saltManager->encode($url)
    ];
  }

}
