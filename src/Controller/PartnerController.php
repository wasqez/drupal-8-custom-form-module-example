<?php

namespace Drupal\partner\Controller;

use Drupal\Core\Controller\ControllerBase;


class PartnerController extends ControllerBase
{

    /**
     * {@inheritdoc}
    */
    public function partnersList()
    {
        $partners = \Drupal::database()->select('partners', 'n')
        ->fields('n', ['first_name', 'company'])
        ->execute()         
        ->fetchAll();      
         
        $partnersAll = [
        '#theme' => 'partners_list',   
        '#partners' => $partners,
        '#title' => $this->t('All partners and co.'),
        ];
                                                                                                                                                    
        return $partnersAll;
        
    }
}