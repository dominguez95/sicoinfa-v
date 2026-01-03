/**
 * Api Helper for Vanilla JS with Axios
 * Assumes window.axios is available (provided by Laravel's bootstrap.js)
 */

window.Api = {
    /**
     * Centralized request handler
     */
    async request(method, url, data = null, params = {}) {
        try {
            const config = {
                method: method,
                url: url,
                params: params,
            };

            if (data && (method === 'post' || method === 'put' || method === 'patch')) {
                config.data = data;
            }

            const response = await axios(config);
            return response.data;
        } catch (error) {
            console.error(`API Error [${method.toUpperCase()} ${url}]:`, error);
            // Re-throw to handle it in the component/view if necessary
            throw error;
        }
    },

    /**
     * Get a list of resources
     * @param {string} url 
     * @param {object} params - Query parameters
     */
    getAll(url, params = {}) {
        return this.request('get', url, null, params);
    },

    /**
     * Get a single resource
     * @param {string} url 
     * @param {object} params 
     */
    getOne(url, params = {}) {
        return this.request('get', url, null, params);
    },

    /**
     * Create a new resource
     * @param {string} url 
     * @param {object} data 
     */
    post(url, data) {
        return this.request('post', url, data);
    },

    /**
     * Update a resource (PUT)
     * @param {string} url 
     * @param {object} data 
     */
    update(url, data) {
        return this.request('put', url, data);
    },

    /**
     * Partially update a resource (PATCH)
     * @param {string} url 
     * @param {object} data 
     */
    patch(url, data) {
        return this.request('patch', url, data);
    },

    /**
     * Delete a resource
     * @param {string} url 
     */
    delete(url) {
        return this.request('delete', url);
    },

    /**
     * Upload files (Multipart Form Data)
     * @param {string} url 
     * @param {FormData} formData 
     */
    upload(url, formData) {
        return axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(response => response.data);
    }
};

console.log('Api helper loaded');

/**
 * Helper to initialize TomSelect with API pagination (Virtual Scroll).
 * Uses the global 'Api' helper (Axios).
 * 
 * @param {string} selectId - DOM ID of the select element
 * @param {string} url - Endpoint URL
 * @param {object} extraParams - Additional query parameters
 * @param {object} tomOptions - Override default TomSelect options
 * @returns {TomSelect|null}
 */
