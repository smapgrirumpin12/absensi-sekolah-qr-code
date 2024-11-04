<?php

namespace App\Controllers;

use App\Models\SiswaModel; // Asumsikan Anda memiliki model Siswa
use Twilio\Rest\Client;

class NotifikasiController extends BaseController
{
    public function kirimNotifikasi($idSiswa)
    {
        // Ambil data siswa berdasarkan ID
        $siswaModel = new SiswaModel();
        $siswa = $siswaModel->find($idSiswa);

        // Konfigurasi Twilio
        $accountSid = 'YOUR_ACCOUNT_SID'; // Ganti dengan akun SID Anda
        $authToken = 'YOUR_AUTH_TOKEN'; // Ganti dengan auth token Anda
        $client = new Client($accountSid, $authToken);

        // Kirim pesan WhatsApp
        $client->messages->create(
            // Nomor tujuan (misal: nomor wali siswa)
            'whatsapp:+6281234567890',
            [
                'from' => 'whatsapp:+14155238886', // Nomor WhatsApp Twilio Anda
                'body' => 'Siswa ' . $siswa['nama'] . ' telah absen pada tanggal ' . date('d-m-Y')
            ]
        );

        // Kembalikan respons (opsional)
        return $this->response->setJSON(['status' => 'success', 'message' => 'Notifikasi terkirim']);
    }
}