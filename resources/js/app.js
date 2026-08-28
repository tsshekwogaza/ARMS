// Minimal Interactivity Script
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('main-content');
  const toggleBtn = document.getElementById('sidebar-toggle');
  const toggleIcon = document.getElementById('toggle-icon');
  const navTexts = document.querySelectorAll('.nav-text');

  let isCollapsed = false;

  function toggleSidebar() {
    isCollapsed = !isCollapsed;

    if (isCollapsed) {
      // Collapse Sidebar to 80px
      sidebar.classList.remove('w-[280px]');
      sidebar.classList.add('w-[80px]');
      mainContent.classList.remove('lg:pl-[280px]');
      mainContent.classList.add('lg:pl-[80px]');
      toggleIcon.classList.add('rotate-180');

      // Hide text labels smoothly
      navTexts.forEach(el => {
        el.classList.add('opacity-0', 'pointer-events-none', 'hidden');
      });
    } else {
      // Expand Sidebar to 280px
      sidebar.classList.remove('w-[80px]');
      sidebar.classList.add('w-[280px]');
      mainContent.classList.remove('lg:pl-[80px]');
      mainContent.classList.add('lg:pl-[280px]');
      toggleIcon.classList.remove('rotate-180');

      // Show text labels
      navTexts.forEach(el => {
        el.classList.remove('opacity-0', 'pointer-events-none', 'hidden');
      });
    }
  }

  toggleBtn.addEventListener('click', toggleSidebar);

  // Keyboard Shortcut (Ctrl + B)
  document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'b') {
      e.preventDefault();
      toggleSidebar();
    }
  });
});
