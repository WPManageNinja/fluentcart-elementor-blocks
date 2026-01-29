export default class ResponseProxyItr {

    constructor(response) {

        this.response = response;

        return new Proxy(this, {
            get: function(target, prop) {

                if (typeof target[prop] === 'function') {
                    if (prop === Symbol.iterator) {
                        return target[Symbol.iterator].bind(target);
                    }
                }

                if (prop in target.response) {
                    return target.response[prop];
                } else if (prop in target.response.responseJSON) {
                    return target.response.responseJSON[prop];
                }
            },
            ownKeys(target) {
                return Object.keys(target.response.responseJSON);
            },
            getOwnPropertyDescriptor(target, prop) {
                return {
                  enumerable: true,
                  configurable: true,
                  value: target[prop]
                };
            }
        });
    }

    *iterator() {
        for (let i in this.response.responseJSON) {
            yield this.response.responseJSON[i];
        }
    }

    [Symbol.iterator]() {
        return this.iterator();
    }
}
