<?php
namespace App\Helper;

use App\Entity\Rule;

class RuleFactory{
    public function ruleDecoded($query){
        $jsonData = json_decode($query);
        $rule = new Rule();
        $rule->name = $jsonData->name;
        return $rule;
    }
}