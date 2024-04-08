import { SetupThemeOptions } from "../setup/setup.js"
import { linksBlank } from "../setup/links-blank.js";

document.addEventListener('DOMContentLoaded', () => {
    
    SetupThemeOptions.init(

        linksBlank({nav: '.header-nav a'}),
        linksBlank({nav: '.footer-nav a'}),
    )
    .then(() => console.log(document.readyState))
})