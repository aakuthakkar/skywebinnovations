@extends('admin.layouts.app')
@section('title', 'Settings')
@section('content')
<div class="page-header">
  <h1>Settings</h1>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}">
  @csrf
  @method('PUT')

  @php $globalIdx = 0; @endphp
  @foreach($settings as $type => $group)
  <div class="card" style="margin-bottom:24px;">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 20px; text-transform:capitalize;">{{ $type }}</h2>
    @foreach($group as $setting)
    <div class="form-group">
      <label>{{ $setting->label ?? Str::of($setting->key)->replace('_', ' ')->title() }}</label>
      @php $val = (string) ($setting->value ?? ''); @endphp
      @if(str_contains($setting->key, 'color') || str_contains($setting->key, 'background') || str_contains($setting->key, 'bg_'))
        <input type="color" name="settings[{{ $globalIdx }}][value]" value="{{ $val }}" style="height:44px; padding:4px 8px;">
        <input type="hidden" name="settings[{{ $globalIdx }}][key]" value="{{ $setting->key }}">
        <input type="hidden" name="settings[{{ $globalIdx }}][type]" value="{{ $setting->type }}">
      @elseif(str_contains($val, "\n") || strlen($val) > 100)
        <textarea name="settings[{{ $globalIdx }}][value]">{{ $setting->value }}</textarea>
        <input type="hidden" name="settings[{{ $globalIdx }}][key]" value="{{ $setting->key }}">
        <input type="hidden" name="settings[{{ $globalIdx }}][type]" value="{{ $setting->type }}">
      @else
        <input type="text" name="settings[{{ $globalIdx }}][value]" value="{{ $setting->value }}">
        <input type="hidden" name="settings[{{ $globalIdx }}][key]" value="{{ $setting->key }}">
        <input type="hidden" name="settings[{{ $globalIdx }}][type]" value="{{ $setting->type }}">
      @endif
    </div>
    @php $globalIdx++; @endphp
    @endforeach
  </div>
  @endforeach

  <!-- Menu Labels Section -->
  @php $menuLabelKeys = [
      'dashboard' => 'Dashboard',
      'services' => 'Services',
      'projects' => 'Projects',
      'why_us' => 'Why Us',
      'process' => 'Process',
      'engagement' => 'Engagement',
      'faq' => 'FAQ',
      'tech_stack' => 'Tech Stack',
      'inquiries' => 'Inquiries',
  ]; @endphp
  <div class="card" style="margin-bottom:24px;">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 20px; text-transform:capitalize;">Menu Labels</h2>
    <p style="font-size:13px; color:oklch(0.62 0.015 272); margin-bottom:20px;">Customize the text shown in the admin sidebar navigation.</p>
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:16px;">
      @foreach($menuLabelKeys as $key => $default)
      @php
          $current = $menuLabels[$key] ?? $default;
          $settingKey = 'menu_' . $key;
      @endphp
      <div class="form-group">
        <label style="font-size:12px; text-transform:capitalize;">{{ $default }} label</label>
        <input type="hidden" name="settings[{{ $globalIdx }}][key]" value="{{ $settingKey }}">
        <input type="hidden" name="settings[{{ $globalIdx }}][type]" value="text">
        <input type="text" name="settings[{{ $globalIdx }}][value]" value="{{ $current }}">
      </div>
      @php $globalIdx++; @endphp
      @endforeach
    </div>
  </div>

  <div style="display:flex; gap:12px;">
    <button type="submit" class="btn btn-primary">Save Settings</button>
  </div>
</form>
@endsection
