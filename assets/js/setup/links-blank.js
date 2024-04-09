export const linksBlank = (options) => {

    try {
        const links = [...document.querySelectorAll(options.nav)];
        return () => {
            links.forEach(link => link.setAttribute('target', '_blank'));
        }
    } catch (error) {
        //console.log(error);
        return () => {}
    }
}