window.tomSelectApi = (selectId, url, extraParams = {}, tomOptions = {}) => {
    const selectElement = document.getElementById(selectId);
    if (!selectElement) {
        console.warn(`⚠️ Select "${selectId}" not found`);
        return null;
    }

    if (typeof TomSelect === "undefined") {
        console.warn("⚠️ Tom Select library not found");
        return null;
    }

    // Destroy existing instance if any
    if (selectElement.tomselect) {
        try {
            selectElement.tomselect.destroy();
        } catch (_) { }
    }

    const defaultOptions = {
        plugins: ["virtual_scroll", "dropdown_input"],
        valueField: "id",
        labelField: "text",
        searchField: "text",
        placeholder: "Seleccione...",
        maxOptions: 200,

        // Custom load function using our Api helper (Axios)
        load: function (query, callback) {
            // We construct params for the request
            // Note: TomSelect's internal pagination logic often passes the full URL 
            // via this.getUrl(query) if firstUrl/setNextUrl are used, 
            // but since we are using Axios params, we can simplify.

            // However, TomSelect's virtual_scroll expects a URL string to handle 'next_url'.
            // To make it compatible with our Api.get which takes (url, params),
            // we will parse the URL provided by TomSelect to extract query params.

            const fullUrl = this.getUrl(query);
            // fullUrl contains ?term=abc&page=1...

            const urlObj = new URL(fullUrl, window.location.origin);
            const params = Object.fromEntries(urlObj.searchParams.entries());

            // Use our global Api helper
            Api.request('get', url, null, params)
                .then((data) => {
                    const items = data.results || data.data || [];
                    const more = data.pagination ? data.pagination.more : (data.next_page_url !== null);

                    if (more && typeof this.setNextUrl === "function") {
                        // We need to generate the NEXT full URL string for TomSelect to store internally
                        // so it calls load() with it next time.
                        const nextUrlObj = new URL(url, window.location.origin);
                        // Add all current params
                        Object.keys(params).forEach(key => nextUrlObj.searchParams.set(key, params[key]));

                        // Increment page
                        const curPage = parseInt(params.page || "1", 10);
                        nextUrlObj.searchParams.set("page", curPage + 1);

                        this.setNextUrl(query, nextUrlObj.toString());
                    }

                    callback(items);
                })
                .catch((err) => {
                    console.error("TomSelect Load Error:", err);
                    callback();
                });
        },

        // We define firstUrl to simply initialize the URL string structure for the first request
        firstUrl: function (query) {
            const params = {
                term: query || "",
                page: 1,
                ...extraParams,
            };
            return `${url}?${new URLSearchParams(params)}`;
        },

        render: {
            option: function (data, escape) {
                return `<div class="py-2 px-3">${escape(data.text)}</div>`;
            },
            item: function (data, escape) {
                return `<div>${escape(data.text)}</div>`;
            },
            loading_more: function () {
                return `<div class="py-2 px-3 text-gray-500 text-sm text-center">Cargando más resultados...</div>`;
            },
            no_results: function (data, escape) {
                return `<div class="no-results py-2 px-3 text-gray-500 text-sm">No se encontraron resultados para "${escape(data.input)}"</div>`;
            },
        },

        onDropdownOpen: function () {
            if (!this.loadedSearches[""]) {
                this.load("", () => { });
            }
        },
    };

    const options = Object.assign({}, defaultOptions, tomOptions);
    const ts = new TomSelect(selectElement, options);

    // --- Extensions for Helper Methods ---

    // setValueSilent: Try to set value without triggering 'change' event
    // Note: TomSelect's API for silent updates varies by version or plugins.
    ts.setValueSilent = function (value) {
        if (typeof this.setValue === "function") {
            try {
                // Try official silent param if supported
                this.setValue(value, true);
            } catch (e) {
                this.setValue(value);
            }
        }
    };

    // addOptionAndSelectSilent: Add an option manually and select it
    ts.addOptionAndSelectSilent = function (opt) {
        this.addOption(opt);
        this.setValueSilent(opt.id);
    };

    return ts;
};

// ============================================================
// DOM Helper Functions (Vanilla JS)
// ============================================================

/**
 * Get an element by ID or name attribute
 * @param {string} idOrName - The ID or name of the element
 * @returns {HTMLElement|null}
 */
window.getElement = (idOrName) => {
    // First try by ID
    let element = document.getElementById(idOrName);

    // If not found, try by name
    if (!element) {
        element = document.querySelector(`[name="${idOrName}"]`);
    }

    return element;
};

/**
 * Get the value of an input element by ID or name
 * @param {string} idOrName - The ID or name of the input element
 * @returns {string|null} - The value of the input or null if not found
 */
window.getValue = (idOrName) => {
    const element = window.getElement(idOrName);

    if (!element) {
        console.warn(`⚠️ Element "${idOrName}" not found`);
        return null;
    }

    // Handle different input types
    if (element.type === 'checkbox') {
        return element.checked;
    }

    if (element.type === 'radio') {
        const radios = document.querySelectorAll(`[name="${element.name}"]`);
        for (const radio of radios) {
            if (radio.checked) return radio.value;
        }
        return null;
    }

    return element.value;
};

/**
 * Set the value of an input element by ID or name
 * @param {string} idOrName - The ID or name of the input element
 * @param {*} value - The value to set
 * @returns {boolean} - True if successful, false otherwise
 */
window.setValue = (idOrName, value) => {
    const element = window.getElement(idOrName);

    if (!element) {
        console.warn(`⚠️ Element "${idOrName}" not found`);
        return false;
    }

    // Handle different input types
    if (element.type === 'checkbox') {
        element.checked = Boolean(value);
        return true;
    }

    if (element.type === 'radio') {
        const radios = document.querySelectorAll(`[name="${element.name}"]`);
        for (const radio of radios) {
            radio.checked = (radio.value === String(value));
        }
        return true;
    }

    // Handle TomSelect if present
    if (element.tomselect) {
        element.tomselect.setValue(value);
        return true;
    }

    element.value = value;

    // Dispatch input event for reactivity
    element.dispatchEvent(new Event('input', { bubbles: true }));

    return true;
};

