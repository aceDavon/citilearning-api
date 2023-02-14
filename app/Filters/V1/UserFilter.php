<?php

namespace App\Filters\V1;

class UserFilter extends ApiFilter {
    protected $allowed = [
        'name' => ['eq'],
        'username' => ['eq'],
        'email' => ['eq'],
        'type' => ['eq']
    ];

    protected $operatorMap = [
        'eq' => '=',
    ];
}
