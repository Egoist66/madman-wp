export const linksBlank = (options) => {

    const links = [...document.querySelectorAll(options.nav)];
    
    return () => {
        links.forEach(link => link.setAttribute('target', '_blank'));
    }
}