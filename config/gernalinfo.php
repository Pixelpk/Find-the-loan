<?php

use Faker\Guesser\Name;

return [
    
   "15" => [
       [
        "label" => "Tanancy Agreement",
        "key" => "tanancy_agreement",
        "type" => "file",
        "required" => 'required',
       
       
       ],
       [
        "label" => "Renovation Quotation",
        "key" => "renovation_quotation",
        "type" => "file",
        "required" => 'required',
       
       
       ],
       [
        "label" => "User Owned",
        "key" => "user_owned",
        "type" => "checkbox",
        "required" => 'nullable'
       
       ],
       [
        "label" => "Amount",
        "key" => "amount",
        "type" => "number",
        "required" => "required",
       
       ]
   ]

];
