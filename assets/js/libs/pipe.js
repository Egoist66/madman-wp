/**
 * Executes a series of callback functions with the given arguments.
 *
 * @param {Array} args - The array of arguments to be passed to the callback functions.
 * @param {...Function} callbacks - The callback functions to be executed.
 * @return {undefined} This function does not return a value.
 */

function pipe(args = [], ...callbacks){
    

    try {
        callbacks.forEach(callback => {
            callback(args);
        })
    }
    catch (e) {
        console.error(e);
    }
    
}