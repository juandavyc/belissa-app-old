import { AdministradorClass } from './administrador.js';

const _csrfDashboard = $('meta[name="csrf-dashboard"]').attr('content');
// m
let _dashAdmin = null;
if (_csrfDashboard === 'dash_1') {
  _dashAdmin = new AdministradorClass();
} else {
  $('#dash-admin').hide(400);
}

const tabsModulos = $('#tab-modulos');
tabsModulos.responsiveTabs({
  rotate: false,
  startCollapsed: 'accordion',
  collapsible: 'accordion',
  setHash: false,
  disabled: [1],
});

tabsModulos.responsiveTabs('activate', 0);
