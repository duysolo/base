export class Helpers {
    static arrayGet(array, key, defaultValue = null) {
        let result;

        try {
            result = array[key];
        } catch (err) {
            return defaultValue;
        }

        if (result === null || typeof result == 'undefined') {
            result = defaultValue;
        }

        return result;
    }

    static jsonEncode(object) {
        if (typeof object === 'undefined') {
            object = null;
        }
        return JSON.stringify(object);
    }

    static jsonDecode(jsonString, defaultValue) {
        if (typeof jsonString === 'string') {
            let result;
            try {
                result = $.parseJSON(jsonString);
            } catch (err) {
                result = defaultValue;
            }
            return result;
        }
        return null;
    }

    static asset(url) {
        if (url.substring(0, 2) == '//' || url.substring(0, 7) == 'http://' || url.substring(0, 8) == 'https://') {
            return url;
        }

        let baseUrl = BASE_URL.substr(-1, 1) != '/' ? BASE_URL + '/' : BASE_URL;

        if (url.substring(0, 1) == '/') {
            return baseUrl + url.substring(1);
        }
        return baseUrl + url;
    }
}
