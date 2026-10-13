<!-- Sky Web Innovations Logo -->
<svg viewBox="0 0 220 44" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes?->merge(['class' => ($attributes->get('class') ?? '') . ' swi-logo']) }}>
    <!-- Abstract web node mark -->
    <g transform="translate(4, 4)">
        <!-- Center node -->
        <circle cx="18" cy="18" r="4" fill="currentColor" opacity="0.95"/>
        <!-- Orbiting nodes -->
        <circle cx="4" cy="8" r="2.5" fill="currentColor" opacity="0.7"/>
        <circle cx="32" cy="8" r="2.5" fill="currentColor" opacity="0.7"/>
        <circle cx="4" cy="28" r="2.5" fill="currentColor" opacity="0.7"/>
        <circle cx="32" cy="28" r="2.5" fill="currentColor" opacity="0.7"/>
        <!-- Connecting lines -->
        <line x1="7" y1="10" x2="14" y2="15" stroke="currentColor" stroke-width="1.2" opacity="0.5"/>
        <line x1="29" y1="10" x2="22" y2="15" stroke="currentColor" stroke-width="1.2" opacity="0.5"/>
        <line x1="7" y1="26" x2="14" y2="21" stroke="currentColor" stroke-width="1.2" opacity="0.5"/>
        <line x1="29" y1="26" x2="22" y2="21" stroke="currentColor" stroke-width="1.2" opacity="0.5"/>
        <line x1="14" y1="15" x2="22" y2="21" stroke="currentColor" stroke-width="1" opacity="0.35"/>
        <line x1="14" y1="15" x2="14" y2="21" stroke="currentColor" stroke-width="1" opacity="0.35"/>
        <line x1="22" y1="15" x2="22" y2="21" stroke="currentColor" stroke-width="1" opacity="0.35"/>
    </g>
    <!-- Wordmark -->
    <text x="46" y="26" font-family="'Geist', 'Inter', system-ui, sans-serif" font-size="17" font-weight="700" letter-spacing="-0.02em" fill="currentColor">Sky Web</text>
    <text x="46" y="39" font-family="'Geist', 'Inter', system-ui, sans-serif" font-size="10" font-weight="500" letter-spacing="0.18em" fill="currentColor" opacity="0.55">INNOVATIONS</text>
</svg>
