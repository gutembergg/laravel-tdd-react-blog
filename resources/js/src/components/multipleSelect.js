const multipleSelect = document.querySelectorAll("select[multiple]");

if(multipleSelect.length > 0) {
    new TomSelect("select[multiple]", {
        plugins: {
            remove_button:{
                title:'Remove this item',
            }
        },
    });
    
}