/**
 * Add a single option to a select element by ID or name
 * @param {string} idOrName - The ID or name of the select element
 * @param {string|number} value - The value of the option
 * @param {string} text - The display text of the option
 * @param {boolean} selected - Whether the option should be selected (default: false)
 * @returns {boolean} - True if successful, false otherwise
 */
window.addSelectOption = (idOrName, value, text, selected = false) => {
    const element = window.getElement(idOrName);

    if (!element) {
        console.warn(`⚠️ Element "${idOrName}" not found`);
        return false;
    }

    if (element.tagName !== 'SELECT') {
        console.warn(`⚠️ Element "${idOrName}" is not a SELECT element`);
        return false;
    }

    // Handle TomSelect if present
    if (element.tomselect) {
        element.tomselect.addOption({ id: value, text: text });
        if (selected) {
            element.tomselect.setValue(value);
        }
        element.tomselect.refreshOptions(false);
        return true;
    }

    // Create and add the option
    const option = document.createElement('option');
    option.value = value;
    option.textContent = text;
    if (selected) option.selected = true;

    element.appendChild(option);

    return true;
};

/**
 * Clear an input when a specific event occurs (click or backspace)
 * @param {string} idOrName - The ID or name of the input element
 * @param {string} eventType - Event type: 'click', 'backspace', or 'both' (default: 'both')
 * @returns {Function|null} - Cleanup function to remove event listeners, or null if failed
 */
window.clearOnEvent = (idOrName, eventType = 'both') => {
    const element = window.getElement(idOrName);

    if (!element) {
        console.warn(`⚠️ Element "${idOrName}" not found`);
        return null;
    }

    const listeners = [];

    // Helper to clear the input
    const clearInput = () => {
        if (element.tomselect) {
            element.tomselect.clear();
        } else if (element.type === 'checkbox' || element.type === 'radio') {
            element.checked = false;
        } else {
            element.value = '';
        }
        element.dispatchEvent(new Event('input', { bubbles: true }));
    };

    // Click handler
    if (eventType === 'click' || eventType === 'both') {
        const clickHandler = (e) => {
            // Only clear if clicking on a clear button/icon inside or on the element itself
            if (e.target.classList.contains('clear-btn') || e.target.closest('.clear-btn')) {
                clearInput();
            }
        };
        element.parentElement?.addEventListener('click', clickHandler);
        listeners.push({ element: element.parentElement, event: 'click', handler: clickHandler });
    }

    // Backspace handler
    if (eventType === 'backspace' || eventType === 'both') {
        const keydownHandler = (e) => {
            if (e.key === 'Backspace' && element.value === '') {
                clearInput();
            }
        };
        element.addEventListener('keydown', keydownHandler);
        listeners.push({ element: element, event: 'keydown', handler: keydownHandler });
    }

    // Return cleanup function
    return () => {
        listeners.forEach(({ element, event, handler }) => {
            element?.removeEventListener(event, handler);
        });
    };
};

/**
 * Setup a button to clear an input and focus it on click
 * @param {string} inputIdOrName - The ID or name of the input element
 * @param {string} buttonIdOrName - The ID or name of the button element
 * @returns {Function|null} - Cleanup function to remove event listener, or null if failed
 */
window.clearInput = (inputIdOrName, buttonIdOrName) => {
    const input = window.getElement(inputIdOrName);
    const button = window.getElement(buttonIdOrName);

    if (!input) {
        console.warn(`⚠️ Input "${inputIdOrName}" not found`);
        return null;
    }

    if (!button) {
        console.warn(`⚠️ Button "${buttonIdOrName}" not found`);
        return null;
    }

    // Only works with input elements
    if (input.tagName !== 'INPUT' && input.tagName !== 'TEXTAREA') {
        console.warn(`⚠️ Element "${inputIdOrName}" is not an INPUT or TEXTAREA`);
        return null;
    }

    const clickHandler = () => {
        input.value = '';
        input.focus();
        input.dispatchEvent(new Event('input', { bubbles: true }));
    };

    button.addEventListener('click', clickHandler);

    // Return cleanup function
    return () => {
        button.removeEventListener('click', clickHandler);
    };
};

console.log('DOM helper functions loaded');
