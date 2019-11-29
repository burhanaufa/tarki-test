<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Alumni\Regions;
use App\Http\Controllers\Controller;
class AlumniController extends Controller
{
    public function index(){
		$data['regions'] = Regions::where('parent', null)
									->get();
        return view('alumni.login', $data);
    }

    public function login(Request $request){
		$this->validate($request, [
            'regions' => 'required',
            'nis' => 'required',
            'password' => 'required',
        ]);
        $cek = $client->request('POST', 'hrbeta.gemilangtechnology.id/api/gis_monitor_login.php', [
            'form_params' => [
                'nik' => $officer->nik,
                'password' => $request->password,
                'officer_id' => $officer->officer_id,
                'officer_level' => $officer->officer_level,
                'project_id' => $officer->project_id
            ]
        ]);
        $body = $request->getBody();
        $json_response = json_decode($body);
    }

}
