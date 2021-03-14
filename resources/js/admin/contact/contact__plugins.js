// import tippy js
import tippy, { animateFill } from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling
import 'tippy.js/themes/material.css';
import 'tippy.js/dist/backdrop.css';
import 'tippy.js/animations/shift-away.css';

// create popper
$('[data-toggle="tippy"]').on('mouseenter', function () {
  let content = $(this).data('title');
  tippy(this, {
    allowHTML: true,
    animateFill: true,
    arrow: true,
    content: '<p class="text-center mb-0">' + content + '</p>',
    placement: 'top-start',
    plugins: [animateFill],
    theme: 'material',
  });
});