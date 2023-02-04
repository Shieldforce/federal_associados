<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearFields
{
    public function handle(Request $request, Closure $next)
    {

        $defaultSanitizesStrings = [
            'document_number',
            'phone',
            'phone2',
            'cep',
            "number_registration"
        ];

        foreach($defaultSanitizesStrings as $string) {
            if (isset($request[$string])) {
                $request[$string] = sanitizeString($request[$string]);
            }
        }

        return $next($request);
    }
}
