const ROOT        = window.location.origin
const DOMAIN      = window.location.pathname;
const FOLDER      = DOMAIN.split('/');
const DESTINATION = ROOT + '/' + FOLDER[1] + '/';
