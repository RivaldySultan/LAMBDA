@extends('layouts.app')

@section('content')
<div style="margin-bottom: 24px;">
    <h2 style="font-size: 1.4rem; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Informasi BPS Kota Sukabumi</h2>
    <p style="font-size: 0.88rem; color: #64748b;">Profil satuan kerja, saluran bantuan teknis, dan informasi instansi</p>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 28px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <h3 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Badan Pusat Statistik Kota Sukabumi</h3>
        <p style="font-size: 0.92rem; color: #475569; line-height: 1.6; margin-bottom: 20px;">
            Aplikasi LAMBDA (Laporan Aktivitas Harian Bersama Data Akurat) merupakan sistem internal BPS Kota Sukabumi untuk mencatat, mendokumentasikan, dan memvalidasi log kinerja harian seluruh aparatur sipil negara dan pegawai BPS secara terstruktur dan akuntabel.
        </p>

        <h4 style="font-size: 0.82rem; text-transform: uppercase; font-weight: 700; color: #64748b; margin-bottom: 10px; letter-spacing: 0.5px;">Alamat Kantor</h4>
        <p style="font-size: 0.9rem; color: #1e293b; margin-bottom: 20px;">
            Jl. Taman Bahagia No. 12, Benteng, Kec. Warudoyong, Kota Sukabumi, Jawa Barat 43132
        </p>

        <h4 style="font-size: 0.82rem; text-transform: uppercase; font-weight: 700; color: #64748b; margin-bottom: 10px; letter-spacing: 0.5px;">Visi BPS</h4>
        <p style="font-size: 0.9rem; color: #1e293b; line-height: 1.5;">
            "Penyedia Data Statistik Berkualitas untuk Indonesia Maju"
        </p>
    </div>

    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 16px;">Bantuan & Layanan IT</h3>
        
        <div style="font-size: 0.88rem; color: #475569; margin-bottom: 16px;">
            <strong style="color: #0f172a; display: block; margin-bottom: 4px;">Tim IPDS BPS Kota Sukabumi</strong>
            <span>Pelayanan kendala login, reset password, dan sinkronisasi tanda tangan.</span>
        </div>

        <div style="padding-top: 14px; border-top: 1px solid #f1f5f9; font-size: 0.85rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                <span style="color: #64748b;">Email Dukungan:</span>
                <span style="font-weight: 600; color: #0f172a;">bps3272@bps.go.id</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="color: #64748b;">Versi Sistem:</span>
                <span style="font-weight: 600; color: #16a34a;">LAMBDA v2.0 (Active)</span>
            </div>
        </div>
    </div>
</div>
@endsection
