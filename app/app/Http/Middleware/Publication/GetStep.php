<?php

namespace App\Http\Middleware\Publication;

use Illuminate\Support\Facades\Auth;
use App\Enums\Publication\StateEnum;
use App\Models\Publication;
use Illuminate\Support\Facades\Validator;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetStep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            'title' => 'required|string|max:150',
            'price' => 'required|numeric',
            'rent_type_id' => 'required|integer',
            'bathroom_count' => 'integer',
            'number_people' => 'required|integer',
            'ubication' => 'string|max:250',
            'description' => 'string|nullable',
            'pets' => 'in:1,0',
            'files.*' => 'max:2048|file',
            'files' => 'required|array|min:1',
        ];

        $files = count($request->file('files', [])) - 1;
        foreach (range(0, $files) as $index) {
            $rules["files.$index"] = 'required|mimes:png,jpeg,jpg,gif|max:2048';
        }

        $validated = Validator::make(
            $request->all(),
            $rules,
            [
                'files' => 'Selecciona al menos una foto',
                'files.*.min' => 'Selecciona al menos una foto',
                'files.*.required' => 'Selecciona al menos una foto'
            ]
        );

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $publication = Publication::create([
            'state' => StateEnum::Draft->name,
            'user_id' => Auth::user()->id
        ]);

        return $next($request, $publication);
    }
}
