// require cropperjs plugins
window.Cropper = require('cropperjs');
import 'cropperjs/dist/cropper.css';

import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling
import 'tippy.js/themes/material.css'

// create popper
$('[data-toggle="tippy"]').on('mouseenter', function () {
  let content = $(this).data('title');
  tippy(this, {
    allowHTML: true,
    content: '<p class="text-center mb-0">' + content + '</p>',
    theme: 'material',
  });
});