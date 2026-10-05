@extends('layouts.app')

@section('content')
<div style="margin-bottom: 24px;">
    <h2 style="font-size: 1.4rem; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Kelola Survei</h2>
    <p style="font-size: 0.88rem; color: #64748b;">Master agenda pelaksanaan survei dan sensus berkala BPS Kota Sukabumi</p>
</div>

<div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <span style="font-size: 0.95rem; font-weight: 600; color: #1e293b;">Daftar Survei Berjalan</span>
        <button type="button" style="background-color: #1e293b; color: white; border: none; padding: 9px 18px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
            <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Agenda Survei
        </button>
    </div>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600; width: 60px;">No</th>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600;">Kode Survei</th>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600;">Nama Kegiatan Survei</th>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600;">Periode Pelaksanaan</th>
                <th style="padding: 12px 16px; background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 0.75rem; text-transform: uppercase; color: #475569; font-weight: 600; text-align: right;">Status</th>
            </tr>
        </thead>
        <tbody style="font-size: 0.9rem; color: #334155;">
            <tr>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">1</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-family: monospace; font-weight: 600;">SUSENAS-26</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 500;">Survei Sosial Ekonomi Nasional (Susenas)</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">Semester II 2026</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #2563eb; font-weight: 600;">Sedang Berjalan</td>
            </tr>
            <tr>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">2</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-family: monospace; font-weight: 600;">SAKERNAS-26</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 500;">Survei Angkatan Kerja Nasional (Sakernas)</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">Triwulan IV 2026</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #2563eb; font-weight: 600;">Sedang Berjalan</td>
            </tr>
            <tr>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">3</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-family: monospace; font-weight: 600;">SBH-26</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 500;">Survei Biaya Hidup (SBH) Bulanan</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0;">Oktober 2026</td>
                <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #16a34a; font-weight: 600;">Selesai</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
