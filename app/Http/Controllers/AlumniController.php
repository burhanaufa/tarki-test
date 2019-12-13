<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Alumni\Regions;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Session;
class AlumniController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('nis')){
            return redirect()->route('alumni-dashboard');
        } else {
            $data['regions'] = Regions::where('parent', null)->get();
            return view('alumni.login', $data);
        }
    }

    public function logout(){
        Session::flush();
        return redirect()->route('alumni');
    }

    public function login(Request $request){
        $this->validate($request, [
            'regions' => 'required',
            'nis' => 'required',
            'password' => 'required',
        ]);
        $url = $request->regions.'/api/login.php';
        $client = new Client();
        $cek = $client->request('POST', $url, [
            'form_params' => [
                'nis' => $request->nis,
                'password' => $request->password
            ]
        ]);
        $body = $cek->getBody();
        $json_response = json_decode($body);
        if ($json_response->error == true) {
            return redirect()->route('alumni')->with('error',$json_response->message);
       } else {
            $departemen= $json_response->departement;
            $nis= $request->nis;
            $request->session()->put('departemen',$departemen);
            $request->session()->put('nis',$nis);
            $request->session()->put('url',$request->regions);
            return redirect()->route('alumni-dashboard')->with('success',$json_response->message);
        }
    }

    public function dashboard(Request $request){
        if($request->session()->has('nis')){
            $nis = $request->session()->get('nis');
            $departement = $request->session()->get('departemen');
            $url = $request->session()->get('url');
            $client = new Client();
            $cek = $client->request('POST', $url.'/api/getdata.php', [
                'form_params' => [
                    'departemen' => $departement,
                    'nis' => $nis
                ]
            ]);
            $body = $cek->getBody();
            $json_response = json_decode($body);
            if ($json_response->error == true) {
                echo $json_response->message;
            } else {
                $data['nama']= $json_response->nama;
                $data['alamat']= $json_response->alamat;
                $data['no_telpon']= $json_response->no_telpon;
                $data['hp']= $json_response->hp;
                $data['hobi']= $json_response->hobi;
                $data['tanggal_lahir']= date('d F Y', strtotime($json_response->tanggal_lahir));
                $data['kelas']= $json_response->kelas;
                $data['angkatan']= $json_response->angkatan;
                $data['email']= $json_response->email;
                if($json_response->foto==""){
                    $data['foto']= "";
                } else {
                    $data['foto']= $json_response->foto;
                }
                
                $data['departement']= $departement;
                $request->session()->put('kelas',$data['kelas']);
                $request->session()->put('angkatan',$data['angkatan']);

                return view('alumni.dashboard',$data);
            }
        }else{
			return redirect()->route('alumni')->with('error','Silahkan Login Dahulu!!');
		}
    }

    public function search(Request $request){
        if($request->session()->has('nis')){
            $url = $request->session()->get('url');
            $departement = $request->session()->get('departemen');
            $nis = $request->session()->get('nis');
            $kelas = $request->session()->get('kelas');
            $angkatan = $request->session()->get('angkatan');
            $client = new Client();
            $cek_angkatan = $client->request('POST', $url.'/api/getangkatan.php', [
                'form_params' => [
                    'departemen' => $departement
                ]
            ]);
            $body_angkatan = $cek_angkatan->getBody();
            $data['angkatan_all'] = json_decode($body_angkatan, true);
            if($request->cari==""){
                $cek_search= $client->request('POST', $url.'/api/search_alumni.php', [
                    'form_params' => [
                        'nis' => $nis,
                        'departemen' => $departement
                    ]
                ]);
                $body_search = $cek_search->getBody();
                $data['search'] = json_decode($body_search);
            } elseif($request->cari=="angkatan"){

            } elseif($request->cari=="kelas"){

            }
            $data['departement']= $departement;
            $data['kelas']= $kelas;
            $data['angkatan']= $angkatan;
            return view('alumni.search',$data);

        }else{
			return redirect()->route('alumni')->with('error','Silahkan Login Dahulu!!');
		}
    }

    public function detail(Request $request, $nis_alumni){
        if($request->session()->has('nis')){
            $url = $request->session()->get('url');
            $client = new Client();
            $cek_detail = $client->request('POST', $url.'/api/detail_alumni.php', [
                'form_params' => [
                    'nis' => $nis_alumni
                ]
            ]);
            $body_detail = $cek_detail->getBody();
            $json_response = json_decode($body_detail);
                $data['nama']= $json_response->nama;
                $data['alamat']= $json_response->alamat;
                $data['departement']= $json_response->departemen;
                $data['no_telpon']= $json_response->no_telpon;
                $data['hp']= $json_response->hp;
                $data['hobi']= $json_response->hobi;
                $data['tanggal_lahir']= $json_response->tanggal_lahir;
                $data['kelas']= $json_response->kelas;
                $data['angkatan']= $json_response->angkatan;
                $data['email']= $json_response->email;
                if($json_response->foto==""){
                    $data['foto']= "";
                } else {
                    $data['foto']= $json_response->foto;
                }
                
                return view('alumni.detail',$data);
        }else{
			return redirect()->route('alumni')->with('error','Silahkan Login Dahulu!!');
		}
    }
}