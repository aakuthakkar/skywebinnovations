@extends('admin.layouts.app')
@section('title', 'Inquiry Detail')
@section('content')
<div style="max-width:720px;">
  <div class="page-header">
    <h1>Inquiry from {{ $inquiry->name }}</h1>
    <div class="actions">
      <a href="{{ route('admin.contact-inquiries.index') }}" class="btn">← Back to List</a>
      <form method="POST" action="{{ route('admin.contact-inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Delete this inquiry?')" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-delete">Delete</button>
      </form>
    </div>
  </div>

  <div class="card" style="margin-bottom:24px;">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 20px;">Contact Details</h2>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div><p style="font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); margin:0 0 4px;">Name</p><p style="margin:0;">{{ $inquiry->name }}</p></div>
      <div><p style="font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); margin:0 0 4px;">Email</p><p style="margin:0;">{{ $inquiry->email }}</p></div>
      <div><p style="font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); margin:0 0 4px;">Project Type</p><p style="margin:0;">{{ $inquiry->project_type }}</p></div>
      <div><p style="font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); margin:0 0 4px;">Status</p><p style="margin:0;">{{ ucfirst($inquiry->status) }}</p></div>
      <div><p style="font-family:'JetBrains Mono',monospace; font-size:11px; text-transform:uppercase; color:oklch(0.65 0.02 272); margin:0 0 4px;">Submitted</p><p style="margin:0;">{{ $inquiry->created_at->format('M j, Y g:i A') }}</p></div>
    </div>
  </div>

  <div class="card" style="margin-bottom:24px;">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 12px;">Message</h2>
    <p style="color:oklch(0.76 0.015 272); line-height:1.7; white-space:pre-wrap;">{{ $inquiry->message }}</p>
  </div>

  <div class="card">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 20px;">Update Status</h2>
    <form method="POST" action="{{ route('admin.contact-inquiries.update-status', $inquiry) }}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label>Status</label>
        <select name="status" onchange="this.form.submit()">
          <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>New</option>
          <option value="read" {{ $inquiry->status === 'read' ? 'selected' : '' }}>Read</option>
          <option value="replied" {{ $inquiry->status === 'replied' ? 'selected' : '' }}>Replied</option>
          <option value="closed" {{ $inquiry->status === 'closed' ? 'selected' : '' }}>Closed</option>
        </select>
      </div>
    </form>
  </div>
</div>
@endsection
