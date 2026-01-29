import ResponseProxyItr from './ResponseProxyItr';

const request = function (method, route, data = {}, headers = {}) {
    const url = `${window.fluentFrameworkAdmin.rest.url}/${route}`;

    headers['X-WP-Nonce'] = window.fluentFrameworkAdmin.rest.nonce;

    if (['PUT', 'PATCH', 'DELETE'].indexOf(method.toUpperCase()) !== -1) {
        headers['X-HTTP-Method-Override'] = method;
        method = 'POST';
    }

    data.query_timestamp = Date.now();

    return new Promise((resolve, reject) => {
        window.jQuery.ajax({
            url: url,
            type: method,
            data: data,
            headers: headers
        })
        .then(response => resolve(response))
        .fail(response => reject(new ResponseProxyItr(response)));
    });
}

export default {
    get(route, data = {}, headers = {}) {
        return request('GET', route, data, headers);
    },
    post(route, data = {}, headers = {}) {
        return request('POST', route, data, headers);
    },
    delete(route, data = {}, headers = {}) {
        return request('DELETE', route, data, headers);
    },
    put(route, data = {}, headers = {}) {
        return request('PUT', route, data, headers);
    },
    patch(route, data = {}, headers = {}) {
        return request('PATCH', route, data, headers);
    }
};

jQuery(document).ajaxSuccess((event, xhr, settings) => {
    const nonce = xhr.getResponseHeader('X-WP-Nonce');
    if (nonce) {
        window.fluentFrameworkAdmin.rest_nonce = nonce;
    }
});
