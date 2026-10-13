@extends('admin.layouts.app')

@section('title', 'Navigation')

@section('content')
<div class="page-header">
    <h1>Navigation</h1>
</div>

{{-- Header Navigation --}}
<div class="card" style="margin-bottom:24px;">
    <h2 style="font-family:'JetBrains Mono',monospace;font-size:12px;text-transform:uppercase;color:oklch(0.65 0.02 272);letter-spacing:0.06em;margin-bottom:20px;">Header Navigation</h2>

    <table>
        <thead>
            <tr>
                <th>Label</th>
                <th>URL</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items['header'] ?? [] as $item)
            <tr>
                <td>{{ $item->label }}</td>
                <td style="font-family:'JetBrains Mono',monospace;font-size:13px;color:oklch(0.65 0.02 272);">{{ $item->url }}</td>
                <td>{{ $item->order }}</td>
                <td class="actions">
                    <button onclick="editNavItem({{ $item->toJson() }})" class="btn btn-xs btn-edit" style="border:none;cursor:pointer;">Edit</button>
                    <form method="POST" action="{{ route('admin.navigation.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Delete this navigation item?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-delete" style="border:none;cursor:pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:oklch(0.65 0.02 272);">No header navigation items yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Footer Navigation --}}
<div class="card" style="margin-bottom:24px;">
    <h2 style="font-family:'JetBrains Mono',monospace;font-size:12px;text-transform:uppercase;color:oklch(0.65 0.02 272);letter-spacing:0.06em;margin-bottom:20px;">Footer Navigation</h2>

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
            @forelse($items['footer'] ?? [] as $item)
            <tr>
                <td>{{ $item->label }}</td>
                <td style="font-family:'JetBrains Mono',monospace;font-size:13px;color:oklch(0.65 0.02 272);">{{ $item->url }}</td>
                <td>{{ $item->parent_id ? 'Sub-item' : 'Main' }}</td>
                <td>{{ $item->order }}</td>
                <td class="actions">
                    <button onclick="editNavItem({{ $item->toJson() }})" class="btn btn-xs btn-edit" style="border:none;cursor:pointer;">Edit</button>
                    <form method="POST" action="{{ route('admin.navigation.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Delete this navigation item?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-delete" style="border:none;cursor:pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:oklch(0.65 0.02 272);">No footer navigation items yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Add New Form --}}
<div class="card">
    <h2 style="font-family:'JetBrains Mono',monospace;font-size:12px;text-transform:uppercase;color:oklch(0.65 0.02 272);letter-spacing:0.06em;margin-bottom:20px;">Add Navigation Item</h2>
    <form method="POST" action="{{ route('admin.navigation.store') }}">
        @csrf
        <div style="display:grid;grid-template-columns:2fr 3fr 1fr 1fr auto;gap:12px;align-items:end;">
            <div class="form-group" style="margin-bottom:0;">
                <label>Label</label>
                <input type="text" name="label" value="{{ old('label') }}" required placeholder="About Us">
                @error('label')<p style="color:oklch(0.72 0.17 25);font-size:12px;">{{ $message }}</p>@enderror
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label>URL</label>
                <input type="text" name="url" value="{{ old('url') }}" required placeholder="/about or https://...">
                @error('url')<p style="color:oklch(0.72 0.17 25);font-size:12px;">{{ $message }}</p>@enderror
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label>Location</label>
                <select name="location">
                    <option value="header">Header</option>
                    <option value="footer">Footer</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label>Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
        <div style="margin-top:12px;display:flex;gap:16px;">
            <label style="display:flex;align-items:center;gap:6px;font-size:14px;cursor:pointer;">
                <input type="checkbox" name="is_active" {{ old('is_active') ? 'checked' : '' }} style="width:auto;"> Active
            </label>
            <label style="display:flex;align-items:center;gap:6px;font-size:14px;cursor:pointer;">
                <input type="checkbox" name="target_blank" {{ old('target_blank') ? 'checked' : '' }} style="width:auto;"> Open in new tab
            </label>
        </div>
    </form>
</div>

{{-- Edit Modal --}}
<div id="edit-modal" style="display:none;position:fixed;inset:0;background:oklch(0 0 0 / 0.7);z-index:100;justify-content:center;align-items:center;">
    <div class="card" style="max-width:500px;width:90%;">
        <h2 style="margin-bottom:20px;">Edit Navigation Item</h2>
        <form id="edit-nav-form" method="POST">
            @csrf @method('PUT')
            <input type="hidden" name="id" id="edit-nav-id">
            <div class="form-group">
                <label>Label</label>
                <input type="text" name="label" id="edit-nav-label" required>
            </div>
            <div class="form-group">
                <label>URL</label>
                <input type="text" name="url" id="edit-nav-url" required>
            </div>
            <div class="form-group">
                <label>Location</label>
                <select name="location" id="edit-nav-location">
                    <option value="header">Header</option>
                    <option value="footer">Footer</option>
                </select>
            </div>
            <div class="form-group">
                <label>Order</label>
                <input type="number" name="order" id="edit-nav-order" min="0">
            </div>
            <div style="display:flex;gap:8px;margin-top:20px;">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" onclick="document.getElementById('edit-modal').style.display='none'" class="btn" style="background:oklch(0.28 0.025 272);color:oklch(0.96 0.005 272);">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function editNavItem(item) {
    document.getElementById('edit-nav-id').value = item.id;
    document.getElementById('edit-nav-label').value = item.label;
    document.getElementById('edit-nav-url').value = item.url;
    document.getElementById('edit-nav-location').value = item.location;
    document.getElementById('edit-nav-order').value = item.order;
    document.getElementById('edit-nav-form').action = '/admin/navigation/' + item.id;
    document.getElementById('edit-modal').style.display = 'flex';
}
</script>
@endsection
