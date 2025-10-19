// تغيير شفافية الهيدر عند التمرير
const header = document.querySelector('.fc-header');
window.addEventListener('scroll', () => {
  const scrolled = window.scrollY > 20;
  header.style.background = scrolled ? 'rgba(11,16,36,0.95)' : 'rgba(11,16,36,0.85)';
});

// سلاسة التنقل للروابط الداخلية
document.querySelectorAll('a[href^="#"]').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(link.getAttribute('href'));
    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
});

// تحسين نموذج الطلب: مؤشر تحميل + رسالة تأكيد
document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('.fc-form');
  const submitBtn = document.getElementById('submitBtn');
  const btnText = submitBtn?.querySelector('.btn-text');
  const btnLoader = submitBtn?.querySelector('.btn-loader');

  if (form && submitBtn) {
    form.addEventListener('submit', function () {
      submitBtn.disabled = true;
      if (btnText && btnLoader) {
        btnText.style.display = 'none';
        btnLoader.style.display = 'inline';
      } else {
        submitBtn.innerText = '... جاري الإرسال';
        submitBtn.style.opacity = '0.6';
      }
    });
  }
});



document.addEventListener('DOMContentLoaded', function () {
  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const nav = document.querySelector('.fc-nav');

  if (hamburgerBtn && nav) {
    hamburgerBtn.addEventListener('click', () => {
      nav.classList.toggle('active');
    });
  }
});
