<?php
namespace app\models;
use core\Model;

/**
 * Description of HomeContentModel
 *
 * @author u0067341
 */
class HomeContentModel extends Model 
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function getHtmlForHomePage() 
    {
        $content= '<h2>Oefeningen PHP</h2>'
                . '<p>Dit is mijn oefensite voor het vak PHP'
                . '<p>Deze site zal steeds uitgebreidt worden met nieuwe ofeningen';
    
        return $content;
    }
}
