<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class UtilsController extends Controller
{
    function getMembersByName()
    {
        $search = request('search', null);

        $data = Member::where('name', 'LIKE', "%$search%")
            ->where('status', request('status') == 'head' ? 'Kepala Keluarga' : 'null')
            ->get()
            ->map(
                function ($member) {
                    return collect(['id' => $member->id, 'text' => $member->name]);
                }
            );

        return response()->json([
            'results' => !$search ? [] : $data,
            'pagination' => [
                'more' => false
            ]
        ]);
    }
}
