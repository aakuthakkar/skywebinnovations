<section id="contact" aria-labelledby="contact-h" style="position:relative; padding:clamp(100px,12vw,160px) clamp(20px,4vw,48px); background:radial-gradient(70% 60% at 20% 0%, oklch(0.62 0.19 273 / 0.28), transparent 70%), oklch(0.12 0.02 272); border-top:1px solid oklch(0.26 0.025 272);">
  <div style="max-width:1320px; margin:0 auto;">
    <p style="margin:0 0 28px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.8 0.015 272);">07 — Start a project</p>
    <h2 id="contact-h" style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(52px,9vw,150px); line-height:0.88; letter-spacing:-0.055em; text-wrap:balance;">Let's build <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; letter-spacing:-0.025em; color:oklch(0.8 0.11 273);">something great.</span></h2>
    <div style="margin-top:clamp(48px,6vw,80px); display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 380px), 1fr)); gap:clamp(32px,5vw,72px); align-items:start;">
      <div style="display:flex; flex-direction:column; gap:28px;">
        <p style="margin:0; max-width:440px; font-size:18px; line-height:1.6; color:oklch(0.82 0.015 272);">Tell us what you want to build. You'll get a reply within one business day with next steps and a ballpark estimate.</p>
        <div style="display:grid; border-top:1px solid oklch(0.3 0.025 272);">
          <a href="mailto:{{ $settings['contact_email'] ?? 'info@skywebinnovations.com' }}" style="display:grid; grid-template-columns:100px 1fr auto; gap:16px; padding:20px 0; border-bottom:1px solid oklch(0.3 0.025 272); font-size:clamp(17px,1.6vw,22px); font-family:'Bricolage Grotesque'; letter-spacing:-0.01em;" onmouseover="this.style.color='oklch(0.8 0.11 273)'" onmouseout="this.style.color=''"><span style="font-family:'JetBrains Mono'; font-size:12px; color:oklch(0.65 0.02 272); padding-top:6px;">EMAIL</span>{{ $settings['contact_email'] ?? 'info@skywebinnovations.com' }}<span>↗</span></a>
          <a href="tel:{{ $settings['contact_phone_raw'] ?? '+917990903773' }}" style="display:grid; grid-template-columns:100px 1fr auto; gap:16px; padding:20px 0; border-bottom:1px solid oklch(0.3 0.025 272); font-size:clamp(17px,1.6vw,22px); font-family:'Bricolage Grotesque';" onmouseover="this.style.color='oklch(0.8 0.11 273)'" onmouseout="this.style.color=''"><span style="font-family:'JetBrains Mono'; font-size:12px; color:oklch(0.65 0.02 272); padding-top:6px;">PHONE</span>{{ $settings['contact_phone'] ?? '+91 79909 03773' }}<span>↗</span></a>
          <a href="{{ $settings['whatsapp_url'] ?? 'https://wa.me/917990903773' }}" target="_blank" rel="noopener" style="display:grid; grid-template-columns:100px 1fr auto; gap:16px; padding:20px 0; border-bottom:1px solid oklch(0.3 0.025 272); font-size:clamp(17px,1.6vw,22px); font-family:'Bricolage Grotesque';" onmouseover="this.style.color='oklch(0.8 0.11 273)'" onmouseout="this.style.color=''"><span style="font-family:'JetBrains Mono'; font-size:12px; color:oklch(0.65 0.02 272); padding-top:6px;">WHATSAPP</span>Chat with us<span>↗</span></a>
        </div>
      </div>
      <div id="contact-form-container" style="border-radius:24px; background:oklch(0.18 0.025 272 / 0.9); border:1px solid oklch(0.3 0.03 272); padding:clamp(24px,3vw,40px); backdrop-filter:blur(10px);">
        <!-- Form State: Default (Form) -->
        <div id="contact-form-state">
          <form id="contact-form" method="POST" action="{{ route('contact.submit') }}" style="display:flex; flex-direction:column; gap:24px;" data-support-email="{{ $settings['contact_email'] ?? 'info@skywebinnovations.com' }}">
            @csrf
            <fieldset style="border:0; margin:0; padding:0;">
              <legend style="font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272); margin-bottom:12px;">What are we building?</legend>
              <div style="display:flex; flex-wrap:wrap; gap:8px;" id="type-selector">
                @foreach(['Website','Web app','SaaS product','UI/UX','Other'] as $type)
                <button type="button" data-type="{{ $type }}" onclick="selectType(this, '{{ $type }}')" class="type-btn" style="cursor:pointer; padding:9px 14px; border-radius:999px; border:1px solid oklch(0.36 0.03 272); background:transparent; color:oklch(0.96 0.005 272); font-size:14px; white-space:nowrap;">{{ $type }}</button>
                @endforeach
              </div>
              <input type="hidden" name="project_type" id="project_type" value="Website">
              <p id="type-error" style="color:oklch(0.72 0.17 25); font-size:12px; margin-top:6px; display:none;"></p>
            </fieldset>
            <!-- Honeypot: hidden from real users, visible to bots -->
            <div style="position:absolute; left:-9999px; top:auto; width:1px; height:1px; overflow:hidden;" aria-hidden="true">
              <label>Website (leave blank)<input type="text" name="website_url" value="" tabindex="-1" autocomplete="off"></label>
              <input type="hidden" name="honeypot_time" value="{{ time() }}">
            </div>
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:12px;">
              <div>
                <label style="display:block; margin-bottom:6px; font-size:13px; color:oklch(0.75 0.015 272);">Name <span style="color:oklch(0.72 0.17 25);">*</span></label>
                <input required name="name" autocomplete="name" id="contact-name" style="padding:14px; border-radius:12px; border:1px solid oklch(0.34 0.03 272); background:oklch(0.14 0.02 272); font-size:15px; color:oklch(0.96 0.005 272); outline:none; width:100%; transition:border-color .2s;" onfocus="this.style.borderColor='oklch(0.7 0.14 273)'" onblur="this.style.borderColor='oklch(0.34 0.03 272)'" placeholder="Your name">
                <p id="name-error" style="color:oklch(0.72 0.17 25); font-size:12px; margin-top:4px; display:none;"></p>
              </div>
              <div>
                <label style="display:block; margin-bottom:6px; font-size:13px; color:oklch(0.75 0.015 272);">Work email <span style="color:oklch(0.72 0.17 25);">*</span></label>
                <input required type="email" name="email" autocomplete="email" id="contact-email" style="padding:14px; border-radius:12px; border:1px solid oklch(0.34 0.03 272); background:oklch(0.14 0.02 272); font-size:15px; color:oklch(0.96 0.005 272); outline:none; width:100%; transition:border-color .2s;" onfocus="this.style.borderColor='oklch(0.7 0.14 273)'" onblur="this.style.borderColor='oklch(0.34 0.03 272)'" placeholder="you@company.com">
                <p id="email-error" style="color:oklch(0.72 0.17 25); font-size:12px; margin-top:4px; display:none;"></p>
              </div>
            </div>
            <div>
              <label style="display:block; margin-bottom:6px; font-size:13px; color:oklch(0.75 0.015 272);">Tell us about the project <span style="color:oklch(0.72 0.17 25);">*</span></label>
              <textarea name="message" rows="4" id="contact-message" style="padding:14px; border-radius:12px; border:1px solid oklch(0.34 0.03 272); background:oklch(0.14 0.02 272); font-size:15px; color:oklch(0.96 0.005 272); resize:vertical; outline:none; width:100%; transition:border-color .2s;" onfocus="this.style.borderColor='oklch(0.7 0.14 273)'" onblur="this.style.borderColor='oklch(0.34 0.03 272)'" placeholder="Describe your project, goals, and timeline..."></textarea>
              <p id="message-error" style="color:oklch(0.72 0.17 25); font-size:12px; margin-top:4px; display:none;"></p>
            </div>
            <div id="contact-general-error" style="display:none; padding:12px 16px; border-radius:10px; background:oklch(0.72 0.17 25 / 0.12); border:1px solid oklch(0.72 0.17 25 / 0.3); color:oklch(0.85 0.15 25); font-size:14px;"></div>
            <button type="submit" id="contact-submit-btn" style="cursor:pointer; border:0; padding:18px 24px; border-radius:999px; background:var(--acc, oklch(0.62 0.19 273)); color:#fff; font-size:15px; font-weight:500; display:flex; justify-content:space-between; align-items:center; transition:all .2s;">
              <span id="btn-text">Send project brief <span style="font-family:'JetBrains Mono';">→</span></span>
              <span id="btn-loader" style="display:none;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="animation:swi-spin .8s linear infinite;"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
              </span>
            </button>
          </form>
        </div>
        <!-- Form State: Success -->
        <div id="contact-success-state" style="display:none; min-height:420px; flex-direction:column; justify-content:center; gap:18px;">
          <span style="width:56px; height:56px; border-radius:50%; background:oklch(0.72 0.17 150); color:oklch(0.16 0.02 272); display:grid; place-items:center; font-size:24px; font-weight:700;">✓</span>
          <h3 style="margin:0; font-family:'Bricolage Grotesque'; font-size:38px; font-weight:600; letter-spacing:-0.03em;">Brief received.</h3>
          <p style="margin:0; font-size:16px; line-height:1.55; color:oklch(0.78 0.015 272);" id="success-message"></p>
          <button type="button" id="reset-form-btn" style="align-self:flex-start; cursor:pointer; border:1px solid oklch(0.36 0.03 272); background:transparent; color:#fff; padding:10px 20px; border-radius:999px; font-size:14px; transition:all .2s;" onmouseover="this.style.borderColor='oklch(0.8 0.015 272)'" onmouseout="this.style.borderColor='oklch(0.36 0.03 272)'">Send another brief</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Inline AJAX handler + spam protection -->
  <script>
  (function() {
    'use strict';

    var form = document.getElementById('contact-form');
    if (!form) return;

    var csrfToken = form.querySelector('input[name="_token"]');
    if (!csrfToken) return;

    var formState = document.getElementById('contact-form-state');
    var successState = document.getElementById('contact-success-state');
    var successMsg = document.getElementById('success-message');
    var submitBtn = document.getElementById('contact-submit-btn');
    var btnText = document.getElementById('btn-text');
    var btnLoader = document.getElementById('btn-loader');
    var resetBtn = document.getElementById('reset-form-btn');
    var generalError = document.getElementById('contact-general-error');
    var container = document.getElementById('contact-form-container');
    var honeypotTimeInput = form.querySelector('input[name="honeypot_time"]');
    var pageLoadTime = honeypotTimeInput ? parseInt(honeypotTimeInput.value, 10) : Math.floor(Date.now() / 1000);

    // Email regex — strict but compatible with real-world addresses
    var emailPattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/;

    function showError(fieldId, msg) {
      var el = document.getElementById(fieldId + '-error');
      var input = document.getElementById(fieldId);
      if (el) { el.textContent = msg; el.style.display = msg ? 'block' : 'none'; }
      if (input) { input.style.borderColor = msg ? 'oklch(0.72 0.17 25)' : 'oklch(0.34 0.03 272)'; }
    }

    function clearErrors() {
      ['name', 'email', 'message', 'project_type'].forEach(function(id) {
        var errEl = document.getElementById(id + '-error');
        if (errEl) { errEl.textContent = ''; errEl.style.display = 'none'; }
      });
      if (generalError) { generalError.style.display = 'none'; generalError.textContent = ''; }
      ['contact-name', 'contact-email', 'contact-message'].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.style.borderColor = 'oklch(0.34 0.03 272)';
      });
    }

    function setLoading(on) {
      submitBtn.disabled = on;
      submitBtn.style.opacity = on ? '0.7' : '1';
      submitBtn.style.cursor = on ? 'not-allowed' : 'pointer';
      if (btnText) btnText.style.display = on ? 'none' : 'inline';
      if (btnLoader) btnLoader.style.display = on ? 'inline-flex' : 'none';
    }

    function showSuccess(message) {
      if (formState) formState.style.display = 'none';
      if (successState) successState.style.display = 'flex';
      if (successMsg) successMsg.textContent = message;
      var rect = container ? container.getBoundingClientRect() : null;
      if (rect) {
        var scrollTarget = rect.top + window.pageYOffset - 80;
        window.scrollTo({ top: scrollTarget, behavior: 'smooth' });
      }
    }

    function showFormAgain() {
      if (formState) formState.style.display = 'flex';
      if (successState) successState.style.display = 'none';
      form.reset();
      clearErrors();
      setLoading(false);
      var firstType = document.querySelector('.type-btn');
      if (firstType) { firstType.style.background = 'oklch(0.62 0.19 273)'; firstType.style.color = '#fff'; firstType.style.borderColor = 'oklch(0.62 0.19 273)'; }
      document.getElementById('project_type').value = 'Website';
      var rect = container ? container.getBoundingClientRect() : null;
      if (rect) {
        var scrollTarget = rect.top + window.pageYOffset - 80;
        window.scrollTo({ top: scrollTarget, behavior: 'smooth' });
      }
    }

    if (resetBtn) resetBtn.addEventListener('click', showFormAgain);

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      e.stopPropagation();
      clearErrors();

      // Frontend validation
      var nameVal = document.getElementById('contact-name').value.trim();
      var emailVal = document.getElementById('contact-email').value.trim();
      var messageVal = document.getElementById('contact-message').value.trim();
      var hasError = false;

      if (!nameVal || nameVal.length < 2) {
        showError('contact-name', 'Please enter your name.');
        hasError = true;
      }

      if (!emailVal) {
        showError('contact-email', 'Please enter your email address.');
        hasError = true;
      } else if (!emailPattern.test(emailVal)) {
        showError('contact-email', 'Please enter a valid email address (e.g. name@company.com).');
        hasError = true;
      }

      if (!messageVal || messageVal.length < 10) {
        showError('contact-message', 'Please tell us about your project (at least 10 characters).');
        hasError = true;
      } else if (messageVal.length > 5000) {
        showError('contact-message', 'Your message is too long. Please keep it under 5,000 characters.');
        hasError = true;
      }

      // Time-based check
      var now = Math.floor(Date.now() / 1000);
      var timeDiff = now - pageLoadTime;
      if (timeDiff < 3) {
        if (generalError) {
          generalError.textContent = 'Please take a moment to fill in the form.';
          generalError.style.display = 'block';
        }
        hasError = true;
      }

      if (hasError) return;

      setLoading(true);

      var formData = new FormData(form);
      formData.append('_token', csrfToken.value);

      fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        credentials: 'same-origin',
      })
      .then(function(res) { return res.json().then(function(data) { return { ok: res.ok, data: data }; }); })
      .then(function(result) {
        if (result.ok && result.data.success) {
          showSuccess(result.data.message || "Brief received. We'll review your project brief and reply within one business day.");
        } else {
          setLoading(false);
          if (result.data.errors) {
            Object.keys(result.data.errors).forEach(function(field) {
              var msg = Array.isArray(result.data.errors[field]) ? result.data.errors[field][0] : result.data.errors[field];
              showError(field, msg);
            });
          }
          if (result.data.message && !result.data.errors && generalError) {
            generalError.textContent = result.data.message;
            generalError.style.display = 'block';
          }
        }
      })
      .catch(function() {
        setLoading(false);
        if (generalError) {
          generalError.textContent = 'Something went wrong. Please try again or email us at ' + (form.dataset.supportEmail || 'info@skywebinnovations.com') + '.';
          generalError.style.display = 'block';
        }
      });
    });

    // Real-time field clearing
    ['contact-name', 'contact-email', 'contact-message'].forEach(function(id) {
      var el = document.getElementById(id);
      if (!el) return;
      el.addEventListener('input', function() { showError(id, ''); });
    });
  })();
  </script>
</section>
