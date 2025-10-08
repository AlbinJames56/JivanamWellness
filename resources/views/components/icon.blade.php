{{-- resources/views/components/icon.blade.php --}}
@php
  // usage: @include('components.icon', ['name' => 'calendar', 'class' => 'w-5 h-5'])
  $name = $name ?? '';
  $class = $class ?? '';
@endphp

@if ($name === 'calendar')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
    <rect x="3" y="5" width="18" height="16" rx="2" ry="2" stroke-width="1.5" />
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 3v4M8 3v4M3 11h18" />
  </svg>

@elseif ($name === 'arrow-right' || $name === 'arrow_right' || $name === 'arrowright')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
    <path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
  </svg>

@elseif ($name === 'alert-circle' || $name === 'alert_circle')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
    <circle cx="12" cy="12" r="10" stroke-width="1.5" />
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4M12 16h.01" />
  </svg>

@elseif ($name === 'target')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
    <circle cx="12" cy="12" r="7" stroke-width="1.5" />
    <circle cx="12" cy="12" r="4" stroke-width="1.5" />
    <circle cx="12" cy="12" r="1" fill="currentColor" />
  </svg>

@elseif ($name === 'zap')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
    <path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z" />
  </svg>

@elseif ($name === 'activity')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12h4l3 8 4-16 3 8h4" />
  </svg>

@elseif ($name === 'brain')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
    <path d="M12 2c3 0 6 2 6 5 0 2 1 2 1 4 0 2-1 3-2 4H7C6 16 5 15 5 13c0-2 1-2 1-4 0-3 3-5 6-5z" />
  </svg>

@elseif ($name === 'heart')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
    <path d="M12 21s-7-4.5-9-7.2C1.3 11.2 3 7 6 6c1.8-.6 4 0 6 2 2-2 4.2-2.6 6-2 3 1 4.7 5.2 3 7.8C19 16.5 12 21 12 21z" />
  </svg>

@elseif ($name === 'clock')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
    <circle cx="12" cy="12" r="9" stroke-width="1.5"></circle>
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 7v5l3 3" />
  </svg>

@elseif ($name === 'shield')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
    <path stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round" d="M12 2l8 4v6c0 5-3.6 9.7-8 10-4.4-.3-8-5-8-10V6l8-4z" />
  </svg>

@elseif ($name === 'stethoscope')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
    <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M4 7v6a8 8 0 0016 0V7" />
    <circle cx="20" cy="4" r="1.5" fill="currentColor" />
  </svg>

@elseif ($name === 'check-circle' || $name === 'check_circle')
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
    <path d="M12 2a10 10 0 110 20 10 10 0 010-20zm5 7l-6.5 6L7 11.5l1.4-1.4L10.5 12l5-5L17 9z"/>
  </svg>

@else
  {{-- fallback square --}}
  <svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
    <rect x="3" y="3" width="18" height="18" stroke-width="1.2" />
  </svg>
@endif
