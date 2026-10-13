@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div style="padding:24px;">
  <h1 style="font-family:'Bricolage Grotesque',sans-serif; font-size:32px; font-weight:600; margin:0 0 32px;">Dashboard</h1>

  <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:16px; margin-bottom:40px;">
    <div style="background:oklch(0.18 0.025 272); border:1px solid oklch(0.28 0.025 272); border-radius:16px; padding:24px;">
      <p style="margin:0; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); letter-spacing:0.06em;">Total Inquiries</p>
      <p style="margin:8px 0 0; font-size:36px; font-weight:700;">{{ $inquiryCount }}</p>
    </div>
    <div style="background:oklch(0.18 0.025 272); border:1px solid oklch(0.28 0.025 272); border-radius:16px; padding:24px;">
      <p style="margin:0; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); letter-spacing:0.06em;">New</p>
      <p style="margin:8px 0 0; font-size:36px; font-weight:700; color:oklch(0.72 0.17 150);">{{ $statusCounts['new'] ?? 0 }}</p>
    </div>
    <div style="background:oklch(0.18 0.025 272); border:1px solid oklch(0.28 0.025 272); border-radius:16px; padding:24px;">
      <p style="margin:0; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); letter-spacing:0.06em;">Read</p>
      <p style="margin:8px 0 0; font-size:36px; font-weight:700;">{{ $statusCounts['read'] ?? 0 }}</p>
    </div>
    <div style="background:oklch(0.18 0.025 272); border:1px solid oklch(0.28 0.025 272); border-radius:16px; padding:24px;">
      <p style="margin:0; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); letter-spacing:0.06em;">Replied</p>
      <p style="margin:8px 0 0; font-size:36px; font-weight:700;">{{ $statusCounts['replied'] ?? 0 }}</p>
    </div>
  </div>

  <div style="background:oklch(0.18 0.025 272); border:1px solid oklch(0.28 0.025 272); border-radius:16px; padding:24px;">
    <h2 style="margin:0 0 20px; font-family:'Bricolage Grotesque',sans-serif; font-size:20px; font-weight:600;">Recent Inquiries</h2>
    @if($newInquiries->count() > 0)
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="border-bottom:1px solid oklch(0.28 0.025 272);">
          <th style="text-align:left; padding:12px 8px; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272);">Name</th>
          <th style="text-align:left; padding:12px 8px; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272);">Email</th>
          <th style="text-align:left; padding:12px 8px; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272);">Type</th>
          <th style="text-align:left; padding:12px 8px; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272);">Status</th>
          <th style="text-align:left; padding:12px 8px; font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272);">Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach($newInquiries as $inquiry)
        <tr style="border-bottom:1px solid oklch(0.28 0.025 272);">
          <td style="padding:12px 8px;">{{ $inquiry->name }}</td>
          <td style="padding:12px 8px;">{{ $inquiry->email }}</td>
          <td style="padding:12px 8px;">{{ $inquiry->project_type }}</td>
          <td style="padding:12px 8px;"><span style="padding:4px 10px; border-radius:999px; background:{{ match($inquiry->status) { 'new' => 'oklch(0.72 0.17 150)', 'read' => 'oklch(0.62 0.19 273)', 'replied' => 'oklch(0.72 0.17 150)', 'closed' => 'oklch(0.65 0.02 272)' } }}; color:#fff; font-size:12px;">{{ ucfirst($inquiry->status) }}</span></td>
          <td style="padding:12px 8px;">{{ $inquiry->created_at->format('M j, Y') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a href="{{ route('admin.contact-inquiries.index') }}" style="display:inline-block; margin-top:16px; color:oklch(0.78 0.12 273); text-decoration:none; font-size:14px;">View all inquiries &rarr;</a>
    @else
    <p style="color:oklch(0.76 0.015 272);">No inquiries yet.</p>
    @endif
  </div>
</div>
@endsection
