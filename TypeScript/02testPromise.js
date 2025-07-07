"use strict";
function iReturnPromiseAfter1Second() {
    return new Promise((resolve, reject) => {
        setTimeout(() => resolve(1), 1000);
    });
}
(async () => {
    const result = await iReturnPromiseAfter1Second();
    console.log(result);
})();
