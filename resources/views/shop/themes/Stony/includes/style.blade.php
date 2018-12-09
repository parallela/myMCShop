<style>
    @font-face {
        font-family: 'Luckiest Guy';
        src: url("https://castiamc.com/buycraft/luckiestguy-webfont.woff2") format("woff2"), url("https://castiamc.com/buycraft/luckiestguy-webfont.woff") format("woff");
        font-weight: normal;
        font-style: normal; }

    .clear:before, .clear:after {
        content: ' ';
        display: table; }

    .clear {
        *zoom: 1; }
    .clear:after {
        clear: both; }

    html {
        margin: 0;
        padding: 0;
        height: 100vh;
        min-height: 100%;
        background: url({{ $background_image }});
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Luckiest Guy'; }

    body {
        background: none;
        font-family: Helvetica, sans-serif; }

    /*! normalize.css v4.1.1 | MIT License | github.com/necolas/normalize.css */
    /**
     * 1. Change the default font family in all browsers (opinionated).
     * 2. Prevent adjustments of font size after orientation changes in IE and iOS.
     */
    html {
        font-family: sans-serif;
        /* 1 */
        -ms-text-size-adjust: 100%;
        /* 2 */
        -webkit-text-size-adjust: 100%;
        /* 2 */ }

    /**
     * Remove the margin in all browsers (opinionated).
     */
    body {
        margin: 0; }

    /* HTML5 display definitions
       ========================================================================== */
    /**
     * Add the correct display in IE 9-.
     * 1. Add the correct display in Edge, IE, and Firefox.
     * 2. Add the correct display in IE.
     */
    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    main,
    menu,
    nav,
    section,
    summary {
        /* 1 */
        display: block; }

    /**
     * Add the correct display in IE 9-.
     */
    audio,
    canvas,
    progress,
    video {
        display: inline-block; }

    /**
     * Add the correct display in iOS 4-7.
     */
    audio:not([controls]) {
        display: none;
        height: 0; }

    /**
     * Add the correct vertical alignment in Chrome, Firefox, and Opera.
     */
    progress {
        vertical-align: baseline; }

    /**
     * Add the correct display in IE 10-.
     * 1. Add the correct display in IE.
     */
    template,
    [hidden] {
        display: none; }

    /* Links
       ========================================================================== */
    /**
     * 1. Remove the gray background on active links in IE 10.
     * 2. Remove gaps in links underline in iOS 8+ and Safari 8+.
     */
    a {
        background-color: transparent;
        /* 1 */
        -webkit-text-decoration-skip: objects;
        /* 2 */ }

    /**
     * Remove the outline on focused links when they are also active or hovered
     * in all browsers (opinionated).
     */
    a:active,
    a:hover {
        outline-width: 0; }

    /* Text-level semantics
       ========================================================================== */
    /**
     * 1. Remove the bottom border in Firefox 39-.
     * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
     */
    abbr[title] {
        border-bottom: none;
        /* 1 */
        text-decoration: underline;
        /* 2 */
        text-decoration: underline dotted;
        /* 2 */ }

    /**
     * Prevent the duplicate application of `bolder` by the next rule in Safari 6.
     */
    b,
    strong {
        font-weight: inherit; }

    /**
     * Add the correct font weight in Chrome, Edge, and Safari.
     */
    b,
    strong {
        font-weight: bolder; }

    /**
     * Add the correct font style in Android 4.3-.
     */
    dfn {
        font-style: italic; }

    /**
     * Correct the font size and margin on `h1` elements within `section` and
     * `article` contexts in Chrome, Firefox, and Safari.
     */
    h1 {
        font-size: 2em;
        margin: 0.67em 0; }

    /**
     * Add the correct background and color in IE 9-.
     */
    mark {
        background-color: #ff0;
        color: #000; }

    /**
     * Add the correct font size in all browsers.
     */
    small {
        font-size: 80%; }

    /**
     * Prevent `sub` and `sup` elements from affecting the line height in
     * all browsers.
     */
    sub,
    sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline; }

    sub {
        bottom: -0.25em; }

    sup {
        top: -0.5em; }

    /* Embedded content
       ========================================================================== */
    /**
     * Remove the border on images inside links in IE 10-.
     */
    img {
        border-style: none; }

    /**
     * Hide the overflow in IE.
     */
    svg:not(:root) {
        overflow: hidden; }

    /* Grouping content
       ========================================================================== */
    /**
     * 1. Correct the inheritance and scaling of font size in all browsers.
     * 2. Correct the odd `em` font sizing in all browsers.
     */
    code,
    kbd,
    pre,
    samp {
        font-family: monospace, monospace;
        /* 1 */
        font-size: 1em;
        /* 2 */ }

    /**
     * Add the correct margin in IE 8.
     */
    figure {
        margin: 1em 40px; }

    /**
     * 1. Add the correct box sizing in Firefox.
     * 2. Show the overflow in Edge and IE.
     */
    hr {
        box-sizing: content-box;
        /* 1 */
        height: 0;
        /* 1 */
        overflow: visible;
        /* 2 */ }

    /* Forms
       ========================================================================== */
    /**
     * 1. Change font properties to `inherit` in all browsers (opinionated).
     * 2. Remove the margin in Firefox and Safari.
     */
    button,
    input,
    select,
    textarea {
        font: inherit;
        /* 1 */
        margin: 0;
        /* 2 */ }

    /**
     * Restore the font weight unset by the previous rule.
     */
    optgroup {
        font-weight: bold; }

    /**
     * Show the overflow in IE.
     * 1. Show the overflow in Edge.
     */
    button,
    input {
        /* 1 */
        overflow: visible; }

    /**
     * Remove the inheritance of text transform in Edge, Firefox, and IE.
     * 1. Remove the inheritance of text transform in Firefox.
     */
    button,
    select {
        /* 1 */
        text-transform: none; }

    /**
     * 1. Prevent a WebKit bug where (2) destroys native `audio` and `video`
     *    controls in Android 4.
     * 2. Correct the inability to style clickable types in iOS and Safari.
     */
    button,
    html [type="button"],
    [type="reset"],
    [type="submit"] {
        -webkit-appearance: button;
        /* 2 */ }

    /**
     * Remove the inner border and padding in Firefox.
     */
    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
        border-style: none;
        padding: 0; }

    /**
     * Restore the focus styles unset by the previous rule.
     */
    button:-moz-focusring,
    [type="button"]:-moz-focusring,
    [type="reset"]:-moz-focusring,
    [type="submit"]:-moz-focusring {
        outline: 1px dotted ButtonText; }

    /**
     * Change the border, margin, and padding in all browsers (opinionated).
     */
    fieldset {
        border: 1px solid #c0c0c0;
        margin: 0 2px;
        padding: 0.35em 0.625em 0.75em; }

    /**
     * 1. Correct the text wrapping in Edge and IE.
     * 2. Correct the color inheritance from `fieldset` elements in IE.
     * 3. Remove the padding so developers are not caught out when they zero out
     *    `fieldset` elements in all browsers.
     */
    legend {
        box-sizing: border-box;
        /* 1 */
        color: inherit;
        /* 2 */
        display: table;
        /* 1 */
        max-width: 100%;
        /* 1 */
        padding: 0;
        /* 3 */
        white-space: normal;
        /* 1 */ }

    /**
     * Remove the default vertical scrollbar in IE.
     */
    textarea {
        overflow: auto; }

    /**
     * 1. Add the correct box sizing in IE 10-.
     * 2. Remove the padding in IE 10-.
     */
    [type="checkbox"],
    [type="radio"] {
        box-sizing: border-box;
        /* 1 */
        padding: 0;
        /* 2 */ }

    /**
     * Correct the cursor style of increment and decrement buttons in Chrome.
     */
    [type="number"]::-webkit-inner-spin-button,
    [type="number"]::-webkit-outer-spin-button {
        height: auto; }

    /**
     * 1. Correct the odd appearance in Chrome and Safari.
     * 2. Correct the outline style in Safari.
     */
    [type="search"] {
        -webkit-appearance: textfield;
        /* 1 */
        outline-offset: -2px;
        /* 2 */ }

    /**
     * Remove the inner padding and cancel buttons in Chrome and Safari on OS X.
     */
    [type="search"]::-webkit-search-cancel-button,
    [type="search"]::-webkit-search-decoration {
        -webkit-appearance: none; }

    /**
     * Correct the text style of placeholders in Chrome, Edge, and Safari.
     */
    ::-webkit-input-placeholder {
        color: inherit;
        opacity: 0.54; }

    /**
     * 1. Correct the inability to style clickable types in iOS and Safari.
     * 2. Change font properties to `inherit` in Safari.
     */
    ::-webkit-file-upload-button {
        -webkit-appearance: button;
        /* 1 */
        font: inherit;
        /* 2 */ }

    .bg-border-top, .panel:before {
        content: " ";
        width: 850px;
        height: 87px;
        left: -20px;
        top: -107px;
        position: relative;
        display: block;
        background: url("{{ asset('/styles/Stony/images/sprite.png') }}") -5px -5px; }

    .bg-border-bottom, .panel:after {
        content: " ";
        width: 850px;
        height: 89px;
        top: 109px;
        left: -20px;
        position: relative;
        display: block;
        background: url("{{ asset('/styles/Stony/images/sprite.png') }}") -5px -102px; }

    .bg-middle {
        width: 850px;
        min-height: 178px;
        background: url("{{ asset('/styles/Stony/images/Middle.png') }}"); }

    .bg-active {
        width: 350px;
        height: 80px;
        background: url("{{ asset('/styles/Stony/images/button_sprite.png') }}") -5px -5px; }

    .bg-inactive {
        width: 350px;
        height: 80px;
        background: url("{{ asset('/styles/Stony/images/button_sprite.png') }}") -5px -95px; }

    .player-bar {
        padding: 24px;
        height: 99px;
        border: none;
        border-radius: 0;
        position: relative;
        margin-bottom: 10px; }
    .player-bar .wrapper {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: end;
        justify-content: flex-end; }
    .player-bar .toolbar {
        top: 0 !important;
        right: 0 !important; }
    .player-bar .border-top {
        background: url({{ asset('/styles/Stony/images/top.png') }});
        display: block;
        height: 85px;
        display: block;
        height: 85px;
        position: absolute;
        top: -82px;
        left: 0;
        right: 0; }
    .player-bar .border-bottom {
        background: url({{ asset('/styles/Stony/images/bottom.png') }});
        display: block;
        height: 85px;
        display: block;
        height: 85px;
        position: absolute;
        bottom: -82px;
        left: 0;
        right: 0; }
    .player-bar .player-info {
        color: white;
        font-size: 20pt;
        text-shadow: 2px 2px 0 black;
        margin-top: 6px;
        font-family: 'Luckiest Guy', sans-serif;
        display: none; }
    .player-bar .player-info .green {
        color: #12ff00; }

    .logo {
        text-align: center;
        margin: 25px; }

    aside {
        margin-right: 30px; }

    #categories {
        margin-top: -11px;
        font-family: 'Luckiest Guy', sans-serif; }
    #categories ul {
        padding: 0;
        margin: 0; }
    #categories ul li {
        list-style: none; }
    #categories ul li + li {
        margin-top: 20px; }
    #categories ul li a {
        text-transform: uppercase;
        color: white;
        z-index: 10;
        text-decoration: none !important;
        font-size: 18pt; }
    #categories ul li a .category-icon {
        z-index: 10; }
    #categories ul li a .category-title {
        z-index: 10;
        position: relative;
        left: 65px;
        text-shadow: 1px 3px 0 black; }
    #categories .category {
        background-image: url({{ asset('/styles/Stony/images/button_sprite.png') }});
        width: 350px;
        height: 80px;
        background-repeat: no-repeat;
        display: block;
        position: relative;
        width: 350px;
        height: 80px;
        background-position: -5px -95px;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        cursor: pointer; }
    #categories .category::after {
        content: "";
        background-position: -5px -5px;
        background-image: url({{ asset('/styles/Stony/images/button_sprite.png') }});
        opacity: 0;
        transition: opacity 0.5s;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 5; }
    #categories .category:hover::after, #categories .category.active::after {
        opacity: 1;
        transition: opacity 0.5s; }
    #categories .category:hover .category-title {
        color: #ffd600;
        text-shadow: 0 1px 0 #ebab00; }
    #categories .dropdown-menu {
        margin-top: -13px;
        margin-left: 7px;
        border-top: none;
        width: 336px;
        border-color: black;
        background: #404040;
        position: relative; }
    #categories .dropdown-menu li:hover {
        box-shadow: inset 3px 0 0 #edae02, inset -3px 0 0 #edae02; }

    #actions {
        width: 100%;
        margin: 0 auto;
        margin-top: 200px; }
    #actions ul {
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 0;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-align: center;
        align-items: center; }
    #actions ul li {
        list-style: none; }

    .action {
        background-image: url(../img/actions-sprite.png);
        background-repeat: no-repeat;
        display: block;
        position: relative; }

    .action-forum {
        width: 256px;
        height: 218px;
        background-position: -5px -5px; }
    .action-forum::after {
        content: "";
        background-position: -271px -5px;
        background-image: url(../img/actions-sprite.png);
        opacity: 0;
        transition: opacity 0.5s;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0; }
    .action-forum:hover::after {
        opacity: 1;
        transition: opacity 0.5s; }

    .action-shop {
        width: 256px;
        height: 218px;
        background-position: -5px -233px; }
    .action-shop::after {
        content: "";
        background-position: -271px -233px;
        background-image: url(../img/actions-sprite.png);
        opacity: 0;
        transition: opacity 0.5s;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0; }
    .action-shop:hover::after {
        opacity: 1;
        transition: opacity 0.5s; }

    .action-worlds {
        width: 256px;
        height: 131px;
        background-position: -537px -5px; }
    .action-worlds::after {
        content: "";
        background-position: -537px -146px;
        background-image: url(../img/actions-sprite.png);
        opacity: 0;
        transition: opacity 0.5s;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0; }
    .action-worlds:hover::after {
        opacity: 1;
        transition: opacity 0.5s; }

    #main {
        display: -ms-flexbox;
        display: flex; }

    .body .content {
        width: 100%;
        float: initial; }

    .panel {
        background: url({{ asset('/styles/Stony/images/Middle.png') }});
        width: 850px;
        border: none;
        border-radius: 0;
        position: relative;
        min-height: 300px;
        padding: 20px;
        color: white; }
    .panel .panel-heading {
        max-width: 725px;
        background: none;
        border: none;
        color: white;
        font-size: 20pt;
        font-family: 'Luckiest Guy', sans-serif;
        position: relative;
        top: -110px;
        left: 40px;
        color: #3d3e3f; }
    .panel .panel-body {
        position: relative;
        top: -110px;
        left: 40px;
        color: #3d3e3f;
        max-width: 725px;
        box-sizing: border-box; }
    .panel .panel-border-bottom {
        background: url({{ asset('/styles/Stony/images/bottom.png') }});
        display: block;
        height: 85px;
        display: block;
        height: 85px;
        position: absolute;
        bottom: -82px;
        left: 0;
        right: 0; }
    .panel .panel-border-top {
        background: url({{ asset('/styles/Stony/images/top.png') }});
        display: block;
        height: 85px;
        display: block;
        height: 85px;
        position: absolute;
        top: -82px;
        left: 0;
        right: 0; }

    .page {
        margin-top: 80px;
        position: relative; }
    .page > .page-header {
        background-image: url("http://imgur.com/3XDLp9C.png");
        background-repeat: no-repeat;
        display: block;
        width: 880px;
        height: 83px;
        background-position: -5px -98px;
        min-height: 98px;
        margin-bottom: -52px;
        position: relative;
        border: none;
        z-index: 10; }
    .page > .page-content {
        background-image: url("http://imgur.com/EzIRcN6.png");
        background-repeat: repeat-y;
        display: block;
        width: 880px;
        min-height: 128px;
        height: auto;
        padding: 15px 60px;
        box-sizing: border-box;
        position: relative; }
    .page > .page-footer {
        background-image: url("http://imgur.com/3XDLp9C.png");
        background-repeat: no-repeat;
        display: block;
        width: 880px;
        height: 83px;
        background-position: -5px -5px;
        min-height: 82px;
        margin-top: -35px;
        z-index: 10; }

    #worlds {
        margin: 50px;
        display: none; }
    #worlds ul {
        margin: 0;
        padding: 0;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap; }
    #worlds ul li {
        margin: 10px;
        list-style: none; }
    #worlds ul li a {
        text-decoration: none;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-line-pack: center;
        align-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        font-family: 'Open Sans';
        position: relative; }
    #worlds ul li a div {
        background: rgba(0, 0, 0, 0.35);
        width: 100%;
        text-align: center;
        position: absolute;
        top: 40%; }
    #worlds ul li a div .players {
        font-weight: bold;
        color: #41caca;
        font-size: 10pt; }
    #worlds ul li a div .server {
        text-transform: uppercase;
        color: white;
        font-size: 12pt;
        display: block; }

    .world {
        background-image: url(../img/worlds-sprite.png);
        background-repeat: no-repeat;
        display: block; }
    .world:hover {
        -ms-transform: scale(1.5) rotate(2deg);
        transform: scale(1.5) rotate(2deg);
        transition: 250ms transform ease-in-out; }

    .world-ancient {
        width: 128px;
        height: 128px;
        background-position: -2.5px -2.5px; }

    .world-cartoon {
        width: 128px;
        height: 128px;
        background-position: -130.5px -2.5px; }

    .world-first {
        width: 128px;
        height: 128px;
        background-position: -2.5px -130.5px; }

    .world-ice {
        width: 128px;
        height: 128px;
        background-position: -130.5px -130.5px; }

    .world-magic {
        width: 128px;
        height: 128px;
        background-position: -268.5px -2.5px; }

    .world-monsters {
        width: 128px;
        height: 128px;
        background-position: -268.5px -130.5px; }

    .world-nice {
        width: 128px;
        height: 128px;
        background-position: -2.5px -268.5px; }

    .world-robots {
        width: 128px;
        height: 128px;
        background-position: -130.5px -268.5px; }

    .footer {
        border-top: none;
        background: rgba(64, 65, 66, 0.41);
        padding: 20px;
        margin: 80px 0 25px 0;
        width: 850px; }
    .footer a {
        color: white; }
    .footer .branding {
        color: white; }

    .notification,
    .page-heading,
    .page-body {
        z-index: 15;
        position: relative; }

    ::-moz-selection {
        background: #333;
        color: #fff;
        text-shadow: none; }

    ::selection {
        background: #333;
        color: #fff;
        text-shadow: none; }

    ::-moz-selection {
        background: #333;
        color: #fff;
        text-shadow: none; }

    ::-webkit-selection {
        background: #333;
        color: #fff;
        text-shadow: none; }

    .wrapper {
        width: 100%;
        margin: 0 auto; }

    @media only screen and (min-width: 1200px) {
        .wrapper {
            width: 1200px; } }

    @media print {
        * {
            background: transparent !important;
            color: #000 !important;
            box-shadow: none !important;
            text-shadow: none !important; }
        a,
        a:visited {
            text-decoration: underline; }
        a[href]:after {
            content: " (" attr(href) ")"; }
        abbr[title]:after {
            content: " (" attr(title) ")"; }
        .ir a:after,
        a[href^="javascript:"]:after,
        a[href^="#"]:after {
            content: ""; }
        pre,
        blockquote {
            border: 1px solid #999;
            page-break-inside: avoid; }
        thead {
            display: table-header-group; }
        tr,
        img {
            page-break-inside: avoid; }
        img {
            max-width: 100% !important; }
        @page {
            margin: 0.5cm; }
        p,
        h2,
        h3 {
            orphans: 3;
            widows: 3; }
        h2,
        h3 {
            page-break-after: avoid; } }

    .dropdown-menu li a {
        color: white; }
    .dropdown-menu li a:hover {
        background: none;
        color: #ffd600 !important;
        transition: 150ms color ease-in-out; }

    .toolbar .dropdown-menu {
        position: relative;
        width: 100%;
        border-top: none;
        margin-top: -45px !important;
        padding-top: 50px !important;
        padding-bottom: 15px !important;
        z-index: 1;
        margin-bottom: 20px !important; }

    .username .input-group input {
        background: rgba(255, 255, 255, 0.08);
        border: none !important;
        border: 1px solid rgba(64, 65, 66, 0.27) !important;
        color: #3c3d3e !important; }

    .username .input-group-btn button {
        border-bottom: 3px solid #3fad46; }

    .category .packages-image .package {
        height: 360px;
        margin: 15px 0 60px; }
    .category .packages-image .package .image {
        height: 290px;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 100%; }
    .category .packages-image .package .image a {
        height: 100%;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center; }
    .category .packages-image .package .image a img {
        height: initial;
        max-height: 100%; }
    .category .packages-image .package .info .text {
        width: 100%;
        display: block;
        float: none;
        height: 60px; }
    .category .packages-image .package .info .text .name {
        font-weight: bold;
        font-family: 'Open Sans';
        font-size: 12pt;
        text-align: center; }
    .category .packages-image .package .info .text .price {
        font-size: 12pt;
        font-weight: bold;
        text-align: center;
        color: #9a9a9a;
        font-family: Fjalla One,sans-serif; }
    .category .packages-image .package .info .button {
        width: 100%;
        display: block;
        float: none; }
    .category .packages-image .package .info .button .btn-info {
        color: #ffffff;
        background: #393a3a;
        box-shadow: inset 0 0 3px 1px #717171;
        border: 3px solid #113524;
        border-radius: 7px;
        text-transform: uppercase;
        padding: 12px;
        font-size: 14pt;
        font-family: 'Luckiest Guy', sans-serif;
        transition: 150ms all ease-in-out; }
    .category .packages-image .package .info .button .btn-info:hover {
        color: #ffffff;
        border-color: #ffda00;
        box-shadow: inset 0 0 1px 4px #464747, 0 0 5px 0 #cb900a, 0 0 7px 1px #ecbb05;
        background: #393a3a; }

    .text-right {
        text-shadow: 0 3px black; }

    h4, .h4, h5, .h5, h6, .h6, .module .top-donator .info .ign {
        color: white; }

    label {
        color: white; }

    table th {
        color: white; }

    table td {
        background: none !important;
        color: white; }

    a {
        color: #90eeeb; }

    .page-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.29); }

    .modal-title {
        color: #70c4c5; }

    .modal .modal-content .modal-body p {
        color: black; }

    .toolbar {
        display: -ms-flexbox;
        display: flex;
        position: relative;
        right: 43px;
        top: -40px;
        height: 34px;
        float: right; }
    .toolbar > div + div {
        margin-left: 5px; }
    .toolbar div.open .dropdown-menu {
        float: none;
        position: absolute;
        left: 0;
        right: 0;
        top: 78px;
        z-index: 15 !important;
        background: #414243;
        padding: 20px !important;
        margin: 0;
        border-width: 1px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        color: white; }
    .toolbar div.open .dropdown-menu .btn-success {
        background: #318837;
        transition: color, border-radius .15s ease-in-out; }
    .toolbar div.open .dropdown-menu .btn-success:hover {
        border-radius: 10px;
        color: white; }
    .toolbar div.open .dropdown-menu .checkout {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
        padding: 10px 0;
        border-top: 1px solid #5a5a5a;
        margin-top: 10px; }
    .toolbar div.open .dropdown-menu .item {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -ms-flex-align: center;
        align-items: center; }
    .toolbar div.open .dropdown-menu .item .name {
        -ms-flex: 2;
        flex: 2; }
    .toolbar div.open .dropdown-menu .item .remove {
        width: 22px;
        background: #d9534f;
        text-align: center;
        margin-left: 10px;
        opacity: 0.5;
        transition: 150ms border-radius,opacity ease-in-out; }
    .toolbar div.open .dropdown-menu .item .remove:hover {
        border-radius: 13px;
        opacity: 1; }
    .toolbar div.open .dropdown-menu .item .remove a {
        color: white; }

    .input-group input {
        color: #414142; }

    h4, .h4, h5, .h5, h6, .h6, .module .top-donator .info .ign {
        color: #424344; }

    table th {
        color: black; }

    table td {
        color: #3d3e3f; }

    label {
        color: #424344; }

    @media (min-width: 1200px) {
        .container {
            width: 827px; } }

    @media (min-width: 992px) {
        .container {
            width: 827px; } }
</style>