function toggler(select, div, to_enable) {
    const inputs = div.querySelectorAll('input, select, textarea');

    if (to_enable) {
        div.classList.remove('d-none');

        inputs.forEach(el => {
            // // Reset values
            // if (['radio', 'checkbox'].includes(el.type)) {
            //     el.checked = false;
            // } else {
            //     el.value = '';
            // }

            // Handle required state
            if (el.hasAttribute('data-required')) {
                el.required = true;
                el.removeAttribute('data-required');
            }
        });
    } else {
        div.classList.add('d-none');

        inputs.forEach(el => {
            // Reset values
            if (['radio', 'checkbox'].includes(el.type)) {
                el.checked = false;
            } else {
                el.value = '';
            }

            // Store required state before removing
            if (el.required) {
                el.setAttribute('data-required', 'true');
                el.required = false;
            }
        });
    }
}

function helper_attr_rev_init() {
    document.querySelectorAll('[data-ha-name]:not(.ha-rev-init)').forEach(function (elem) {
        elem.classList.add('ha-rev-init');

        var containerSelector = elem.getAttribute('data-ha-container');
        var container = containerSelector ? document.querySelector(containerSelector) : document;
        var name = elem.getAttribute('data-ha-name');
        var callback = elem.getAttribute('data-ha-callback') ? window[elem.getAttribute('data-ha-callback')] : false;

        function exec() {
            container.querySelectorAll('[data-ha-relative="' + name + '"]').forEach(function (relative) {
                var to_enable = false;
                var elem_value = '';

                if (elem.tagName == 'SELECT') {
                    if (elem.multiple === true) {
                        var selectedOptions = [];
                        for (var option of elem.options) {
                            if (option.selected === true) {
                                selectedOptions.push(option.value);
                            }
                        }
                        elem_value = selectedOptions;
                    } else {
                        elem_value = elem.value;
                    }
                } else if (elem.tagName == 'INPUT') {
                    if (elem.type == 'checkbox' || elem.type == 'radio') {
                        elem_value = (elem.checked === true ? elem.value : '');
                    } else {
                        elem_value = elem.value;
                    }
                } else if (elem.tagName == 'TEXTAREA') {
                    elem_value = elem.value;
                }

                if (relative.getAttribute('data-ha-equal')) {
                    to_enable = (relative.getAttribute('data-ha-equal') == elem_value) ? true : false;
                } else if (relative.getAttribute('data-ha-else')) {
                    to_enable = (relative.getAttribute('data-ha-else') != elem_value) ? true : false;
                } else if (relative.getAttribute('data-ha-arr')) {
                    var arr = JSON.parse(relative.getAttribute('data-ha-arr'));
                    to_enable = (arr.indexOf(elem_value) > -1) ? true : false;
                } else if (relative.getAttribute('data-ha-in')) {
                    var arr = [];

                    container
                        .querySelectorAll(relative.getAttribute('data-ha-relative'))
                        .forEach(function (elem0) {

                            // Handle radio & checkbox
                            if (
                                elem0.tagName === 'INPUT' && ['radio', 'checkbox'].includes(elem0.type)
                            ) {
                                if (elem0.checked) {
                                    arr.push(elem0.value);
                                }

                                // Handle multi-select
                            } else if (
                                elem0.tagName === 'SELECT' &&
                                elem0.multiple
                            ) {
                                Array.from(elem0.selectedOptions).forEach(function (option) {
                                    arr.push(option.value);
                                });

                                // Handle normal inputs/selects
                            } else {
                                arr.push(elem0.value);
                            }

                        });
                    to_enable = (arr.indexOf(relative.getAttribute('data-ha-in')) > -1) ? true : false;
                } else if (relative.getAttribute('data-ha-var')) {
                    to_enable = (elem_value == window[relative.getAttribute('data-ha-var')]) ? true : false;
                } else if (relative.getAttribute('data-ha-func') && typeof window[relative.getAttribute('data-ha-func')] === 'function') {
                    var arr = window[relative.getAttribute('data-ha-func')](relative);

                    if (Array.isArray(arr) && arr.indexOf(elem_value) > -1) {
                        to_enable = true;
                    } else if (typeof arr === 'object' && arr !== null && typeof arr[elem_value] !== 'undefined') {
                        to_enable = true;
                    } else if (arr == elem_value) {
                        to_enable = true;
                    }
                } else if (relative.getAttribute('data-ha-resolver') && typeof window[relative.getAttribute('data-ha-resolver')] === 'function') {
                    to_enable = window[relative.getAttribute('data-ha-resolver')](relative, elem, elem_value);
                    if (to_enable === null) {
                        return;
                    }
                }

                callback && callback(elem, relative, to_enable); // select, div, bool
            })
        }

        elem.addEventListener('change', exec);
        // jQuery(elem).on('change', exec); // select2 version
        exec();
    });
}

helper_attr_rev_init();