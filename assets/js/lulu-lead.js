function windowIsLargeScreen() {
	return window.innerWidth > 1024;
}

if (!windowIsLargeScreen()) {
	document.head.insertAdjacentHTML('beforeend', '<style type="text/css">.mdl-layout{visibility:hidden;}</style>');
}
