import { SetupThemeOptions } from "../setup/setup.js"
import { linksBlank } from "../setup/links-blank.js";
import { imgLazy } from "../setup/img-lazy.js";

jQuery(document).ready(function($) {
    SetupThemeOptions.init(

        linksBlank({nav: ''}),
        linksBlank({nav: '.footer-nav a'}),
        imgLazy(),
    )
    .then(() => console.log(document.readyState))
});
    
  