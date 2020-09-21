<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SecureController extends Controller
{
	public function profile(Request $request)
	{
        $response = array(
            'status' => 'success',
            'data' => null
        );

        $explode = explode(' ', $request->header('Authorization'));
        $response['data'] = User::where('token', $explode[1])->first();

        return response()->json($response);
	}
}