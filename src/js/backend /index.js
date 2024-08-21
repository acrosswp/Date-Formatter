import { createRoot } from '@wordpress/element';

import './backend.scss';

import App from './app';

window.addEventListener('load', function () {
    const container = document.getElementById('date-formatter-container');
    const root = createRoot(container);
    root.render(<App />);
}, false);
