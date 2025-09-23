{{-- Shared UI Kit (CSS + Icons + Charts + JS helpers) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
  :root {
    --card-b: #e9eef7;
    --ink-o: .12;
  }
  /* Layout helpers */
  .page-wrap { display:flex; width:100%; min-height:100vh; }
  .content { flex:1; padding:18px 18px 32px; }
  .topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; }
  .chip { display:inline-flex; align-items:center; gap:6px; padding:4px 10px; border-radius:999px; background:#eef2ff; font-size:.78rem; color:#334155; }

  /* Modern Sidebar */
  .sidebar-modern { background:#0b1736; color:#c9d3ff; width:280px; min-height:100vh; }
  .sidebar-modern .logo-wrap { padding:16px; display:flex; align-items:center; gap:10px; }
  .sidebar-modern .logo-wrap img { height:42px; }
  .brand-title { font-weight:700; color:#fff; letter-spacing:.3px; }
  .menu { list-style:none; padding:8px 0; margin:0; }
  .menu > li > a { display:flex; align-items:center; gap:12px; padding:12px 18px; color:#c9d3ff; border-radius:12px; margin:4px 8px; text-decoration:none; }
  .menu > li > a:hover { background:rgba(255,255,255,.08); color:#fff; }
  .menu > li.active > a { background:#113076; color:#fff; }
  .submenu > a .menu-arrow { margin-left:auto; transition:.2s; }
  .submenu-open > a .menu-arrow { transform:rotate(90deg); }
  .submenu ul { list-style:none; padding:6px 0 8px 42px; margin:0; display:none; }
  .submenu ul li a { display:block; padding:8px 10px; color:#aabdff; border-radius:8px; margin:2px 8px 2px 0; text-decoration:none; }
  .submenu ul li a:hover { background: rgba(255,255,255,.06); color:#fff; }

  /* Card system */
  .card-modern { border:1px solid var(--card-b); border-radius:16px; background:#fff; box-shadow:0 2px 10px rgba(15,23,42,.04); overflow:hidden; }
  .card-header { padding:14px 16px; border-bottom:1px solid #eef2f7; background:#fff; display:flex; align-items:center; justify-content:space-between; }
  .card-body { padding:16px; }

  /* KPI tiles */
  .kpi { border:1px solid var(--card-b); border-radius:16px; padding:14px 16px; display:flex; justify-content:space-between; align-items:center; background:#fff; box-shadow: 0 2px 10px rgba(15,23,42,.04); }
  .kpi .title { font-size:.82rem; color:#64748b; }
  .kpi .value { font-size:1.35rem; font-weight:700; color:#0f172a; }
  .kpi i { opacity:.9; }

  /* Module Cards (overview boxes) */
  .mod-grid { display:grid; grid-template-columns:repeat(12,1fr); gap:16px; }
  @media (max-width:1199.98px){ .mod-grid{ grid-template-columns:repeat(8,1fr);} }
  @media (max-width:767.98px){ .mod-grid{ grid-template-columns:repeat(4,1fr);} }
  @media (max-width:575.98px){ .mod-grid{ grid-template-columns:repeat(2,1fr);} }
  .mod-card { grid-column:span 6; position:relative; overflow:hidden; border-radius:16px; background:#fff; border:1px solid var(--card-b); box-shadow:0 6px 20px rgba(15,23,42,.06); transition:transform .18s, box-shadow .18s, border-color .18s; }
  .mod-card:hover{ transform:translateY(-3px); box-shadow:0 10px 26px rgba(15,23,42,.1); border-color:#d8e2fb; }
  .mod-ink { position:absolute; inset:0; pointer-events:none; opacity:var(--ink-o); background: radial-gradient(1200px 200px at 0% 0%, var(--grad,#4f46e5) 0, transparent 60%); }
  .mod-body{ padding:16px; position:relative; z-index:1; }
  .mod-top{ display:flex; align-items:center; gap:12px; margin-bottom:10px; }
  .mod-icon{ width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.1rem; background: var(--icon-bg,#6366f1); box-shadow:0 6px 18px rgba(99,102,241,.35); }
  .mod-title{ font-weight:700; color:#0f172a; margin:0; line-height:1.2; }
  .mod-sub{ color:#64748b; font-size:.85rem; }
  .mod-kpis{ display:flex; gap:16px; flex-wrap:wrap; margin:10px 0 12px; }
  .mini { font-size:.8rem; color:#475569; }
  .mini strong{ color:#0f172a; }
  .bar{ height:8px; border-radius:999px; background:#eef2f7; overflow:hidden; margin:4px 0 2px; }
  .bar > i{ display:block; height:100%; width:var(--v,40%); background:linear-gradient(90deg,var(--b1,#818cf8),var(--b2,#22d3ee)); border-radius:999px; }
  .mod-actions{ display:flex; gap:8px; flex-wrap:wrap; }
  .mod-actions .btn{ border-radius:10px; padding:.4rem .65rem; font-size:.8rem; }

  /* grid span helpers */
  .span-12{ grid-column:span 12; } .span-6{ grid-column:span 6; } .span-4{ grid-column:span 4; }
  @media (max-width:1199.98px){ .span-6,.span-4{ grid-column:span 8; } }
  @media (max-width:767.98px){ .span-6,.span-4{ grid-column:span 4; } }
  @media (max-width:575.98px){ .span-6,.span-4{ grid-column:span 2; } }

  /* Responsive sidebar on mobile */
  @media (max-width: 991.98px) {
    .sidebar-modern { position:fixed; z-index:999; transform:translateX(-100%); transition:.25s; }
    .sidebar-modern.open { transform:translateX(0); }
  }
</style>

<script>
  // Simple toggles for submenu & mobile sidebar
  document.addEventListener('click', (e) => {
    const t = e.target.closest('[data-submenu-toggle]');
    if (t) {
      e.preventDefault();
      const li = t.closest('li.submenu');
      li.classList.toggle('submenu-open');
      const list = li.querySelector('ul');
      if (list) list.style.display = li.classList.contains('submenu-open') ? 'block' : 'none';
    }
    const burger = e.target.closest('[data-sidebar-toggle]');
    if (burger) document.querySelector('#sidebarModern')?.classList.toggle('open');
  });
</script>
