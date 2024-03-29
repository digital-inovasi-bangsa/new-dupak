<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kegiatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('pangkat_model');
        $this->load->model('kegiatan_model');
        $this->load->helper(array('form', 'url'));
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Kegiatan';
        $userId = $this->session->userdata('userId');
        $data['kegiatan'] = $this->kegiatan_model->getTelahDiajukan($userId);
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/kegiatan', $data);
        $this->load->view('includes/footer');
    }

    public function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            redirect('/login');
        } else {
            $this->role = $this->session->userdata('role');
            $this->vendorId = $this->session->userdata('userId');
            $this->name = $this->session->userdata('name');
            $this->roleText = $this->session->userdata('roleText');
            $this->fotoProfil = $this->session->userdata('fotoProfil');
            $this->idJabatan = $this->session->userdata('idJabatan');

            $this->global['name'] = $this->name;
            $this->global['role'] = $this->role;
            $this->global['role_text'] = $this->roleText;
            $this->global['fotoProfil'] = $this->fotoProfil;
            $this->global['idJabatan'] = $this->idJabatan;
        }
    }

    public function isAdmin()
    {
        if ($this->role != ROLE_ADMIN) {return true;} else {return false;}
    }

    public function isTicketter()
    {
        if ($this->role != ROLE_ADMIN || $this->role != ROLE_MANAGER) {return true;} else {return false;}

    }

    public function loadThis()
    {
        $this->global['pageTitle'] = 'Akses Ditolak';

        $this->load->view('includes/header', $this->global);
        $this->load->view('access');
        $this->load->view('includes/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('/login');
    }

    public function loadCalendar()
    {
        $id = $this->session->userdata('userId');
        $event_data = $this->kegiatan_model->fetch_all_event($id);
        foreach ($event_data->result_array() as $row) {
            $date = $row['tanggalSelesai'];
            $date1 = str_replace('-', '/', $date);
            $tomorrow = date('Y-m-d', strtotime($date1 . "+1 days"));
            if ($row['status'] == 'Belum Upload Bukti') {
                $warna = 'gray';
                $link = base_url('kegiatan/uploadBukti/'.$row['idKegiatanHarian']);
                $data[] = array(
                    'id' => $row['idKegiatanHarian'],
                    'title' => $row['namaButir'],
                    'start' => $row['tanggalMulai'],
                    'end' => $tomorrow,
                    'color' => $warna,
                    'status' => $row['status'],
                    'description' => 'Belum upload bukti',
                    'url' => $link
                );
            } else if ($row['status'] == 'Diajukan') {
                $warna = 'purple';
                $data[] = array(
                    'id' => $row['idKegiatanHarian'],
                    'title' => $row['namaButir'],
                    'start' => $row['tanggalMulai'],
                    'end' => $tomorrow,
                    'color' => $warna,
                    'status' => $row['status'],
                    'description' => 'Sedang proses pengajuan',
                );
            } else if ($row['status'] == 'Diterima') {
                $warna = 'green';
                $catatan = 'Diterima dengan catatan '.$row['catatan'];
                $data[] = array(
                    'id' => $row['idKegiatanHarian'],
                    'title' => $row['namaButir'],
                    'start' => $row['tanggalMulai'],
                    'end' => $tomorrow,
                    'color' => $warna,
                    'status' => $row['status'],
                    'description' => $catatan,
                );
            } else if ($row['status'] == 'Ditolak') {
                $warna = 'red';
                $catatan = 'Ditolak dengan catatan '.$row['catatan'];
                $data[] = array(
                    'id' => $row['idKegiatanHarian'],
                    'title' => $row['namaButir'],
                    'start' => $row['tanggalMulai'],
                    'end' => $tomorrow,
                    'color' => $warna,
                    'status' => $row['status'],
                    'description' => $catatan,
                );
            } else {
                $warna = 'black';
                $data[] = array(
                    'id' => $row['idKegiatanHarian'],
                    'title' => $row['namaButir'],
                    'start' => $row['tanggalMulai'],
                    'end' => $tomorrow,
                    'color' => $warna,
                    'status' => $row['status'],
                    'description' => 'Pengajuan kadaluarsa',
                );
            }
            
        }
        echo json_encode($data);
    }

    public function addNew()
    {
        $this->load->model('pangkat_model');
        $idJabatan = $this->global['idJabatan'];
        $data['roles'] = $this->pangkat_model->getUserRoles();
        $data['pangkat'] = $this->user_model->getUserPangkat();
        $data['unsur'] = $this->kegiatan_model->unsurListing();
        $data['jenjang'] = $this->getJenjang($idJabatan);
        $this->global['pageTitle'] = 'Tambahkan Data Kegiatan';
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/addNew', $data);
        $this->load->view('includes/footer');
    }

    public function getSubunsur()
    {
        $id = $this->input->post('idUnsur');
        $data = $this->kegiatan_model->getSubunsur($id);
        echo json_encode($data);

    }

    public function getButir()
    {
        $id = $this->input->post('idSubunsur');
        $data = $this->kegiatan_model->getButir($id);
        echo json_encode($data);
    }

    public function getButirKegiatan()
    {
        $id = $this->input->post('idButir');
        $data = $this->kegiatan_model->getButirKegiatan($id);
        echo json_encode($data);
    }

    public function getJenjang($id)
    {
        $data = $this->kegiatan_model->getJenjang($id);
        return $data;
    }

    public function addNewKegiatan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'trim|required');
        $this->form_validation->set_rules('unsur', 'Unsur', 'trim|required');
        $this->form_validation->set_rules('subunsur', 'Subunsur', 'trim|required');
        $this->form_validation->set_rules('butir', 'Butir', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->addNew();
        } else {
            $idJenjang = $this->input->post('jenjang');
            $idUnsur = $this->input->post('unsur');
            $idSubUnsur = $this->input->post('subunsur');
            $idButir = $this->input->post('butir');
            $butirKegiatan = $this->input->post('businessType');
            $tanggalMulai = $this->input->post('tanggalMulai');
            $tanggalSelesai = $this->input->post('tanggalSelesai');
            $NewTanggalMulai = date("Y-m-d", strtotime($tanggalMulai));
            $NewTanggalSelesai = date("Y-m-d", strtotime($tanggalSelesai));
            $userId = $this->session->userdata('userId');
            $status = 'Belum Upload Bukti';
            $rstButirKegiatan = str_replace('"', '', json_encode($butirKegiatan));
            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');

            $kegiatanInfo = array(
                'userId' => $userId,
                'idJenjang' => $idJenjang,
                'idUnsur' => $idUnsur,
                'idSubUnsur' => $idSubUnsur,
                'idButir' => $idButir,
                'butirKegiatan' => $rstButirKegiatan,
                'tanggalMulai' => $NewTanggalMulai,
                'tanggalSelesai' => $NewTanggalSelesai,
                'status' => $status,
                'createdAt' => $now,
                'updatedAt' => $now,
            );

            $result = $this->kegiatan_model->addNewKegiatan($kegiatanInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Kegiatan Berhasil Ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Kegiatan Gagal Ditambahkan');
            }

            redirect('kegiatan');
        }
    }

    public function uploadBukti()
    {

        $this->global['pageTitle'] = 'Upload Bukti Kegiatan';
        $userId = $this->session->userdata('userId');
        $idKegiatanHarian = $this->uri->segment(3);
        $session = array(
            'idKegiatanHarian' => $idKegiatanHarian,
        );
        $this->session->set_userdata($session);
        $idKegiatanHarian = $this->session->userdata('userId');
        $data['kegiatan'] = $this->kegiatan_model->getTelahDiajukan($userId);
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/uploadBukti', $data);
        $this->load->view('includes/footer');
    }

    public function uploadSuratPerintah($user_id, $file_id)
    {
        $config['max_size'] = 10024;
        $config['upload_path'] = './upload/dokumentasi/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['file_name'] = 'SP' . $user_id . '_' . date('Ymdhis');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_id)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        }
    }
    public function uploadDokumentasi($user_id, $file_id)
    {
        $config['max_size'] = 10024;
        $config['upload_path'] = './upload/dokumentasi/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['file_name'] = 'DK' . $user_id . '_' . date('Ymdhis');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_id)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        }
    }

    public function uploadLaporan($user_id, $file_id)
    {
        $config['max_size'] = 10024;
        $config['upload_path'] = './upload/dokumentasi/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['file_name'] = 'LP' . $user_id . '_' . date('Ymdhis');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_id)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        }
    }

    public function uploadDaftarHadir($user_id, $file_id)
    {
        $config['max_size'] = 10024;
        $config['upload_path'] = './upload/dokumentasi/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['file_name'] = 'DH' . $user_id . '_' . date('Ymdhis');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_id)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        }
    }

    public function uploadJurnal($user_id, $file_id)
    {
        $config['max_size'] = 10024;
        $config['upload_path'] = './upload/dokumentasi/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['file_name'] = 'JN' . $user_id . '_' . date('Ymdhis');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_id)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        }
    }

    public function uploadChecklist($user_id, $file_id)
    {
        $config['max_size'] = 10024;
        $config['upload_path'] = './upload/dokumentasi/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['file_name'] = 'CP' . $user_id . '_' . date('Ymdhis');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_id)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        }
    }

    public function uploadSprintSiaga($user_id, $file_id)
    {
        $config['max_size'] = 10024;
        $config['upload_path'] = './upload/dokumentasi/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['file_name'] = 'SS' . $user_id . '_' . date('Ymdhis');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_id)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data['upload_data']['file_name'];
        }
    }

    public function addNewBuktiKegiatan()
    {
        $userId = $this->session->userdata('userId');
        $data['kegiatan'] = $this->kegiatan_model->getTelahDiajukan($userId);
        $idKegiatanHarian = $this->session->userdata('idKegiatanHarian');
        $nip = $this->session->userdata('nip');
        $suratPerintah = $this->uploadSuratPerintah($nip, 'surat_perintah');
        $dokumentasi = $this->uploadDokumentasi($nip, 'dokumentasi');
        $laporanKegiatan = $this->uploadLaporan($nip, 'laporan_data');
        $daftarHadir = $this->uploadDaftarHadir($nip, 'daftar_hadir');
        $jurnal = $this->uploadJurnal($nip, 'jurnal');
        $sprintSiaga = $this->uploadSprintSiaga($nip, 'sprint_siaga');
        $checklistPeralatan = $this->uploadSprintSiaga($nip, 'checklist_peralatan');
        $buktiInfo = array(
            'idKegiatanHarian' => $idKegiatanHarian,
            'path_surat_kegiatan' => $suratPerintah,
            'path_laporan_kegiatan' => $laporanKegiatan,
            'path_dokumentasi' => $dokumentasi,
            'path_daftar_hadir' => $daftarHadir,
            'path_jurnal' => $jurnal,
            'path_sprint_siaga' => $sprintSiaga,
            'path_check_peralatan' => $checklistPeralatan,
        );
        $result = $this->kegiatan_model->addNewBuktiKegiatan($buktiInfo);

        if ($result > 0) {
            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');
            $statusInfo = array(
                'status' => 'Diajukan',
                'updatedAt' => $now,
            );
            $status = $this->kegiatan_model->updateStatusKegiatan($statusInfo, $idKegiatanHarian);
            $this->session->set_flashdata('success', 'Dokumen Kegiatan Berhasil Ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Dokumen Kegiatan Gagal Ditambahkan');
        }

        redirect('kegiatan');
    }

    public function updateStatusKegiatan()
    {
        $status = $this->input->post("status");
        $id = $this->input->post("id");
        $catatan = $this->input->post("catatan");
        $statusInfo = array(
            'status' => $status,
            'catatan' => $catatan,
        );
        $status = $this->kegiatan_model->updateStatusKegiatan($statusInfo, $id);

        if ($status) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function approvalKegiatan()
    {
        $this->global['pageTitle'] = 'Persetujuan Kegiatan';
        $userId = $this->session->userdata('userId');
        $data['kegiatan'] = $this->kegiatan_model->getKegiatanDiajukan();
        // print_r($data);die;
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/approvalKegiatan', $data);
        $this->load->view('includes/footer');
    }

    public function riwayatKegiatanHarian()
    {
        $this->global['pageTitle'] = 'Riwayat Kegiatan Harian';
        $userId = $this->session->userdata('userId');
        $data['kegiatan'] = $this->kegiatan_model->getRiwayatKegiatanHarian($userId);
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/riwayatKegiatanHarian', $data);
        $this->load->view('includes/footer');
    }

    public function getDokumenKegiatan()
    {
        $id = $this->input->post('idDokumenKegiatan');
        $data = $this->kegiatan_model->getKegiatan($id);
        echo json_encode($data);
    }

    public function spmk()
    {
        $this->global['pageTitle'] = 'Riwayat Kegiatan Harian';
        $userId = $this->session->userdata('userId');
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        $bulan = date('m');
        $tahun = date('Y');
        if ($bulan == '' && $tahun == '') {
            if ($data['bulan'] >= 01 && $data['bulan'] <= 06) {
                $data['spmk'] = $this->kegiatan_model->getSpmk($userId, $data['tahun'], 01, 06);
            } else {
                $data['spmk'] = $this->kegiatan_model->getSpmk($userId, $data['tahun'], 07, 12);
            }
        } else {
            if ($bulan >= 01 && $bulan <= 06) {
                $data['spmk'] = $this->kegiatan_model->getSpmk($userId, $tahun, 01, 06);
            } else {
                $data['spmk'] = $this->kegiatan_model->getSpmk($userId, $tahun, 07, 12);
            }
        }
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/spmk', $data);
        $this->load->view('includes/footer');
    }

    public function cariSpmk()
    {
        $this->global['pageTitle'] = 'Cari SPMK';
        $userId = $this->session->userdata('userId');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        if ($bulan == '' && $tahun == '') {
            if ($data['bulan'] >= 01 && $data['bulan'] <= 06) {
                $data['spmk'] = $this->kegiatan_model->getSpmk($userId, $data['tahun'], 01, 06);
            } else {
                $data['spmk'] = $this->kegiatan_model->getSpmk($userId, $data['tahun'], 07, 12);
            }
        } else {
            if ($bulan >= 01 && $bulan <= 06) {
                $data['spmk'] = $this->kegiatan_model->getSpmk($userId, $tahun, 01, 06);
            } else {
                $data['spmk'] = $this->kegiatan_model->getSpmk($userId, $tahun, 07, 12);
            }
        }
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/spmk', $data);
        $this->load->view('includes/footer');
    }

    public function detailSpmk()
    {
        $userId = $this->session->userdata('userId');
        $data['atasan'] = $this->kegiatan_model->getAtasan();
        $data['user'] = $this->kegiatan_model->getUser($userId);
        $tahun = $this->uri->segment(4);
        $bulan = $this->uri->segment(5);
        $idUnsur = $this->uri->segment(6);
        $sessionArray = array(
            'tahunSpmk' => $tahun,
            'bulanSpmk' => $bulan,
            'idUnsur' => $idUnsur,
        );
        $this->session->set_userdata($sessionArray);
        if ($bulan >= 01 && $bulan <= 06) {
            $bulanAwal = 01;
            $bulanAkhir = 06;
            $data['periode'] = "Jan-Jun " . $tahun;
        } else {
            $bulanAwal = 07;
            $bulanAkhir = 12;
            $data['periode'] = "Jul-Des " . $tahun;
        }
        $data['kegiatan'] = $this->kegiatan_model->getTabelKegiatanSpmk($userId, $tahun, $bulanAwal, $bulanAkhir, $idUnsur);
        $data['total'] = $this->kegiatan_model->getTabelKegiatanSpmkTotal($userId, $tahun, $bulanAwal, $bulanAkhir, $idUnsur);
        $this->global['pageTitle'] = 'Detail Spmk';
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/detailSpmk', $data);
        $this->load->view('includes/footer');
    }

    public function printSpmk()
    {
        $userId = $this->session->userdata('userId');
        $data['atasan'] = $this->kegiatan_model->getAtasan();
        $data['user'] = $this->kegiatan_model->getUser($userId);
        $tahun = $this->session->userdata('tahunSpmk');
        $bulan = $this->session->userdata('bulanSpmk');
        $idUnsur = $this->session->userdata('idUnsur');
        if ($bulan >= 01 && $bulan <= 06) {
            $bulanAwal = 01;
            $bulanAkhir = 06;
            $data['periode'] = "Jan-Jun " . $tahun;
        } else {
            $bulanAwal = 07;
            $bulanAkhir = 12;
            $data['periode'] = "Jul-Des " . $tahun;
        }
        $data['kegiatan'] = $this->kegiatan_model->getTabelKegiatanSpmk($userId, $tahun, $bulanAwal, $bulanAkhir, $idUnsur);
        $data['total'] = $this->kegiatan_model->getTabelKegiatanSpmkTotal($userId, $tahun, $bulanAwal, $bulanAkhir, $idUnsur);
        $this->global['pageTitle'] = 'Detail Spmk';
        $this->load->view('kegiatan/printSpmk', $data);
    }

    public function printDupak()
    {
        $this->global['pageTitle'] = 'Dupak';
        $userId = $this->session->userdata('userId');
        $data['user'] = $this->kegiatan_model->getUser($userId);
        $array['unsur'] = $this->kegiatan_model->UnsurListing();
        $countUnsur = $this->kegiatan_model->UnsurListingCount();
        $data['atasan'] = $this->kegiatan_model->getAtasan();
        $data['tahun'] = $this->uri->segment(5);
        $data['bulan'] = $this->uri->segment(4);
        $bulan = $this->uri->segment(4);
        $tahun = $this->uri->segment(5);
        if ($bulan == '' && $tahun == '') {
            if ($data['bulan'] >= 01 && $data['bulan'] <= 06) {
                $data['periode'] = "Jan-Jun " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 01, 06);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 01, 06, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            } else {
                $data['periode'] = "Jul-Des " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 07, 12);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 07, 12, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            }
        } else {
            if ($bulan >= 01 && $bulan <= 06) {
                $data['periode'] = "Jan-Jun " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 01, 06);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 01, 06, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            } else {
                $data['periode'] = "Jul-Des " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 07, 12);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 07, 12, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            }
        }
        //echo '<pre>',print_r($subunsur),'</pre>';die();
        $tanggalSekarang = date('Y-m-d');
        $mulaiKerja = $data['user']->mulaiKerja;
        $lamaKerja = $this->datediff($mulaiKerja, $tanggalSekarang);
        $data['lamaKerja'] = $lamaKerja;
        $data['unsur'] = $subunsur;
        $this->load->view('kegiatan/printDupak', $data);
    }

    public function dupak()
    {
        $this->global['pageTitle'] = 'Dupak';
        $userId = $this->session->userdata('userId');
        $data['user'] = $this->kegiatan_model->getUser($userId);
        $array['unsur'] = $this->kegiatan_model->UnsurListing();
        $countUnsur = $this->kegiatan_model->UnsurListingCount();
        $data['atasan'] = $this->kegiatan_model->getAtasan();
        $data['tahun'] = date('Y');
        $data['bulan'] = date('m');
        $bulan = date('m');
        $tahun = date('Y');
        if ($bulan == '' && $tahun == '') {
            if ($data['bulan'] >= 01 && $data['bulan'] <= 06) {
                $data['periode'] = "Jan-Jun " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 01, 06);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 01, 06, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            } else {
                $data['periode'] = "Jul-Des " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 07, 12);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 07, 12, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            }
        } else {
            if ($bulan >= 01 && $bulan <= 06) {
                $data['periode'] = "Jan-Jun " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 01, 06);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 01, 06, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }

            } else {
                $data['periode'] = "Jul-Des " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 07, 12);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 07, 12, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            }
        }
        //echo '<pre>',print_r($subunsur),'</pre>';die();
        $tanggalSekarang = date('Y-m-d');
        $mulaiKerja = $data['user']->mulaiKerja;
        $lamaKerja = $this->datediff($mulaiKerja, $tanggalSekarang);
        $data['lamaKerja'] = $lamaKerja;
        $data['unsur'] = $subunsur;
        // echo '<pre>',print_r($data),'</pre>';die;
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/dupak', $data);
        $this->load->view('includes/footer');
    }

    public function cariDupak()
    {
        $this->global['pageTitle'] = 'Cari Dupak';
        $userId = $this->session->userdata('userId');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['user'] = $this->kegiatan_model->getUser($userId);
        $array['unsur'] = $this->kegiatan_model->UnsurListing();
        $countUnsur = $this->kegiatan_model->UnsurListingCount();
        $data['atasan'] = $this->kegiatan_model->getAtasan();
        if ($bulan == '' && $tahun == '') {
            if ($data['bulan'] >= 01 && $data['bulan'] <= 06) {
                $data['periode'] = "Jan-Jun " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 01, 06);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 01, 06, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            } else {
                $data['periode'] = "Jul-Des " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 07, 12);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 07, 12, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            }
        } else {
            if ($bulan >= 01 && $bulan <= 06) {
                $data['periode'] = "Jan-Jun " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 01, 06);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 01, 06, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            } else {
                $data['periode'] = "Jul-Des " . $tahun;
                $data['total'] = $this->kegiatan_model->getTabelKegiatanDupakTotal($userId, $data['tahun'], 07, 12);
                $subunsur = [];
                $butir = [];
                foreach ($array['unsur'] as $row) {
                    $temp = [
                        'idunsur' => $row->idUnsur,
                        'namaUnsur' => $row->namaUnsur,
                        'subunsur' => [],
                    ];
                    $temp2 = $this->kegiatan_model->getSubunsur($row->idUnsur);
                    foreach ($temp2 as $row2) {
                        $rst = [
                            'idSubunsur' => $row2->idSubunsur,
                            'namaSubunsur' => $row2->namaSubunsur,
                            'butir' => [],
                        ];
                        $temp3 = $this->kegiatan_model->getButir($row2->idSubunsur);
                        // echo '<pre>',print_r($temp3),'</pre>';die();
                        foreach ($temp3 as $row3) {
                            $nilaiInstansiBaru = $this->kegiatan_model->getPointButir($userId, $tahun, 07, 12, $row3->idButir);
                            if ($nilaiInstansiBaru) {
                                foreach ($nilaiInstansiBaru as $nilaiBaru) {
                                    $rst2 = [
                                        'idButir' => $row3->idButir,
                                        'namaButir' => $row3->namaButir,
                                        'nilaiInstansiLama' => 0,
                                        'nilaiInstansiBaru' => $nilaiBaru->point,
                                        'nilaiInstansiJumlah' => $nilaiBaru->point,
                                        'nilaiPenilaiLama' => '',
                                        'nilaiPenilaiBaru' => '',
                                        'nilaiPenilaiJumlah' => '',
                                    ];
                                }
                            } else {
                                $rst2 = [
                                    'idButir' => $row3->idButir,
                                    'namaButir' => $row3->namaButir,
                                    'nilaiInstansiLama' => 0,
                                    'nilaiInstansiBaru' => 0,
                                    'nilaiInstansiJumlah' => 0,
                                    'nilaiPenilaiLama' => '',
                                    'nilaiPenilaiBaru' => '',
                                    'nilaiPenilaiJumlah' => '',
                                ];
                            }
                            array_push($rst['butir'], $rst2);
                        }
                        array_push($temp['subunsur'], $rst);
                        //echo '<pre>',print_r($rst),'</pre>';die();
                    }
                    //$temp['subunsur'] = $rst;
                    array_push($subunsur, $temp);
                }
            }
        }
        //echo '<pre>',print_r($subunsur),'</pre>';die();
        $tanggalSekarang = date('Y-m-d');
        $mulaiKerja = $data['user']->mulaiKerja;
        $lamaKerja = $this->datediff($mulaiKerja, $tanggalSekarang);
        $data['lamaKerja'] = $lamaKerja;
        $data['unsur'] = $subunsur;
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/dupak', $data);
        $this->load->view('includes/footer');
    }

    public function datediff($date1, $date2)
    {
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $result = $years . " Tahun " . $months . " Bulan";
        return $result;
    }

}
