<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // RESPONSE DATA
        $response = array(
            "status" => "success",
            "data" => null
        );

        try {
            // GET ALL USER DATA
            $users = User::all();

            // CHECK REQUEST
            if($request->has('with'))
            {
                $parameter = $request->input('with');
                $arrayParameter = explode(',', $parameter);
                
                try {
                    $users = User::with($arrayParameter)->get();
                } catch (\Throwable $th) {
                    $response = array(
                        "status" => "error",
                        "message" => "parameter pencarian tidak ditemukan"
                    );
                    return response()->json($response);
                }                
            }

            $response['data'] = $users;
            return response()->json($response);

        } catch (\Throwable $th) {
            
            $response['status'] = "error";
            $response['message'] = "Gagal mendapatkan users";
            return response()->json($response);

        }
    }

    public function view(Request $request, string $user)
    {
        // RESPONSE DATA
        $response = array(
            "status" => "success",
            "data" => null
        );

        try {

            $user = User::find($user)->first();
            $response['data'] = $user;
            return response()->json($response);

        } catch (\Throwable $th) {
            
            $response['status'] = "error";
            $response['message'] = "Gagal mendapatkan user yang dicari";
            return response()->json($response);

        }
        
    }
}
