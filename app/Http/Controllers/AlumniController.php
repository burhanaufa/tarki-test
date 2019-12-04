<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Alumni\Regions;
use GuzzleHttp\Client;
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
        $url = $request->regions.'/api/login.php';
        $cek = $client->request('POST', $url, [
            'form_params' => [
                'nis' => $request->nis,
                'password' => $request->password
            ]
        ]);
        $body = $cek->getBody();
        $json_response = json_decode($body);

        if ($json_response->message == 'NIS kosong') {
            return redirect()->route('alumni')->with('error','NIS Tidak Ditemukan!!');
        } else if ($json_response->message == 'password salah') {
            return redirect()->route('alumni')->with('error','Password Salah!!');
        } else {
            $departemen= $json_response->departement;
            $nis= $request->nis;
            $request->session()->put('departemen',$departemen);
            $request->session()->put('nis',$nis);
            $request->session()->put('url',$url);
            return redirect()->route('alumni/dashboard')->with('success','Login Sukses!!');
        }
    }

    public function dashboard(Request $request){
        if($request->session()->has('nis')){
			$nis = $request->session()->get('nis');
            $departement = $request->session()->get('departement');
            $url = $request->session()->get('url');
            $client = new Client();
            $request = $client->request('GET', $url.'/api/getdata.php/'.$departement);
            $body = $request->getBody()->getContents();
            $client_all = json_decode($body, true);
    
            $i = 0;
    
    
    
            foreach($data_client as  $item){
                foreach($client_all as  $item2){
    
                    if($item['client_code'] == $item2['client_code']){
                        $data_client[$i] = ['id' => $item['id'], 'client_code' => $item['client_code'], 'username' => $item['username'],'password' => $item['password'], 'firebase_token' => $item['firebase_token'] ,'survey_status' => $item['survey_status'],'client_status' => $item['client_status'], 'created_by' => $item['created_by'],'created_at' => $item['created_at'], 'updated_at' => $item['updated_at'],'deleted_at' => $item['deleted_at'], 'project_name' => $item2['client_name'] ];
                        $i++;
                    }
                }
            }
            $data['alumni'] = $data_client;
             return view('alumni.dashboard', $data);
        }else{
			return redirect()->route('alumni')->with('error','Silahkan Login Dahulu!!');
		}
    }

}