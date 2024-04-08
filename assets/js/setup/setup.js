
export class SetupThemeOptions {


    static async init(...callbacks){

        try {
            callbacks.forEach(callback => {
                callback();
            })
        }
        catch (e) {
           console.error(e);
        }
    }
}

