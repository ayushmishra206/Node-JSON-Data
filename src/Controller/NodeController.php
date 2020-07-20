<?php
/**
 * @file
 * Contains \Drupal\node_json_data\Controller\NodeController.
 */
namespace Drupal\node_json_data\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller for export json.
 */
class NodeController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
   
  public function data($api_key, $node_id) {
    $config = \Drupal::config('node_json_data.adminsettings');
    if ($api_key==$config->get('api_key')) {
      $json_array = array(
        'data' => array()
      );
    $nid = $node_id;     // example value
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $node = $node_storage->load($nid);
      
        $json_array['data'][] = array(
          'type' => $node->get('type')->target_id,
          'id' => $node->get('nid')->value,
          'attributes' => array(
            'title' =>  $node->get('title')->value,
            'content' => $node->get('body')->value,
          ),
        );
      
      return new JsonResponse($json_array);
    }
    else 
      return 'Wrong API KEY or INVALID NODE ID';    
  }
}