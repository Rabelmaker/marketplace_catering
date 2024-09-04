<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use function Laravel\Prompts\table;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::guard('admin')->check()) {
            $adminId = Auth::guard('admin')->id();
            $sekolah = DB::table('sekolah_tb')
                ->where('id_admin', $adminId)
                ->first();
            $kelas = DB::table('kelas_tb')
                ->where('id_sekolah', '=', $sekolah->id)
                ->get();

            return view('ui.dashboard.index',
                ['dataSekolah' => $sekolah],
                ['dataKelas' => $kelas],
            );

        } else {
            return view('auth.login');
        }
    }

    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect(route('dashboard'));
        } else {
            return view('auth.login');
        }

    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        return redirect(route('login'));
    }

    public function gantipassword($id)
    {
        $data = DB::table('admin_tb')->where('id', $id)->first();
        return view('auth.gantipassword', ['data' => $data]);
    }

    public function post_gantipassword(Request $request)
    {
        // Ambil data admin berdasarkan ID
        $admin = DB::table('admin_tb')->where('id', $request->id)->first();

        // Ambil input dari request
        $passlama = $request->password_lama;
        $passbaru = $request->password_baru;
        $ulangpass = $request->ulang_password;


        // Cek apakah password lama yang dimasukkan cocok dengan password di database
        if ($this->md5Pass($passlama) === $admin->password) {
            // Cek apakah password baru cocok dengan konfirmasi password
            if ($passbaru === $ulangpass) {
                // Update password di database
                DB::table('admin_tb')->where('id', $request->id)->update([
                    'password' => $this->md5Pass($passbaru),
                ]);

                return redirect(route('dashboard'))->with('sukses', 'Password telah diperbarui');
            } else {
                return back()->with('gagal', 'Password baru dan ulang password tidak cocok.');
            }
        } else {
            return back()->with('gagal', 'Password lama tidak sesuai.');
        }
    }

    public function post_login(Request $request)
    {
        $admin = DB::table('admin_tb')
            ->where('username', $request->username)
            ->where('password', $this->md5Pass($request->password))
            ->get();

        if (count($admin) > 0) {
            Auth::guard('admin')->loginUsingId($admin[0]->id);

            // Flash message untuk sukses login
            return redirect(route('dashboard'))->with('sukses', "Login berhasil!");
        } else {
            // Flash message untuk gagal login
            return redirect(route('login'))->with('gagal', "Username / Password salah");
        }
    }



    //-----------------------------------------------------------------------------------------------
    public function register()
    {
        return view('auth.register');
    }

    public function post_register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admin_tb,username',
            'password' => 'required',
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'telepon' => 'required|numeric',
            'email' => 'required|email',
            'logo' => 'nullable|image'
        ]);

        $dataAdmin = [
            'username' => $request->username,
            'password' => $this->md5Pass($request->password),
            'remember_token' => $this->md5Pass($request->password)
        ];
        $idadmin = DB::table('admin_tb')->insertGetId($dataAdmin);

        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        $file = $request->file('logo');
        $tujuan = "img/logo";
        $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $file->move($tujuan, $nama);

        $dataSekolah = [
            'id_admin' => $idadmin,
            'nama' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'tlp' => $request->telepon,
            'email' => $request->email,
            'logo' => "$tujuan/$nama"
        ];

        DB::table('sekolah_tb')->insertGetId($dataSekolah);

        return redirect(route('login'))->with('sukses', 'Akun Berhasil dibuat');
    }

    //-----------------------------------------------------------------------------------------------
    public function user()
    {

        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = DB::table('user_tb')
            ->where('id_sekolah', $id_sekolah)
            ->get();

        $device = DB::table('device_tb')
            ->where('id_sekolah', $id_sekolah)
            ->get();

        return view('ui.user.index', [
            'datas' => $data,
            'can_sync' => count($device) > 0 ? $device[0]->can_sync : 0
        ]);

//        try {
//            $apiResponseData = $this->getExternalApiDataUser();
//            $apiList = isset($apiResponseData['info']['List']) ? $apiResponseData['info']['List'] : [];
//
//            return view('ui.user.index', [
//                'datas' => $data,
//                'apiList' => $apiList,
//                'can_sync' => count($device) > 0 ? $device[0]->can_sync : 0
//            ]);
//        } catch (\Exception $e) {
//            // Jika API gagal mendapatkan data, kembalikan view dengan pesan kesalahan
//            return view('ui.user.unrespond')->with('error', 'Gagal, alat belum connect');
//        }
    }

    public function add_user()
    {
        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = DB::table('kelas_tb')
            ->where('id_sekolah', '=', $id_sekolah)
            ->get();
        return view('ui.user.add', ['datas' => $data]);
    }

    public function edit_user($id)
    {
        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $dataKelas = DB::table('kelas_tb')
            ->where('id_sekolah', '=', $id_sekolah)
            ->get();

        $data = DB::table('user_tb')->where('id', $id)->first();
        return view('ui.user.edit', ['data' => $data, 'datakelas' => $dataKelas]);
    }

    public function post_user(Request $request)
    {
        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = [
            'role' => $request->role,
            'id_sekolah' => $id_sekolah,
            'Name' => $request->Name,
            'Gender' => $request->Gender,
            'Birthday' => $request->Birthday,
            'Telnum' => $request->Telnum,
            'Native' => $request->Native,
            'Address' => $request->Address,
            'Notes' => $request->Notes,
            'id_kelas' => $request->kelas,
            'no_induk' => $request->no_induk,
        ];

        if ($request->has('cropped_image')) {
            $croppedImage = $request->input('cropped_image');
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage));
            $imageName = 'img/photo/' . time() . '.png';
            file_put_contents($imageName, $imageData);


