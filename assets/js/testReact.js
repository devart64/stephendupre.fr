import React from 'react';
import ReactDom from 'react-dom';

const el = React.createElement(
    'h2',
    null,
    'Bienvenue sur mon blog',
    React.createElement('span', null, ' ❤')
); // on créé un élément

ReactDom.render(el, document.getElementById('blog-app')); // on l'injecte dans le dom
