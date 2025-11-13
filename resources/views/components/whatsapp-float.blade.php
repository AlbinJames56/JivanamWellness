{{-- resources/views/components/whatsapp-float.blade.php --}}
@php
    $waPhone = $phone ?? '918220503388';
    $prefill = $message ?? 'Hello! I would like to book a consultation.';
@endphp
<!-- Inline styles so they apply immediately where the component is included -->
<style>
    /* Container: fixed bottom-right, stacked vertically */
    .wa-fab {
        position: fixed;
        right: 1rem;
        bottom: 1.25rem;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        align-items: center;
        pointer-events: auto;
        -webkit-tap-highlight-color: transparent;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    /* Uniform button size */
    .wa-fab .wa-button,
    .wa-fab .small-btn {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: transform .12s ease, box-shadow .12s ease;
        box-shadow: 0 8px 18px rgba(2, 6, 23, 0.12);
        border: none;
        cursor: pointer;
    }

    /* WhatsApp button */
    .wa-fab .wa-button {
        background: linear-gradient(180deg, #29b858, #25D366);
        color: #fff;
    }

    /* Call button */
    .wa-fab .small-btn {
        background: #fff;
        color: #0f5132;
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .wa-fab .wa-button:hover,
    .wa-fab .small-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 26px rgba(2, 6, 23, 0.16);
    }

    .wa-fab i {
        font-size: 1.3rem;
        line-height: 1;
    }

    /* Hover label */
    .wa-label {
        position: absolute;
        right: calc(100% + 12px);
        background: #0f5132;
        color: #fff;
        padding: 0.35rem 0.7rem;
        border-radius: 9999px;
        font-size: 0.9rem;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: 0 8px 20px rgba(2, 6, 23, 0.12);
        opacity: 0;
        transform: translateX(6px);
        pointer-events: none;
        transition: opacity .15s ease, transform .15s ease;
    }

    /* Show text only on hover */
    .wa-fab:hover .wa-label {
        opacity: 1;
        transform: translateX(0);
    }

    /* Responsive adjustments */
    @media (max-width: 420px) {
        .wa-fab {
            right: 0.75rem;
            bottom: 0.9rem;
            gap: 0.4rem;
        }

        .wa-fab .wa-button,
        .wa-fab .small-btn {
            width: 52px;
            height: 52px;
        }

        .wa-label {
            display: none;
        }
    }

    /* show label on hover for desktop and always on >= 640px (configurable) */
    @media (min-width: 640px) {
        .wa-fab {
            gap: 0.6rem;
        }

        .wa-fab .wa-label {
            display: inline-flex;
        }

        /* position label to the left of the main button visually by absolute placement */
        .wa-fab .label-wrap {
            display: flex;
            align-items: center;
            gap: .5rem;
            position: relative;
        }

        .wa-fab .wa-label {
            position: absolute;
            right: calc(100% + 14px);
            opacity: .98;
            transform: translateX(6px);
            transition: transform .12s ease, opacity .12s ease;
        }

        .wa-fab:hover .wa-label {
            transform: translateX(0);
        }
    }

    /* keep it compact on very small screens */
    @media (max-width: 420px) {
        .wa-fab {
            right: 0.5rem;
            bottom: 0.9rem;
            gap: 0.45rem;
        }

        .wa-fab .wa-button {
            width: 56px;
            height: 56px;
            font-size: 1.1rem;
        }

        .wa-fab .small-btn {
            width: 44px;
            height: 44px;
        }

        .wa-fab .wa-label {
            display: none;
        }
    }
</style>

<div id="whatsapp-fab" class="wa-fab" aria-hidden="false" role="region" aria-label="Chat and contact">


    <!-- main WhatsApp button -->
    <button type="button" id="wa-btn" class="wa-button" aria-label="Open WhatsApp chat" title="WhatsApp"
       onclick="openWhatsAppEncoded(event, '{{ $waPhone }}', '{{ $prefill }}')">
        <i class="fa-brands fa-whatsapp  l" aria-hidden="true" style="color: inherit; font-size:2rem;"></i>
    </button>

    <!-- optional quick-call button -->
    <a href="tel:+{{ $waPhone }}" class="small-btn" aria-label="Call us" title="Call us">
        <i class="fa-solid fa-phone" aria-hidden="true" style="color: inherit;"></i>
    </a>
</div>

<script>
  function openWhatsAppEncoded(e, phone, preEncodedPrefill) {
    if (e) e.preventDefault();
    phone = ('' + phone).replace(/\D+/g, '');
    var isMobile = /Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent);
    // DO NOT call encodeURIComponent(preEncodedPrefill) here — it's already encoded
    var url = isMobile
        ? 'whatsapp://send?phone=' + encodeURIComponent(phone) + '&text=' + preEncodedPrefill
        : 'https://wa.me/' + encodeURIComponent(phone) + '?text=' + preEncodedPrefill;
    window.open(url, '_blank', 'noopener,noreferrer');
}
    // Move the fab to body to avoid being clipped by transformed ancestors
    (function ensureFabInBody() {
        try {
            var node = document.getElementById('whatsapp-fab');
            if (node && node.parentElement !== document.body) {
                document.body.appendChild(node);
            }
        } catch (e) {
            console.debug('wa-fab move error', e);
        }
    })();
</script>