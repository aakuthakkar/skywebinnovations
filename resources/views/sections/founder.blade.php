<section id="founder" aria-labelledby="founder-h" style="background:oklch(0.96 0.008 85); color:oklch(0.18 0.02 272);">
  <div style="max-width:1240px; margin:0 auto; padding:clamp(100px,12vw,150px) clamp(20px,4vw,48px); display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 360px), 1fr)); gap:clamp(40px,7vw,110px); align-items:center;">
    <div data-reveal style="position:relative; max-width:420px; width:100%; justify-self:center;">
      <div style="aspect-ratio:4/5; border-radius:26px; overflow:hidden; background:oklch(0.9 0.01 85); box-shadow:0 40px 80px -40px oklch(0.2 0.03 272 / 0.45);">
        <div style="width:100%; height:100%; filter:grayscale(1) contrast(1.06); transform:scale(1); transition:filter .9s cubic-bezier(.2,.7,.2,1), transform 1.4s cubic-bezier(.2,.7,.2,1);" onmouseover="this.style.filter='grayscale(0) contrast(1)';this.style.transform='scale(1.035)'" onmouseout="this.style.filter='grayscale(1) contrast(1.06)';this.style.transform='scale(1)'">
          <img src="{{ asset('assets/founder.jpeg') }}" alt="{{ $settings['founder_name'] ?? 'Aakash Thakkar' }}" style="width:100%; height:100%; object-fit:cover; display:block;" loading="lazy" decoding="async">
        </div>
      </div>
      <div style="position:absolute; right:-14px; bottom:32px; padding:12px 16px; border-radius:14px; background:oklch(0.16 0.02 272); color:#fff; font-family:'JetBrains Mono'; font-size:12px; line-height:1.5; box-shadow:0 20px 40px -16px oklch(0 0 0 / 0.45); pointer-events:none;"><span style="color:oklch(0.72 0.02 272);">$ whoami</span><br>aakash.thakkar</div>
    </div>
    <div data-reveal style="min-width:0;">
      <p style="margin:0 0 22px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.42 0.02 272);">02 — Meet the founder</p>
      <h2 id="founder-h" style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(34px,3.8vw,56px); line-height:1; letter-spacing:-0.04em;">Meet the <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; color:oklch(0.48 0.18 273);">Founder</span></h2>
      <div style="margin-top:28px; display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
        <h3 style="margin:0; font-family:'Instrument Serif'; font-style:italic; font-weight:400; font-size:clamp(28px,2.6vw,36px); line-height:1;">{{ $settings['founder_name'] ?? 'Aakash Thakkar' }}</h3>
        <span style="padding:6px 12px; border-radius:999px; background:oklch(0.16 0.02 272); color:#fff; font-family:'JetBrains Mono'; font-size:12px; white-space:nowrap;">{{ $settings['founder_title'] ?? 'Founder &amp; Technology Lead' }}</span>
      </div>
      <div style="margin-top:24px; max-width:580px; display:grid; gap:14px; font-size:16px; line-height:1.7; color:oklch(0.36 0.02 272); text-wrap:pretty;">
        <p style="margin:0;">Aakash leads Sky Web Innovations and works directly with clients on product strategy, architecture, and delivery.</p>
        <p style="margin:0;">With experience across web development and project coordination, he works closely with clients and teams to turn business ideas into practical and scalable digital solutions.</p>
        <p style="margin:0;">From the initial discussion and technical planning to development, launch, and ongoing support, Aakash remains directly involved throughout the project.</p>
      </div>
      <blockquote style="margin:32px 0 0; padding:24px 0 0; border-top:1px solid oklch(0.86 0.01 85); max-width:560px;">
        <p style="margin:0; font-family:'Instrument Serif'; font-weight:400; font-size:clamp(22px,2vw,28px); line-height:1.25; letter-spacing:-0.005em; color:oklch(0.22 0.02 272); text-wrap:pretty;">{{ $settings['founder_quote'] ?? '"Every project starts with a conversation about the business. Then we build the technology that serves it."' }}</p>
      </blockquote>
      <div style="margin-top:28px; display:flex; flex-wrap:wrap; gap:10px;">
        <a href="{{ $settings['linkedin_url'] ?? 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/' }}" target="_blank" rel="noopener" style="display:flex; align-items:center; gap:12px; padding:12px 18px; border-radius:999px; border:1px solid oklch(0.82 0.01 85); font-size:14px; white-space:nowrap; transition:all .2s;" onmouseover="this.style.background='oklch(0.16 0.02 272)';this.style.color='#fff';this.style.borderColor='oklch(0.16 0.02 272)'" onmouseout="this.style.background='';this.style.color='';this.style.borderColor='oklch(0.82 0.01 85)'"><span style="font-family:'JetBrains Mono'; font-size:11px; opacity:0.7;">IN</span>LinkedIn ↗</a>
        <a href="mailto:{{ $settings['contact_email'] ?? 'info@skywebinnovations.com' }}" style="display:flex; align-items:center; gap:12px; padding:12px 18px; border-radius:999px; border:1px solid oklch(0.82 0.01 85); font-size:14px; white-space:nowrap; transition:all .2s;" onmouseover="this.style.background='oklch(0.16 0.02 272)';this.style.color='#fff';this.style.borderColor='oklch(0.16 0.02 272)'" onmouseout="this.style.background='';this.style.color='';this.style.borderColor='oklch(0.82 0.01 85)'"><span style="font-family:'JetBrains Mono'; font-size:11px; opacity:0.7;">@</span>Email ↗</a>
        <a href="{{ $settings['whatsapp_url'] ?? 'https://wa.me/917990903773' }}" target="_blank" rel="noopener" style="display:flex; align-items:center; gap:12px; padding:12px 18px; border-radius:999px; border:1px solid oklch(0.82 0.01 85); font-size:14px; white-space:nowrap; transition:all .2s;" onmouseover="this.style.background='oklch(0.16 0.02 272)';this.style.color='#fff';this.style.borderColor='oklch(0.16 0.02 272)'" onmouseout="this.style.background='';this.style.color='';this.style.borderColor='oklch(0.82 0.01 85)'"><span style="font-family:'JetBrains Mono'; font-size:11px; opacity:0.7;">WA</span>WhatsApp ↗</a>
      </div>
    </div>
  </div>
</section>
