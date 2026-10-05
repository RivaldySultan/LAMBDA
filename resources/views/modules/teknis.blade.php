@extends('layouts.app')

@section('content')
<div style="margin-bottom: 24px;">
    <h2 style="font-size: 1.4rem; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Kelola Teknis</h2>
    <p style="font-size: 0.88rem; color: #64748b;">Master data bidang dan pembagian tugas teknis Badan Pusat Statistik Kota Sukabumi</p>
</div>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <span style="font-size: 0.95rem; font-weight: 600; color: #1e293b;">Daftar Bidang & Fungsi Teknis</span>
        <button type="button" style="background-color: #1e293b; color: white; border: none; padding: 9px 18px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
            <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Bidang
        </button>
    </div>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600; width: 60px;">No</th>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600;">Kode</th>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600;">Nama Fungsi / Tim Teknis</th>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600;">Koordinator</th>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600; text-align: right;">Status</th>
            </tr>
        </thead>
        <tbody style="font-size: 0.9rem; color: #334155;">
            <tr>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">1</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-family: monospace; font-weight: 600;">TEK-01</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 500;">Statistik Sosial & Kesejahteraan Rakyat</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">Anita Rahminingrum</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #16a34a; font-weight: 600;">Aktif</td>
            </tr>
            <tr>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">2</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-family: monospace; font-weight: 600;">TEK-02</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 500;">Statistik Produksi & Distribusi</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">Taufik Januar</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #16a34a; font-weight: 600;">Aktif</td>
            </tr>
            <tr>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">3</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-family: monospace; font-weight: 600;">TEK-03</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 500;">Integrasi Pengolahan & Diseminasi Statistik (IPDS)</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">Admin BPS</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #16a34a; font-weight: 600;">Aktif</td>
            </tr>
            <tr>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">4</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-family: monospace; font-weight: 600;">TEK-04</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 500;">Neraca Wilayah & Analisis Statistik</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">Wishnu Eka Saputra</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #16a34a; font-weight: 600;">Aktif</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
