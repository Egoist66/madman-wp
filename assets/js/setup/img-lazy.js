export const imgLazy = () => {

    try {
        const imgs = [...document.querySelectorAll('img')];
        return () => {
            imgs.forEach(imgs => imgs.setAttribute('loading', 'lazy'));
        }
    } catch (error) {
        //console.log(error);
        return () => {}
    }
}