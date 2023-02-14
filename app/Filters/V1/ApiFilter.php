<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;

class ApiFilter {
    protected $allowed = [];
    protected $operatorMap = [];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach($this->allowed as $params => $operators) {
            $query = $request->query($params);

            if(! isset($query)) {
                continue;
            }

            $column = $params;

            foreach($operators as $operator) {
                if(isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}

?>
