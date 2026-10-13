@extends('admin.layouts.app')

@section('title', 'Footer Links')

@section('content')
<div class="page-header">
    <h1>Footer Links</h1>
</div>

<div class="card" style="margin-bottom:24px;">
    <table>
        <thead>
            <tr>
                <th>Label</th>
                <th>URL</th>
                <th>Column</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($links as $column => $columnLinks)
            @foreach($columnLinks as $link)
            <tr>
                <td>{{ $link->label }}</td>
                <td style="font-family:'JetBrains Mono',monospace;font-size:13px;color:oklch(0.65 0.02 272);">{{ $link->url }}</td>
                <td><span style="font-family:'JetBrains Mono',monospace;font-size:12px;background:oklch(0.22 0.025 272);padding:3px 8px;border-radius:4px;">{{ $link->column_name }}</span></td>
                <td>{{ $link->order }}</td>
                <td class="actions">
                    <form method="POST" action="{{ route('admin.footer-links.destroy', $link) }}" style="display:inline;" onsubmit="return confirm('Delete this footer link?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-delete" style="border:none;cursor:pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @empty
            <tr><td colspan="5" style="text-align:center;color:oklch(0.65 0.02 272);">No footer links yet. Add your first link below.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card">
    <h2 style="font-family:'JetBrains Mono',monospace;font-size:12px;text-transform:uppercase;color:oklch(0.65 0.02 272);letter-spacing:0.06em;margin-bottom:20px;">Add Footer Link</h2>
    <form method="POST" action="{{ route('admin.footer-links.store') }}">
        @csrf
        <div style="display:grid;grid-template-columns:2fr 3fr 2fr 1fr auto;gap:12px;align-items:end;">
            <div class="form-group" style="margin-bottom:0;">
                <label>Label</label>
                <input type="text" name="label" value="{{ old('label') }}" required placeholder="About Us">
                @error('label')<p style="color:oklch(0.72 0.17 25);font-size:12px;">{{ $message }}</p>@enderror
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label>URL</label>
                <input type="text" name="url" value="{{ old('url') }}" required placeholder="#about or /page/about">
                @error('url')<p style="color:oklch(0.72 0.17 25);font-size:12px;">{{ $message }}</p>@enderror
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label>Column</label>
                <input type="text" name="column_name" value="{{ old('column_name', 'site') }}" placeholder="site, contact, legal">
                @error('column_name')<p style="color:oklch(0.72 0.17 25);font-size:12px;">{{ $message }}</p>@enderror
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label>Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
        <div style="margin-top:12px;">
            <label style="display:flex;align-items:center;gap:6px;font-size:14px;cursor:pointer;">
                <input type="checkbox" name="is_active" {{ old('is_active') ? 'checked' : '' }} style="width:auto;"> Active
            </label>
        </div>
    </form>
</div>
@endsection
