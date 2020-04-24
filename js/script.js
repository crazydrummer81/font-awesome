function copyToClipboard(elem) {
    var text = elem.textContent.trim();

    console.log(getWrapper("tag"));
    var tag = getWrapper("tag");

    var prefix = "";
    var postfix = "";

    if( (elem.id != "fa-link") && (elem.id != "icon-value") ) {
        switch(tag) {
            case 'i': 
                prefix = "<i class='fa "; postfix = "'></i>";
                break;

            case 'span': 
                prefix = "<span class='fa "; postfix = "'></span>";
                break;

            case 'name': 
                prefix = "fa "; postfix = "";
                break;

            default:
                prefix = "fa "; postfix = "";
                break;
        }
    } else {
        prefix = ""; postfix = "";
    }

    text = prefix + text + postfix;

    navigator.clipboard.writeText(text)
        .then(() => {
            console.log('Copied to clipboard!')
            var buffer = elem.textContent;
            var bg_color_buffer = elem.style.backgroundColor;
            var color_buffer = elem.style.color;
            // elem.textContent = "📋 " + elem.textContent;
            elem.style.backgroundColor = "mediumseagreen"; 
            elem.style.color = "white";
            setTimeout( () => { 
                elem.textContent = buffer; 
                elem.style.backgroundColor = bg_color_buffer;
                elem.style.color = color_buffer;
            }, 500);
        })
        .catch(err => {
            console.log('Something went wrong', err);
        });
}
function setTag(radio) {
    console.log(radio.value);
    var radios_arr = document.getElementsByName("tag");
    radios_arr.forEach(function(item, i, arr) {
        if( item.value == radio.value ) {
            item.checked = true;
        }
    });
}
function getWrapper(radio_name) {
    var radios_arr = document.getElementsByName(radio_name);
    console.log(radios_arr);
    var checked_value = "";
    radios_arr.forEach(function(item, i, arr) {
        if( item.checked ) {
             checked_value = item.value;
        }
    });
    return checked_value;
}
