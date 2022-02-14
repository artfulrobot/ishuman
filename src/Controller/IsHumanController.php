<?php
namespace Drupal\ishuman\Controller;

use Drupal\Core\Controller\ControllerBase;

class IsHumanController extends ControllerBase {
  /**
   * API endpoint; returns simple string HTTP response.
   */
  public function ajax() {
    echo ishuman_make_key();
    exit;
  }
}
