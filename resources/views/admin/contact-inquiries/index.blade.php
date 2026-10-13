@extends('admin.layouts.app')
@section('title', 'Contact Inquiries')
@section('content')
<div class="page-header">
  <h1>Contact Inquiries</h1>
</div>
<div class="card">
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Project Type</th>
        <th>Status</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($inquiries as $inquiry)
      <tr>
        <td><strong>{{ $inquiry->name }}</strong></td>
        <td style="font-family:'JetBrains Mono',monospace; font-size:12px;">{{ $inquiry->email }}</td>
        <td>{{ $inquiry->project_type }}</td>
        <td>
          @if($inquiry->status === 'new')
            <span class="badge badge-new">{{ ucfirst($inquiry->status) }}</span>
          @elseif($inquiry->status === 'read')
            <span class="badge badge-read">{{ ucfirst($inquiry->status) }}</span>
          @elseif($inquiry->status === 'replied')
            <span class="badge badge-replied">{{ ucfirst($inquiry->status) }}</span>
          @else
            <span class="badge badge-closed">{{ ucfirst($inquiry->status) }}</span>
          @endif
        </td>
        <td>{{ $inquiry->created_at->format('M j, Y') }}</td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.contact-inquiries.show', $inquiry) }}" class="btn btn-xs btn-edit">View</a>
            <form method="POST" action="{{ route('admin.contact-inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Delete this inquiry?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-xs btn-delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="color:oklch(0.76 0.015 272); text-align:center; padding:32px;">No inquiries yet.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $inquiries->links() }}</div>
</div>
@endsection
