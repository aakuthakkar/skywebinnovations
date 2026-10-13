// Hero stage autoplay
const stages = ['Wireframe', 'Design', 'Code', 'Shipped'];
let currentStage = 0;
const stageText = document.getElementById('hero-stage-text');
const stageDots = document.getElementById('hero-stage-dots');

function updateStage() {
  if (stageText) stageText.textContent = stages[currentStage];
  if (stageDots) {
    const dots = stageDots.querySelectorAll('span');
    dots.forEach((dot, i) => {
      dot.style.background = i <= currentStage ? '#fff' : 'oklch(1 0 0 / 0.3)';
    });
  }
  currentStage = (currentStage + 1) % stages.length;
}

if (stageText) {
  setInterval(updateStage, 2400);
  updateStage();
}

// Scroll reveal - IntersectionObserver
function setupReveal() {
  if (!('IntersectionObserver' in window)) return;
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('[data-reveal]').forEach(el => {
    if (el.getBoundingClientRect().top < window.innerHeight) {
      el.classList.add('revealed');
    } else {
      observer.observe(el);
    }
  });
}

// About section word lighting
function updateLit() {
  const aboutText = document.getElementById('about-text');
  if (!aboutText) return;
  const text = aboutText.textContent || '';
  const words = text.split(' ');
  aboutText.innerHTML = words.map((word, i) => {
    const r = aboutText.getBoundingClientRect();
    const vh = window.innerHeight;
    const p = Math.max(0, Math.min(1, (vh * 0.9 - r.top) / (r.height * 0.75)));
    const lit = Math.round(p * words.length);
    const opacity = i < lit ? 1 : 0.18;
    const isLast = i >= words.length - 5;
    const color = (i < lit && isLast) ? 'oklch(0.8 0.11 273)' : 'oklch(0.96 0.005 272)';
    return `<span style="opacity:${opacity}; color:${color}; transition:opacity .35s, color .35s;">${word}</span>`;
  }).join(' ');
}

// Work carousel scroll
function scrollWork(dir) {
  const carousel = document.getElementById('work-carousel');
  if (!carousel) return;
  const card = carousel.querySelector('article');
  const cardWidth = card ? card.offsetWidth : 600;
  carousel.scrollBy({ left: dir * (cardWidth + 24), behavior: 'smooth' });
}

// FAQ accordion
function toggleFaq(btn) {
  const answer = btn.nextElementSibling;
  const icon = btn.querySelector('.faq-icon');
  const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';

  if (isOpen) {
    answer.style.maxHeight = '0px';
    answer.style.paddingTop = '0';
    icon.style.transform = 'rotate(0deg)';
    icon.textContent = '+';
  } else {
    answer.style.maxHeight = answer.scrollHeight + 'px';
    answer.style.paddingTop = '16px';
    icon.style.transform = 'rotate(45deg)';
    icon.textContent = '+';
  }
}

// Contact form - type selection
function selectType(btn, type) {
  document.querySelectorAll('.type-btn').forEach(b => {
    b.style.background = 'transparent';
    b.style.color = 'oklch(0.96 0.005 272)';
    b.style.borderColor = 'oklch(0.36 0.03 272)';
  });
  btn.style.background = 'oklch(0.62 0.19 273)';
  btn.style.color = '#fff';
  btn.style.borderColor = 'oklch(0.62 0.19 273)';
  document.getElementById('project_type').value = type;
}

// (Budget field removed — kept only as a no-op for backward compat)
function selectBudget() {}

// Mobile nav toggle
function setupMobileNav() {
  const toggle = document.getElementById('nav-toggle');
  const links = document.getElementById('nav-links');
  if (toggle && links) {
    toggle.style.display = 'none';
    const mq = window.matchMedia('(max-width: 960px)');
    function check(e) {
      if (e.matches) {
        toggle.style.display = 'block';
      } else {
        toggle.style.display = 'none';
        links.classList.remove('show-mobile');
        links.classList.remove('hidden-mobile');
      }
    }
    mq.addEventListener('change', check);
    check(mq);
    toggle.addEventListener('click', () => {
      links.classList.toggle('show-mobile');
    });
  }
}

// Timezone clocks
function updateClocks() {
  document.querySelectorAll('.tz-time').forEach(el => {
    try {
      const time = new Date().toLocaleTimeString('en-US', {
        timeZone: el.dataset.tz,
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
      });
      el.textContent = time;
    } catch (e) {
      el.textContent = '--:--';
    }
  });
}

// =============================================
// Contact Form - handled inline in blade template
// to avoid Vite cache issues with form AJAX
// =============================================

// Initialize
document.addEventListener('DOMContentLoaded', () => {
  setupReveal();
  setupMobileNav();
  updateClocks();
  setInterval(updateClocks, 30000);
  updateLit();

  // Select first type by default
  const firstType = document.querySelector('.type-btn');
  if (firstType) selectType(firstType, firstType.dataset.type);

  // Scroll handler for word lighting
  let raf;
  window.addEventListener('scroll', () => {
    if (raf) return;
    raf = requestAnimationFrame(() => {
      raf = null;
      updateLit();
    });
  }, { passive: true });
});
