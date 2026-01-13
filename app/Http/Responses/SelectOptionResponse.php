<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class SelectOptionResponse implements Responsable
{
    private $list;

    /**
     * Create new instances for dependencies.
     *
     * @param $list
     */
    public function __construct($list)
    {
        $this->list = $list;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json(
            array(
                'total_count' => 0,
                'incomplete_results' => true,
                'items' => $this->list,
            )
        );
    }
}