//            // Menambahkan path gambar ke data yang akan disimpan
            $data['picinfo'] = $croppedImage;
//
//            // Encode gambar untuk dikirim ke API eksternal
//            $base64img = $croppedImage;
        }

        if ($request->mode === 'add') {
            DB::table('user_tb')->insertGetId($data);
//            $this->sendExternalApiDataUser($data, $base64img ?? null);
        } else {
            $id = $request->id;
            DB::table('user_tb')->where('id', $id)->update($data);
//            $this->editExternalApiDataUser($data, $base64img ?? null);
        }

        return redirect(route('user'))->with('sukses', 'User telah diperbarui');
    }

    public function delete_user($id)
    {
        DB::table('user_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('user'))->with('sukses', 'User telah dihapus');
    }

    public function sinkron_user()
    {
        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');
        $devices = DB::table('device_tb')->where('id_sekolah', $id_sekolah)->get();
        $data = DB::table('user_tb')->get();

        foreach ($devices as $device) {
            // Inisialisasi array requestData
            $requestData = [
                'operator' => 'AddPersons',
                'DeviceID' => $device->DeviceID,
                'Total' => $data->count(), // Jumlah total data
            ];

            foreach ($data as $index => $user) {
                $requestData['Personinfo_' . $index] = [
                    'PersonType' => 0,
                    'Name' => $user->Name,
                    'Gender' => $user->Gender,
                    'Nation' => 1,
                    'Birthday' => $user->Birthday,
                    'Telnum' => $user->Telnum,
                    'Native' => $user->Native,
                    'Address' => $user->Address,
                    'Notes' => $user->Notes,
                    'CustomizeID' => $user->id,
                    'isCheckSimilarity' => 0,
                    'picinfo' => $user->picinfo,
                ];
            }
            $requestDataJson = json_encode($requestData, JSON_UNESCAPED_SLASHES);


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://' . $device->ip_device . '/action/AddPersons');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestDataJson); // Use JSON encoded data

            $headers = [
                'Content-Type: application/json',
                'Accept: application/json',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Set basic authentication
            curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');

            $response = curl_exec($ch);

            curl_close($ch);


            $responseArray = json_decode($response, true);
            $responseCode = $responseArray['code'] ?? null;

//            if ($responseCode !== 200) {
//                return redirect(route('user'))->with('gagal', 'Duplikat user, reset data pada alat terlebih dahulu');
//            }
            DB::table('device_tb')
                ->where('id', $device->id)
                ->update([
                    'can_sync' => 0,
                ]);
        }

        \Log::info('Response from external API: ' . $response); // Log API response

        return redirect(route('user'))->with('sukses', 'User telah disinkronkan');
    }

    public function reset_user()
    {
        $requestData = [
            'operator' => 'DeleteAllPerson',
            'info' => [
                'DeleteAllPersonCheck' => 1
            ]
        ];
        $requestDataJson = json_encode($requestData, JSON_UNESCAPED_SLASHES);

        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');
        $devices = DB::table('device_tb')->where('id_sekolah', $id_sekolah)->get();

        foreach ($devices as $device) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://' . $device->ip_device . '/action/DeleteAllPerson');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestDataJson); // Use JSON encoded data

            $headers = [
                'Content-Type: application/json',
                'Accept: application/json',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Set basic authentication
            curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpCode !== 200) {
                \Log::error('Failed to send delete request to external API');
                \Log::error('Request Data: ' . $requestDataJson); // Log request data
                \Log::error('Response Status Code: ' . $httpCode);
                \Log::error('Response Body: ' . $response); // Log response body (if any)
                throw new \Exception('Failed to send delete request to external API');
            }

            \Log::info('Response from external API: ' . $response); // Log API response
            DB::table('device_tb')
                ->where('id', $device->id)
                ->update([
                    'can_sync' => 1,
                ]);
        }
        sleep(35);


        return redirect(route('user'));
    }

    protected function sendExternalApiDataUser($data, $picinfoPath)
    {
        $sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->first();
        $sekolahId = $sekolah->id;

        $devices = DB::table('device_tb')->where('id_sekolah', $sekolahId)->get();

        $imageData = base64_encode(file_get_contents($picinfoPath));

        $commonRequestData = [
            'operator' => 'AddPerson',
            'info' => [
                'PersonType' => 0,
                'Name' => $data['Name'],
                'Gender' => $data['Gender'],
                'Nation' => 1,
                'Birthday' => $data['Birthday'],
                'Telnum' => $data['Telnum'],
                'Native' => $data['Native'],
                'Address' => $data['Address'],
                'Notes' => $data['Notes'],
                'CustomizeID' => $data['id'],
                'isCheckSimilarity' => 0
            ],
            'picinfo' => "data:image/jpeg;base64,$imageData",
        ];

        foreach ($devices as $device) {
            // Tambahkan DeviceID ke data request
            $requestData = $commonRequestData;
            $requestData['info']['DeviceID'] = $device->DeviceID;

            // Encode request data ke JSON dengan JSON_UNESCAPED_SLASHES
            $requestDataJson = json_encode($requestData, JSON_UNESCAPED_SLASHES);

            // Inisialisasi cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.10/action/AddPerson');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestDataJson); // Gunakan data JSON encoded

            // Set header request
            $headers = [
                'Content-Type: application/json',
                'Accept: application/json',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Set basic authentication
            curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');

            // Eksekusi cURL dan dapatkan respon
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Tutup cURL
            curl_close($ch);

            // Tangani respon berdasarkan kode status HTTP
            if ($httpCode !== 200) {
                \Log::error('Failed to send data to external API for DeviceID: ' . $device->DeviceID);
                \Log::error('Request Data: ' . $requestDataJson); // Log data request
                \Log::error('Response Status Code: ' . $httpCode);
                \Log::error('Response Body: ' . $response); // Log body respon (jika ada)
                throw new \Exception('Failed to send data to external API for DeviceID: ' . $device->DeviceID);
            }

            \Log::info('Response from external API for DeviceID ' . $device->DeviceID . ': ' . $response);
        }

        return true;
    }

    protected function editExternalApiDataUser($data, $picinfoPath)
    {
        $imageData = base64_encode(file_get_contents($picinfoPath));

        $requestData = [
            'operator' => 'EditPerson',
            'info' => [
                'DeviceID' => 2416785,
                'PersonType' => 0,
                'IdType' => 0,
                'Name' => $data['Name'],
                'Gender' => $data['Gender'],
                'Nation' => 1,
                'Birthday' => $data['Birthday'],
                'Telnum' => $data['Telnum'],
                'Native' => $data['Native'],
                'Address' => $data['Address'],
                'Notes' => $data['Notes'],
                'CustomizeID' => $data['id'],
                'isCheckSimilarity' => 0
            ],
            'picinfo' => "data:image/jpeg;base64,$imageData",
        ];

        // Encode request data to JSON with JSON_UNESCAPED_SLASHES
        $requestDataJson = json_encode($requestData, JSON_UNESCAPED_SLASHES);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.10/action/EditPerson');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestDataJson); // Use JSON encoded data

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Set basic authentication
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode !== 200) {
            \Log::error('Failed to send data to external API');
            \Log::error('Request Data: ' . $requestDataJson); // Log request data
            \Log::error('Response Status Code: ' . $httpCode);
            \Log::error('Response Body: ' . $response); // Log response body (if any)
            throw new \Exception('Failed to send data to external API');
        }

        \Log::info('Response from external API: ' . $response); // Log API response

        return $response;
    }

    protected function getExternalApiDataUser()
    {
        $requestData = [
            'operator' => 'SearchPersonList',
            'info' => [
                'DeviceID' => 2416785,
                'PersonType' => 0,
                'BeginTime' => '2018-06-01T00:00:00',
                'EndTime' => '2090-06-19T23:59:59',
                'Gender' => 2,
                'Age' => '0-100',
                'MjCardNo' => 0,
                'Name' => '',
                'BeginNO' => 0,
                'RequestCount' => 9999,
                'Picture' => 1
            ]
        ];

        $requestDataJson = json_encode($requestData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.10/action/SearchPersonList');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestDataJson);

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Set basic authentication
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode !== 200) {
            \Log::error('Failed to retrieve data from external API');
            \Log::error('Request Data: ' . $requestDataJson); // Log data permintaan
            \Log::error('Response Status Code: ' . $httpCode);
            \Log::error('Response Body: ' . $response); // Log respons API (jika ada)
            throw new \Exception('Failed to retrieve data from external API');
        }

        \Log::info('Response from external API: ' . $response); // Log respons API

        return json_decode($response, true); // Mengembalikan respons dalam bentuk array asosiatif
    }

    protected function cariUser($nama, $customizeID)
    {
        $requestData = [
            "operator" => "SearchPersonList",
            "info" => [
                "Name" => $nama,
                "DeviceID" => 2416785,
                "Picture" => 1,
                "CustomizeID" => $customizeID
            ]
        ];

        $requestDataJson = json_encode($requestData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.10/action/SearchPersonList');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestDataJson);

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Set basic authentication
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');

        $response = curl_exec($ch);

        curl_close($ch);

        $hasil = json_decode($response, true);
        $arrs = $hasil['info']['List'];
        $h = $arrs[0];
        foreach ($arrs as $arr) {

            if (['CustomizeID'] === $customizeID) {
                $h = $arr;
                break;
            }
        }
        return $h;

    }

    protected function deleteExternalApiDataUser($customizeId)
    {
        $requestData = [
            'operator' => 'DeletePerson',
            'info' => [
                'DeviceID' => 2416785,
                'TotalNum' => 1,
                'IdType' => 0,
                'CustomizeID' => [$customizeId],
            ]
        ];

        $requestDataJson = json_encode($requestData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.10/action/DeletePerson');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestDataJson);

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Set basic authentication
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:admin');

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode !== 200) {
            \Log::error('Failed to delete data from external API');
            \Log::error('Request Data: ' . $requestDataJson); // Log data permintaan
            \Log::error('Response Status Code: ' . $httpCode);
            \Log::error('Response Body: ' . $response); // Log respons API (jika ada)
            throw new \Exception('Failed to delete data from external API');
        }

        \Log::info('Response from external API: ' . $response); // Log respons API

        return json_decode($response, true); // Mengembalikan respons dalam bentuk array asosiatif
    }

    //-----------------------------------------------------------------------------------------------
    public function role()
    {

        $data = DB::table('role_tb')
            ->get();
        return view('ui.role.index', ['datas' => $data]);
    }

    public function add_role()
    {
        return view('ui.role.add');
    }

    public function edit_role($id)
    {
        $data = DB::table('role_tb')->where('id', $id)->first();
        return view('ui.role.edit', ['data' => $data]);
    }

    public function post_role(Request $request)
    {

        $data = [
            'role' => $request->role,
        ];

        if ($request->mode === 'add') {
            $id = DB::table('role_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('role_tb')->where('id', $id)->update($data);
        }

        if ($request->has('picinfo')) {

            request()->validate([
                'picinfo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('picinfo');
            $tujuan = "img/photo";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('role_tb')
                ->where('id', $id)
                ->update(['picinfo' => "$tujuan/$nama"]);
        }

        return redirect(route('role'))->with('sukses', 'Role telah di perbarui');
    }

    public function delete_role($id)
    {
        DB::table('role_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('role'))->with('sukses', 'Role telah di hapus');
    }

    //-----------------------------------------------------------------------------------------------
    public function setabsen()
    {

        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = DB::table('setabsen_tb')
            ->where('id_sekolah', $id_sekolah)
            ->get();
        return view('ui.setabsen.index', ['datas' => $data]);
    }

    public function add_setabsen()
    {
        return view('ui.setabsen.add');
    }

    public function edit_setabsen($id)
    {
        $data = DB::table('setabsen_tb')->where('id', $id)->first();
        return view('ui.setabsen.edit', ['data' => $data]);
    }

    public function post_setabsen(Request $request)
    {

        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = [
            'id_sekolah' => $id_sekolah,
            'hari' => $request->hari,
            'masuk_awal' => $request->masuk_awal,
            'masuk_akhir' => $request->masuk_akhir,
            'terlambat' => $request->terlambat,
            'pulang' => $request->absen_pulang,
        ];

        if ($request->mode === 'add') {
            $id = DB::table('setabsen_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('setabsen_tb')->where('id', $id)->update($data);
        }

        if ($request->has('picinfo')) {

            request()->validate([
                'picinfo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('picinfo');
            $tujuan = "img/photo";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('setabsen_tb')
                ->where('id', $id)
                ->update(['picinfo' => "$tujuan/$nama"]);
        }

        return redirect(route('setabsen'))->with('sukses', 'Setting Absen telah di perbarui');
    }

    public function delete_setabsen($id)
    {
        DB::table('setabsen_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('setabsen'))->with('sukses', 'Setting Absen telah di hapus');
    }

    //-----------------------------------------------------------------------------------------------
    public function receiveData(Request $request)
    {
        // Validasi input
        $request->validate([
            'PersonID' => 'required|integer',
            'Similarity1' => 'required|numeric',
            'Similarity2' => 'required|numeric',
            'CustomizeID' => 'required|integer',
            'DeviceID' => 'required|integer',
        ]);

        $data = [
            'PersonID' => $request->PersonID,
            'Similarity1' => $request->Similarity1,
            'Similarity2' => $request->Similarity2,
            'CustomizeID' => $request->CustomizeID,
            'DeviceID' => $request->DeviceID,
        ];

        $englishDay = Carbon::now()->format('l');

        $daysTranslation = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $hari = $daysTranslation[$englishDay];

        $set = DB::table("setabsen_tb")->where('hari', $hari)->first();

        if (!$set) {
            return response()->json(['message' => 'Setting absen belum ditentukan untuk hari ini'], 404);
        }

        $tnow = Carbon::now();
        $masukAwal = Carbon::createFromTimeString($set->masuk_awal);
        $masukAkhir = Carbon::createFromTimeString($set->masuk_akhir);
        $pulang = Carbon::createFromTimeString($set->pulang);
        $toleransi = $set->terlambat;

        // Cek apakah pengguna sudah absen masuk atau pulang hari ini
        $existingAbsens = DB::table('absen_tb')
            ->where('CustomizeID', $request->CustomizeID)
            ->whereDate('created_at', $tnow->toDateString())
            ->get();

        // Memastikan absen hanya dapat dilakukan sekali saat masuk/terlambat/alpha dan sekali saat pulang
        if ($existingAbsens->count() >= 2) {
            return response()->json(['message' => 'User sudah absen masuk dan pulang hari ini']);
        }

        $alreadyCheckedIn = $existingAbsens->contains(function ($absen) {
            return in_array($absen->absen, ['Tepat Waktu', 'Terlambat', 'Alpha']);
        });

        $alreadyCheckedOut = $existingAbsens->contains(function ($absen) {
            return $absen->absen === 'Pulang';
        });

        // Rentang waktu masuk
        if (!$alreadyCheckedIn) {
            if ($tnow->between($masukAwal, $masukAkhir)) {
                $absen = "Tepat Waktu";
            } elseif ($tnow->greaterThan($masukAkhir) && $tnow->lessThan($masukAkhir->copy()->addHours($toleransi))) {
                $absen = "Terlambat";
            } elseif ($tnow->greaterThanOrEqualTo($masukAkhir->copy()->addHours($toleransi))) {
                $absen = "Alpha";
            } else {
                return response()->json(['message' => 'Waktu invalid untuk absen masuk']);
            }
        } elseif (!$alreadyCheckedOut) {
            if ($tnow->greaterThanOrEqualTo($pulang)) {
                // Memastikan absen masuk sudah dilakukan sebelum absen pulang
                if ($alreadyCheckedIn) {
                    $absen = "Pulang";
                } else {
                    return response()->json(['message' => 'User harus mengambil absen masuk sebelum absen pulang']);
                }
            } else {
                return response()->json(['message' => 'Hanya bisa absen pulang sesuai dengan waktu yang telah ditetapkan']);
            }
        } else {
            return response()->json(['message' => 'User sudah absen masuk dan pulang hari ini']);
        }

        // Menambahkan nilai absen ke data
        $data['absen'] = $absen;

        // Menyimpan data ke tabel absen_tb
        try {
            DB::table("absen_tb")->insert($data);
        } catch (\Exception $e) {
            // Log error dengan detail tambahan
            \Log::error('Error inserting data: ' . $e->getMessage() . ' - Stack Trace: ' . $e->getTraceAsString());

            // Kembalikan respons dengan pesan kesalahan yang lebih rinci
            return response()->json([
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage()  // Menampilkan pesan kesalahan detail
            ], 500);
        }

        // Mengembalikan respon JSON
        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $data], 201);
    }

    //-----------------------------------------------------------------------------------------------
    public function edit_sekolah($id)
    {
        $data = DB::table('sekolah_tb')->where('id', $id)->first();
        return view('ui.dashboard.edit', ['data' => $data]);
    }

    public function post_sekolah(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tlp' => $request->tlp,
            'email' => $request->email,
        ];

        if ($request->mode === 'add') {
            $id = DB::table('sekolah_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('sekolah_tb')->where('id', $id)->update($data);
        }

        if ($request->has('logo')) {

            request()->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('logo');
            $tujuan = "img/logo";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('sekolah_tb')
                ->where('id', $id)
                ->update(['logo' => "$tujuan/$nama"]);
        }

        return redirect(route('dashboard'))->with('sukses', 'Profile telah di perbarui');
    }

//-----------------------------------------------------------------------------------------------
    public function device()
    {
        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = DB::table('device_tb')
            ->where('id_sekolah', $id_sekolah)
            ->get();
        return view('ui.device.index', ['datas' => $data]);
    }

    public function add_device()
    {
        return view('ui.device.add');
    }

    public function edit_device($id)
    {
        $data = DB::table('device_tb')->where('id', $id)->first();
        return view('ui.device.edit', ['data' => $data]);
    }

    public function post_device(Request $request)
    {

        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = [
            'DeviceID' => $request->DeviceID,
            'ip_device' => $request->ip_device,
            'id_sekolah' => $id_sekolah,
        ];

        if ($request->mode === 'add') {
            $id = DB::table('device_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('device_tb')->where('id', $id)->update($data);
        }

        if ($request->has('picinfo')) {

            request()->validate([
                'picinfo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('picinfo');
            $tujuan = "img/photo";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('device_tb')
                ->where('id', $id)
                ->update(['picinfo' => "$tujuan/$nama"]);
        }

        return redirect(route('device'))->with('sukses', 'Data Device telah di perbarui');
    }

    public function delete_device($id)
    {
        DB::table('device_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('device'))->with('sukses', 'Data Device telah di hapus');
    }

    //-----------------------------------------------------------------------------------------------
    public function kelas()
    {
        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = DB::table('kelas_tb')
            ->where('id_sekolah', $id_sekolah)
            ->get();
        return view('ui.kelas.index', ['datas' => $data]);
    }

    public function add_kelas()
    {
        return view('ui.kelas.add');
    }

    public function edit_kelas($id)
    {
        $data = DB::table('kelas_tb')->where('id', $id)->first();
        return view('ui.kelas.edit', ['data' => $data]);
    }

    public function post_kelas(Request $request)
    {

        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        $data = [
            'id_sekolah' => $id_sekolah,
            'kelas' => $request->kelas,
        ];

        if ($request->mode === 'add') {
            $id = DB::table('kelas_tb')->insertGetId($data);
        } else {
            $id = $request->id;
            DB::table('kelas_tb')->where('id', $id)->update($data);
        }

        if ($request->has('picinfo')) {

            request()->validate([
                'picinfo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $file = $request->file('picinfo');
            $tujuan = "img/photo";
            $nama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($tujuan, $nama);

            DB::table('kelas_tb')
                ->where('id', $id)
                ->update(['picinfo' => "$tujuan/$nama"]);
        }

        return redirect(route('kelas'))->with('sukses', 'Data Kelas telah di perbarui');
    }

    public function delete_kelas($id)
    {
        DB::table('kelas_tb')
            ->where('id', $id)
            ->delete();

        return redirect(route('kelas'))->with('sukses', 'Data Kelas telah di hapus');
    }

    //-----------------------------------------------------------------------------------------------

    public function absenharian($id, Request $request)
    {
        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        // Ambil data kelas berdasarkan sekolah
        $kelass = DB::table('kelas_tb')
            ->where('id_sekolah', $id_sekolah)
            ->get();

        // Ambil tanggal dari request atau gunakan tanggal hari ini jika tidak ada
        $date = $request->date ? Carbon::createFromFormat('Y-m-d', $request->date)->toDateString() : Carbon::now()->toDateString();

        // Ambil semua user di kelas yang tidak pulang
        $users = DB::table('user_tb')
            ->leftJoin('absen_tb', function ($join) use ($date) {
                $join->on('user_tb.id', '=', 'absen_tb.CustomizeID')
                    ->where('absen_tb.created_at', 'LIKE', "$date%")
                    ->where('absen_tb.absen', '!=', 'Pulang');
            })
            ->select('user_tb.Name', 'user_tb.no_induk', 'user_tb.id AS id_user', 'absen_tb.*')
            ->where('user_tb.id_kelas', '=', $id)
            ->get();

        // Ambil semua user di kelas yang pulang
        $usersPulang = DB::table('user_tb')
            ->leftJoin('absen_tb', function ($join) use ($date) {
                $join->on('user_tb.id', '=', 'absen_tb.CustomizeID')
                    ->where('absen_tb.created_at', 'LIKE', "$date%")
                    ->where('absen_tb.absen', '=', 'Pulang');
            })
            ->select('user_tb.Name', 'user_tb.no_induk', 'user_tb.id AS id_user', 'absen_tb.*')
            ->where('user_tb.id_kelas', '=', $id)
            ->get();

        return view('ui.absen.harian.index', [
            'absens' => $users,
            'absensPulang' => $usersPulang,
            'kelass' => $kelass
        ]);
    }


    public function add_absenharian($id)
    {

        $absen = DB::table('user_tb')
            ->where('user_tb.id', '=', $id)
            ->first();

        return view('ui.absen.harian.add', ['data' => $absen]);
    }

    public function edit_absenharian($id)
    {

        $absen = DB::table('user_tb')
            ->leftJoin('absen_tb', 'user_tb.id', '=', 'absen_tb.CustomizeID')
            ->select('user_tb.Name', 'user_tb.id_kelas', 'user_tb.no_induk', 'absen_tb.*')
            ->where('absen_tb.id', '=', $id)
            ->first();

        return view('ui.absen.harian.edit', ['data' => $absen]);
    }

    public function post_absenharian(Request $request)
    {
        if ($request->mode === 'add') {
            $data = [
                'CustomizeID' => $request->id,
                'Similarity1' => 0,
                'Similarity2' => 0,
                'PersonID' => $request->id,
                'DeviceID' => 0,
                'absen' => $request->absen,
            ];
        } else {
            $data = [
                'absen' => $request->absen,
            ];
        }


        if ($request->has('cropped_image')) {
            $croppedImage = $request->input('cropped_image');
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage));
            $imageName = 'img/photo/' . time() . '.png';
            file_put_contents($imageName, $imageData);

            $data['picinfo'] = $croppedImage;
        }

        if ($request->mode === 'add') {
            DB::table('absen_tb')->insertGetId($data);
        } else {
            $id = $request->edit; // Ambil ID dari form
            DB::table('absen_tb')->where('id', $id)->update($data);
        }

        // Ambil ID kelas dari request
        $idKelas = $request->input('id_kelas');

        // Redirect ke URL dengan ID kelas
        return redirect()->route('absenharian', ['id' => $idKelas])->with('sukses', 'Absen telah diperbarui');
    }

    //-----------------------------------------------------------------------------------------------
    public function absenrekap(Request $request, $id)
    {
        $id_sekolah = DB::table('sekolah_tb')->where('id_admin', $this->idAdmin())->value('id');

        // Ambil data kelas berdasarkan sekolah
        $kelass = DB::table('kelas_tb')
            ->where('id_sekolah', $id_sekolah)
            ->get();

        // Ambil rentang tanggal dari request
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Jika tanggal tidak diinputkan, tidak perlu konversi


        // Ambil data siswa dan total kehadiran mereka, termasuk "terlambat"
        $users = DB::table('user_tb')
            ->leftJoin('absen_tb', function ($join) use ($startDate, $endDate) {
                $join->on('user_tb.id', '=', 'absen_tb.CustomizeID');

                // Filter berdasarkan rentang tanggal
                if ($startDate && $endDate) {
                    $join->whereBetween(DB::raw('DATE(absen_tb.created_at)'), [$startDate, $endDate]);
                }
            })
            ->select(
                'user_tb.Name',
                'user_tb.no_induk',
                'user_tb.id AS id_user',
                DB::raw('SUM(CASE WHEN absen_tb.absen = "Hadir" OR absen_tb.absen = "Terlambat" THEN 1 ELSE 0 END) as total_hadir'),
                DB::raw('SUM(CASE WHEN absen_tb.absen = "Izin" THEN 1 ELSE 0 END) as total_izin'),
                DB::raw('SUM(CASE WHEN absen_tb.absen = "Sakit" THEN 1 ELSE 0 END) as total_sakit'),
                DB::raw('SUM(CASE WHEN absen_tb.absen = "Alpha" THEN 1 ELSE 0 END) as total_alpha')
            )
            ->where('user_tb.id_kelas', '=', $id)
            ->groupBy('user_tb.id', 'user_tb.Name', 'user_tb.no_induk')
            ->get();

        // Mengirimkan data ke view
        return view('ui.absen.rekap.index', [
            'kelass' => $kelass,
            'users' => $users,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date
        ]);
    }
    //-----------------------------------------------------------------------------------------------
    function idAdmin()
    {
        return Auth::guard('admin')->user()->id;
    }


    public function md5Pass($pass)
    {
        return md5("$pass@absen_app");
    }
}

