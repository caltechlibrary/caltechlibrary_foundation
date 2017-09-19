<?php

/**
 * Implements hook_form_alter()
 */
function caltechlibrary_foundation_form_alter(&$form, &$form_state, $form_id) {
  // Remove classes from Submit buttons set by ZURB Foundation base theme.
  if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
    $classes = (is_array($form['actions']['submit']['#attributes']['class']))
      ? $form['actions']['submit']['#attributes']['class']
      : array();
    $classes = array_diff($classes, array('secondary', 'button', 'radius'));
    $form['actions']['submit']['#attributes']['class'] = $classes;
  }
  // Add `secondary` and `button` classes to Preview buttons.
  if (!empty($form['actions']) && !empty($form['actions']['preview'])) {
    $attributes = (isset($form['actions']['preview']['#attributes']))
      ? $form['actions']['preview']['#attributes']
      : array();
    $classes = (isset($attributes['class']))
      ? $attributes['class']
      : array();
    $classes = array_merge($classes, array('secondary', 'button'));
    $form['actions']['preview']['#attributes']['class'] = $classes;
  }
}

/**
 * Prepares username variable.
 *
 * We need to override the truncation of usernames to 15 characters that occurs
 * in Drupal Core.
 *
 * @see https://api.drupal.org/api/drupal/includes!theme.inc/function/template_preprocess_username/7.x
 */
function caltechlibrary_foundation_preprocess_username(&$variables) {
  $variables['name'] = format_username($variables['account']);
}
