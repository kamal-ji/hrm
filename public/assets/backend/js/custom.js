function toggler(select, div, to_enable){
    if(to_enable) {
        div.classList.remove('d-none');

        jQuery(div).find('input, select, textarea').each(function(){
            $(this).val('');

            if($(this).attr('data-required')){
                $(this).attr('required', 'true');
                $(this).removeAttr('data-required');
            }
        });
    } else {
        div.classList.add('d-none');

        jQuery(div).find('input, select, textarea').each(function(){
            $(this).val('');
            
            if($(this).attr('required')){
                $(this).attr('data-required', 'true');
                $(this).removeAttr('required');
            }
        });
    }
}

function helper_attr_rev_init(){
    document.querySelectorAll('[data-ha-name]:not(.ha-rev-init)').forEach(function(elem){
        elem.classList.add('ha-rev-init');

        var containerSelector = elem.getAttribute('data-ha-container');
        var container = containerSelector ? document.querySelector(containerSelector) : document;
        var name = elem.getAttribute('data-ha-name');
        var callback = elem.getAttribute('data-ha-callback') ? window[ elem.getAttribute('data-ha-callback') ] : false;
        
        function exec(){
            container.querySelectorAll('[data-ha-relative="'+name+'"]').forEach(function(relative){
                var to_enable = false;
                var elem_value = '';

                if( elem.tagName == 'SELECT' ){
                    if(elem.multiple === true){
                        var selectedOptions = [];
                        for(var option of elem.options){
                            if( option.selected === true ){
                                selectedOptions.push(option.value);
                            }
                        }
                        elem_value = selectedOptions;
                    } else {
                        elem_value = elem.value;
                    }
                } else if( elem.tagName == 'INPUT' ){
                    if(elem.type == 'checkbox' || elem.type == 'radio'){
                        elem_value = (elem.checked === true ? elem.value : '');
                    } else {
                        elem_value = elem.value;
                    }
                } else if( elem.tagName == 'TEXTAREA' ){
                    elem_value = elem.value;
                }

                if( relative.getAttribute('data-ha-equal') ){
                    to_enable = (relative.getAttribute('data-ha-equal') == elem_value) ? true : false;
                } else if( relative.getAttribute('data-ha-else') ){
                    to_enable = (relative.getAttribute('data-ha-else') != elem_value) ? true : false;
                } else if( relative.getAttribute('data-ha-in') ){
                    var arr = JSON.parse( relative.getAttribute('data-ha-in') );
                    to_enable = ( arr.indexOf(elem_value) > -1 ) ? true : false;
                } else if( relative.getAttribute('data-ha-var') ){
                    to_enable = ( elem_value == window[ relative.getAttribute('data-ha-var') ] ) ? true : false;
                } else if( relative.getAttribute('data-ha-func') && typeof window[ relative.getAttribute('data-ha-func') ] === 'function' ){
                    var arr = window[ relative.getAttribute('data-ha-func') ]();
                    
                    if( Array.isArray( arr ) && arr.indexOf(elem_value) > -1 ){
                        to_enable = true;
                    } else if( typeof arr === 'object' && arr !== null && typeof arr[ elem_value ] !== 'undefined' ){
                        to_enable = true;
                    } else if( arr == elem_value ) {
                        to_enable = true;
                    }
                } else if( relative.getAttribute('data-ha-resolver') && typeof window[ relative.getAttribute('data-ha-resolver') ] === 'function' ){
                    to_enable = window[ relative.getAttribute('data-ha-resolver') ]( relative, elem, elem_value );
                    if(to_enable === null){
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